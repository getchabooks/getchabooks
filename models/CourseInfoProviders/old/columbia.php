<?php

require_once(__DIR__ ."/../../base/propel.php");
require_once(__DIR__ ."/../../spider/curl.php");

$term = "2011_1";

$school = SchoolQuery::create()->filterBySlug('columbia')->findOne();
$sections = SectionQuery::create()
    ->joinWith('Section.Course')
    ->joinWith('Course.Dept')
    ->filterBySchool($school)
    ->orderBy('Section.Slug')
    ->find();

$sections->populateRelation('SectionHasItem');

foreach ($sections as $section) {       
    $itemsByAuthor = array();

    foreach ($section->getSectionHasItems() as $shi) {
        $itemsByAuthor[trim(strtolower($shi->getItem()->getAuthor()))] = $shi->getItem();
    }

    echo $section->getSlug() . ", number of items in db : ".count($itemsByAuthor) . "\n";

    $url = "https://courseworks.columbia.edu/cms/public/intro_out.cfm?crs="
        . $section->getCourse()->getDept()->getAbbr()
        . $section->getCourse()->getNum() . '_'
        . $section->getNum() . '_'
        . $term;

    $result = curl_get($url);

    preg_match_all("/\<tr.*?\>.*?\<\/tr\>/s", $result, $matches);

    $idsAlreadyTaken = array();

    $requireType = null;

    foreach ($matches[0] as $match) {
        if (preg_match("/\<strong\>(.*?)\<\/strong\>/", $match, $ms)) {
            if ($ms[1] == "Recommended") {
                $requireType = SectionHasItem::REQUIRED;
            } else if ($ms[1] == "Required") {
                $requireType = SectionHasItem::RECOMMENDED;
            }

        }

        if (preg_match_all("/\<td.*?\>(.*?)\<\/td\>/", $match, $ms)) {
            if (count($ms[1]) != 7) {
                continue;
            }

            array_shift($ms[1]);
            list($isbn, $title, $author, $publisher, $date, $price) = array_map("trim", $ms[1]);
            if ($isbn == "ISBN") {
                continue;
            }

            echo $author . "\n\t$title\n";

            $price = ltrim($price, '$');

            $matchingItems = array();
            foreach ($itemsByAuthor as $au => $item) {
                if ($au && preg_match("/".preg_replace("/[^A-Z]+/", '', $au)."/i", 
                    preg_replace("/[^A-Z]+/", '', $author))
                    && !in_array($item->getId(), $idsAlreadyTaken)) 
                {
                    echo "\tauthor in database: $au\n";
                    $matchingItems[] = $item;
                }
            }

            if (count($matchingItems) == 1) {               // we're done and good
                echo "\tone item matched.\n";
                $item = $matchingItems[0];
                $item->setIsbn($isbn)->save();

                // set isbns for items with the same title and author
                /*ItemQuery::create()
                ->where('Item.Isbn = ?', ''*/


            } else if (count($matchingItems) == 0) {        // make a new item
                echo "\tno items matched, making a new one.\n";
                if ($requireType == null) {
                    echo "\t\tWTFWTF, no require type\n";
                    continue;
                }

                $item = new BnItem();
                $item->setIsbn($isbn)
                    ->setTitle($title)
                    ->setAuthor($author)
                    ->setPublisher($publisher)
                    ->setEdition($date)
                    //->setBNew($price)
                    ->save();

                $shi = new BnSectionHasItem();
                $shi->setSection($section)
                    ->setItem($item)
                    ->setRequiredStatus($requireType)
                    ->save();

            } else {                                        // different BN items have the same author.  fuck.
                echo "\tmultiple items, meh.\n";
                // compare the titles
                $maxScore = 0;
                $best = null;
                foreach ($matchingItems as $it) {
                    $score = similar_text($it->getTitle(), $title);
                    if ($score > $maxScore) {
                        $maxScore = $score;
                        $best = $it;
                    }                       
                }
                if ($best) {
                    $best->setIsbn($isbn)->save();
                    $idsAlreadyTaken[] = $best->getId();
                }               

                $item = $best;
            }

            $book = BookQuery::create()->filterByIsbn($isbn)->findOneOrCreate();
            $book->save();

            $oldPrices = PriceQuery::create()->filterByItemId($item->getId())->update(array('Isbn' => $isbn));
            //BnSection::createPricesByBook($book, null, $price, Vendor::BNCOLLEGE);
        }
    }

    //die();


}

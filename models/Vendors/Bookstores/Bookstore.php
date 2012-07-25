<?php

class BookstoreError extends Exception {}
class NotImplementedError extends BookstoreError {}

interface Bookstore {
    /**
     * Bookstore classes implement getX methods for Campuses to Sections that
     * mirror the dropdowns on the bookstore websites.
     *
     * The methods take and return JSON-style arrays.  The BId field in these
     * arrays should be the bookstore's unique identifier for an item, but if
     * the bookstore doesn't have one for certain objects apart from their name
     * (most dropdowns on Follett, for example), then it is the responsibility
     * of the implementation to create a unique, unchanging BId (e.g. by
     * concatenating the ancestor items' BIds).
     */

    /**
     * @return array of arrays with 'BId', 'Subdomain', 'Name', 'Slug', and 
     *                              optionally 'ShortName', 'State'
     */
    public static function getSchools();

    /**
     * @return array of arrays with 'BId', 'Name'
     */
    public static function getCampuses($data);

    /**
     * @return array of arrays with 'BId', 'Name'
     */
    public static function getTerms($data);

    /**
     * @return array of arrays with 'BId', 'Abbr'
     */
    public static function getDepts($data);

    /**
     * @return array of arrays with 'BId', 'Num'
     */
    public static function getCourses($data);

    /**
     * @return array of arrays with 'BId', 'Num', 'RequiresBooks'
     */
    public static function getSections($data);

    public static function getSectionsHaveItems($sections);

    /**
     * @param Iterable $sections
     * @param $school
     * @return string  the URL for $sections
     */
    public static function getSectionsUrl($sections, $school);

    /**
     * @return string  the bookstore URL for $item
     */
    public static function getItemUrl($school, $item);

    /**
     * return the price subtotal for $item.  I.e., Used or New?
     */
    public static function getItemSubtotal($item);

    /**
     * whether to display an asterisk next to prices with a note saying you may
     * be able to get the book for less used.
     */
    public static function showAsterisk();
}

/**
 * Base bookstore class that provides default implementations of some
 * functionality.
 *
 * These magic methods return queries and objects with the appropriate
 * BookstoreType field already set.
 *
 * @method School newSchool()
 * @method Campus newCampus()
 * @method Term newTerm()
 * @method Dept newDept()
 * @method Course newCourse()
 * @method Section newSection()
 * @method SectionHasItem newSectionHasItem()
 * @method Item newItem()
 *
 * @method SchoolQuery getSchoolQuery()
 * @method CampusQuery getCampusQuery()
 * @method TermQuery getTermQuery()
 * @method DeptQuery getDeptQuery()
 * @method CourseQuery getCourseQuery()
 * @method SectionQuery getSectionQuery()
 * @method SectionHasItemQuery getSectionHasItemQuery()
 * @method ItemQuery getItemQuery()
 */
abstract class BaseBookstore extends BaseVendor {

    /**
     * Return a dummy campus for bookstores that don't have campuses.
     *
     * This should be re-implemented by sub-classes if appropriate.
     */
    public static function getCampuses($data) {
        return array(array(
            'BId' => "default-campus-{$data['BId']}",
            'Name' => ''
        ));
    }

    /**
     * This should be re-implemented by sub-classes when appropriate, i.e., when
     * you can get results from the bookstore for more than one section at once.
     *
     * @param Iterable $sections
     */
    public static function getSectionsHaveItems($sections) {

        $ret = array();
        foreach ($sections as $section) {
            $ret[$section['BId']] = static::getSectionHasItems($section);
        }
        return $ret;

    }

    public static function getSectionHasItems($section) {
        throw new NotImplementedError();
    }

    // not used
    public static function fetchPrices(array $isbns) {}

    public function __call($name, $args) {
        $bookstoreType = get_class($this);
        $class = substr($name, 3);

        $foo = array('getSchoolQuery', 'getCampusQuery', 'getTermQuery',
                     'getDeptQuery', 'getCourseQuery', 'getSectionQuery',
                     'getSectionHasItemQuery', 'getItemQuery');
        if (in_array($name, $foo)) {
            $query = new $class;
            return $query->filterByBookstoreType($bookstoreType);
        }

        $foo = array('newSchool', 'newCampus', 'newTerm', 'newDept',
                     'newCourse', 'newSection','newSectionHasItem', 'newItem');
        if (in_array($name, $foo)) {
            $obj = new $class;
            return $obj->setBookstoreType($bookstoreType)->setTouched(1);
        }

        return call_user_func_array("self::$name", $args);
    }

    public static function getName() {
        return 'Bookstore';
    }

    public static function getDescription() {
        return 'Your school bookstore sometimes has special items that you can\'t get anywhere else.';
    }

    public static function shippingCostPerOrder() {
        return 0;
    }

    public static function shippingCostPerHardcover() {
        return 0;
    }

    public static function shippingCostPerPaperback() {
        return 0;
    }

    public static function getPrices(array $isbns, array $items=null) {
        if ($isbns && !$items) {
            throw new GetchabooksError("Bookstore::getPrices() called with \$isbns but empty or nonexistent \$items");
        }

        $ret = array();
        foreach ($isbns as $isbn) {
            $item = $items[$isbn];

            $p = new Price;
            $p->bookId = $item->getIsbn() ?: $item->getId();
            //$p->offerId = ?
            $p->subtotal = self::getItemSubtotal($item);

            if (self::showAsterisk()) {
                $p->asteriskPrice = $item->getBUsed();
            }

            $p->shipping = 0;
            $p->percentSaved = null;
            $p->item = $item;
            $p->vendorName = get_called_class();
            $ret[$isbn] = $p;
        }
        return $ret;
    }

    public static function getShipping(array $prices) {
        return 0;
    }

    public static function getTax($subtotal, $state=null) {
        global $school;

        // uses state tax if local tax is unset
        $localTax = $school->getLocalTax();
        return $subtotal * $localTax / 100.0;
    }

    public static function getItemSubtotal($item) {
        return $item['BUsed'] ?: $item['BNew'];
    }

    public static function showAsterisk() {
        return false;
    }

    /**
     * move components into their packages
     */
    public static function processItems(array $items) {
        for ($i=0; $i < count($items); $i++) {
            if ($items[$i]['isComponent'] && $i > 0) {
                $flag = false;
                for ($j=$i; $j >= 0; $j--) {
                    if ($items[$j]['isPackage']) {
                        $items[$j]['components'][] = $items[$i];
                        $flag = true;
                        break;
                    }
                }

                if (!$flag) {
                    for ($j=$i; $j >= 0; $j--) {
                        if (!$items[$j]['isComponent']) {
                            $items[$j]['components'][] = $items[$i];
                            $flag = true;
                            break;
                        }
                    }
                }

                if (!$flag) {
                    $items[$i]['isComponent'] = false;
                }
            }
        }

        foreach ($items as $k => $item) {
            if ($item['isComponent']) {
                unset($items[$k]);
            }
        }

        return $items;

    }

    protected function makeNewItem($sectionId, $details, $packageId=null, $status=null) {
        // undefined index errors if we have high error level reporting on.  we 
        // really don't care about these here, it's fine if they're interpreted as 
        // falsy
        $oldLevel = error_reporting(0);

        if ($details['requiredStatus'] < SectionHasItem::GO_TO_CLASS_FIRST) {
            return true;
        }

        if (Isbn::validate(Isbn::clean($details['isbn']))) {
            $details['isbn'] = Isbn::to13(Isbn::clean($details['isbn']));
        } else {
            $details['isbn'] = null;
        }

        $item = $this->getItemQuery()
            ->filterByProductId($details['productId'])
            ->filterByPartNumber($details['partNumber'])
            ->filterByIsbn($details['isbn'])
            ->findOne();

        if (!$item) {
            $item = $this->newItem()
                ->setIsbn($details['isbn'])
                ->setProductId($details['productId'])
                ->setPartNumber($details['partNumber']);
        }

        $item->setTitle($details['title'])
            ->setAuthor($details['author'])
            ->setEdition($details['edition'])
            ->setPublisher($details['publisher'])
            ->setImageUrl($details['imageUrl'])
            ->setBNew($details['newPrice'])
            ->setBUsed($details['usedPrice'])
            ->setIsPackage($details['isPackage'] || $details['components'])
            ->setPackageId($packageId)
            ->save();

        if (isset($details['components'])) {
            foreach ($details['components'] as $component) {
                $this->makeNewItem($sectionId, $component, $item->getId(),
                                   $details['requiredStatus']);

            }
        }

        if ($packageId === null) {
            $sectionHasItem = $this->getSectionHasItemQuery()
                ->filterByItem($item)
                ->filterBySectionId($sectionId)
                ->findOne();

            if (!$sectionHasItem) {
                $sectionHasItem = $this->newSectionHasItem()
                    ->setItem($item)
                    ->setSectionId($sectionId);
            }

            $sectionHasItem->setRequiredStatus($details['requiredStatus'] ?: $status)
                ->setTouched(1)
                ->save();
        }

        error_reporting($oldLevel);
    }

    /**
     * @param Iterable $sections
     */
    public function spiderSections($sections) {
        if (!$sections) {
            return;
        }

        $spideredAtAll = false;

        $sectionIds = array();
        foreach ($sections as $s) {
            $sectionIds[] = $s->getId();
        }

        $this->getSectionHasItemQuery()
            ->filterBySectionId($sectionIds)
            ->update(array('Touched' => false));

        $sectionsByBId = array();
        foreach ($sections as $section) {
            $sectionsByBId[$section->getBId()] = $section;
        }

        foreach (static::getSectionsHaveItems($sections) as $id => $items) {
            if (!isset($sectionsByBId[$id])) {
                error_log(get_class($this) . " returned data for incorrect/unknown section: $id");
                continue;
            } else {
                $spideredAtAll = true;
            }

            if ($items === null) {
                $sectionsByBId[$id]->setRequiresBooks(0)->save();
                unset($sectionsByBId[$id]);
                continue;
            }

            foreach ($items as $details) {
                $this->makeNewItem($sectionsByBId[$id]->getId(), $details);
            }

            $sectionsByBId[$id]->setTouched(1)->setSpidered()->save();

            unset($sectionsByBId[$id]);
        }

        $this->getSectionHasItemQuery()
            ->filterBySectionId($sectionIds)
            ->filterByTouched(0)
            ->delete();

        return array(count($sectionsByBId) == 0, $spideredAtAll);

    }

    public static function addSchools() {
        $class = get_called_class();

        decho("Adding schools for $class");

        foreach (static::getSchools() as $data) {
            print_r($data);
            $school = SchoolQuery::create()
                ->filterByBookstoreType($class)
                ->filterBySubdomain($data['Subdomain'])
                ->findOne();

            if (!$school) {
                $school = new School();
                $school->setBookstoreType($class)
                    ->setSubdomain($data['Subdomain']);
            }
            $school->setSlug($data['Slug'])
                ->setName($school->getName() ?: $data['Name'])
                ->setShortName($school->getShortName(true) ?: (isset($data['ShortName'])
                                                               ? $data['ShortName']
                                                               : School::guessShortName($data['Name'], $data['Slug'])))
                ->setTouched(1)
                ->save();
        }
    }
}

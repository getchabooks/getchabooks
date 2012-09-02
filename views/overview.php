<?php

// NO VALID ITEMS
if ( !$anyBooks && (!$results->shis || $results->shis->count() == 0) ) {
    ?>

    <p class='lightboxHeader first centered'>Oh no!</p>

    <p id='recommendation'>We're sorry. You didn't enter any valid <?= $isbnMode ? 'books' : 'courses' ?>.</p>

    <p>We recommend you <a id='editLink' class='vendor' style='font-size: 1em;' href='<?= $selectionUrl; ?>'>go back and add some</a>.</p>

<?php

// NO BOOKS LISTED YET
} else if ($results->numItems == 0) {
    $coursesNounVerb = $results->numSections != 1 ? "courses don't" : "course doesn't";
    ?>

    <p class='lightboxHeader first centered'>Here's the deal.</p>

    <p id='recommendation'>Your <?= $coursesNounVerb ?> have any books listed yet. As the beginning of the semester approaches, this may change.</p>

    <p>Bookmark this page or email it to yourself to check again in a few days.</p>

    <?php if (!MOBILE_DEVICE) { ?>
    <input class='glorifiedLink' value='<?= $pageUrl; ?>' onClick='select();' style='width: 710px;' readonly></input>
    <?php } ?>

    <p>To view books for other courses, <a id='editLink' class='vendor' style='font-size: 1em;' href='<?= $selectionUrl; ?>'>go back and edit your courses</a>.</p>

<?php
// WE HAVE DATA!
} else {

    $booksNoun = "book".($results->numItems != 1 ? "s" : "");
    $allYourBooks = ($results->numItems > 1 ? "all of" : "") . " your $booksNoun";
    $booksPronoun = $results->numItems != 1 ? "them" : "it";

    ?>
        <p class='lightboxHeader first centered'>Here's the deal.</p> <?php

    if ($isbnMode) { ?>

        <p id='recommendation'>We searched the web, crunched some numbers, and came up with a few options for buying your <?=$booksNoun?>:</p>

    <?php } else if ($results->numItems) {

        $numCourses = $results->numSections;
        $numCoursesF = ($numCourses != 1 ? cardinal($numCourses) : "");
        $coursesNoun = "course".($numCourses != 1?"s":"");
        $requiresVerb = "require".($numCourses != 1?"":"s");
        $numCourseBooks = $results->numItems;
        $bookstoreComplete = $results->bookstoreHasAllBooks ? 'has ' : "has {$results->numBookstoreBooks} of ";
        $showBookstore = true;
        if ($results->numBookstoreBooks == 0) {
            $bookstoreComplete = $results->numItems > 1 ? "has none of " : "doesn't have ";
            $showBookstore = false;
        }
        ?>

        <p id='recommendation'><?= "Your $numCoursesF $coursesNoun $requiresVerb $numCourseBooks $booksNoun." ?>
        Your school bookstore <?=$bookstoreComplete.$booksPronoun.(!$showBookstore?'.':'')?>
        <?php if ($showBookstore) { ?>
            for <span class='price'>$<?= money($results->bookstoreCost) ?></span>.
        <?php }

    } else { ?>

        <p id='recommendation' class='first'>Your courses don't have any books listed.</p>

    <?php
    }

    $options = array();
    $bestTotal = $results->bookstoreCost;

    $bookstoreOnly = true;

    // THE FAST WAY
    $fastest = $results->combos['Amazon'];
    // todo: percentSaved for ISBN mode, does this work?
    if ($fastest->isComplete && ($fastest->percentSaved > 0 || !$results->bookstoreHasAllBooks)) {
        $options[] = array(
            'combo' => $fastest,
            'name'  => 'The Fast Way',
            'text'  => "Need your $booksNoun quickly? Buy $booksPronoun new from "
                        . "<span class='price'>{$fastest->vendorName}</span>.",
            'text2' => "<br/>Sign up for a free <a href='"
                        . "http://www.amazon.com/gp/student/signup/info' target='_blank'>"
                        . "Amazon Student</a> account to get free two-day shipping."
        );

        $bestTotal = $fastest->total;
        $showedFastest = true;
    } else {
        $showedFastest = false;
    }

    // THE CHEAP WAY
    foreach ($results->combos as $combo) {
        if ($combo->numItems > 0 && $combo->vendorName != 'Bookstore') {
            $bookstoreOnly = false;

        }

        if (count($options) >= $maxOverviewCombos) {
            break;
        }

        if (!$combo->isComplete
            || $results->bookstoreHasAllBooks && $combo->percentSaved <= 0
            || $combo->vendorName == 'Bookstore'
            || (count($options) >= 2 && $combo->vendorName == 'Chegg')
            || ($showedFastest && $combo->vendorName == 'Amazon'))
        {
            continue;
        }

        $dealName = 'The '. ($showedFastest ? 'Easy' : 'Cheap') . ' Way';
        $dealText = ($showedFastest ? 'You can save' : 'Not in a rush? Save even more')
                    . ' by getting ' . ($combo->numItems > 1 ? 'all of ' : '')
                    . " your $booksNoun from <span class='price'>{$combo->vendorName}</span>.";

        $options[] = array(
            'combo' => $combo,
            'name' => $dealName,
            'text' => $dealText
        );

        $bestTotal = $combo->total;
    }

    // THE CHEAPEST WAY
    $threshold = min($bestTotal*(1-$bdpPercentThreshold), $bestTotal-$bdpAbsoluteThreshold);

    if ($results->bdp->total <= $threshold) {
        $options[] = array(
            'combo' => $results->bdp,
            'name'  => 'The Cheapest Way',
            'text'  => "Willing to work a little to get the best deal possible? Get your $booksNoun from "
                        . "<span class='price'>" . count($results->bdp->combos)
                        . " different vendors</span> for the absolute lowest price."
        );
    }

    function printCombo($combo, $dealName, $dealText1, $dealText2=null) {
        global $results, $app;

        $isBdp = $combo instanceof BestDealPeriod;

        if (!$isBdp) {
            $books = ($combo->numItems > 1 ? "All {$combo->numItems} books" : "Your one book");
            $vendorName = $combo->vendorName == 'Bookstore' ? 'the bookstore' : $combo->vendorName;
            $url = $app->urlFor('redirect', array(
                'url' => '',
                'type' => 'bundle',
                'vendor' => $combo->vendorName
            )) . $combo->url;

            $confirm = "<p class='lightboxHeader first centered'>$books from $vendorName.</a></p>";

            $button = "<p class='centered'><button class='outgoing' data-url='$url'>"
                        . ($combo->vendorName == 'Chegg' ? 'Rent' : 'Buy') . "</button></p>";
        }

        ?>

        <h2 class='deal'><?= $dealName ?>:
            <span class="price">$<?= money($combo->total) ?></span>
            <button <?= $isBdp ? "class='bestdealperiod'" : '' ?>
                    data-saved="<?= $combo->percentSaved ?>"
                    data-price="<?= money($combo->total) ?>"
                    data-confirm="<?= $isBdp ? addslashes($combo->toString()) : $confirm ?>"
                    data-button="<?= $isBdp ? '' : $button ?>"
                    data-vendor="<?= $isBdp ? '' : $combo->vendorName ?>">
                Buy
            </button>
            </h2>
        <p class='dealText'>
                <?= $dealText1 ?>

                <?php if ($combo->percentSaved > 0 && $results->bookstoreHasAllBooks) { ?>
                    You save <span class='price'><?= $combo->saved ?></span>!
                <?php } ?>

                <?= $dealText2 ?>
        </p>

<?php
    }

    if ($options) { 
        if (!$isbnMode) { ?>
        We have some better options for you:
        
    <?php
        }

        foreach ($options as $option) {
            printCombo($option['combo'], $option['name'], $option['text'], @$option['text2']);
        }
    ?>
        <p>You can <span id='check' class='lightboxLink'>check out the extended table</span> to see all the details.</p>

    <?php
    } else { ?>

        <p>We couldn't find your books anywhere <?= $bookstoreOnly ? 'other' : 'for less' ?> than your school bookstore. <span id='check' class='lightboxLink'>Take a look at the extended table</span> to see your book list.</p>

        <p>Good luck, and have a great semester!</p>

    <?php } ?>

    <p class='disclaimer'>All prices include shipping and sales tax, if applicable.</p>
<?php }     // end: else


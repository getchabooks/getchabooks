<?php

/**
 * Prints the metadata and prices for an item
 * @param Item|Book $item   an Item (Section mode) or Book (ISBN mode) object
 * @param int $requiredStatus
 */
function printItemRow($item, $status=null) {
    global $app;

    ?>
    <tr>
        <th>
            <span class="tooltip" style="display: none;">
                <img src="<?= $item->getImageUrl() ?>">
                <h1><?= $item->getTitle() ?></h1>
                <h2><?= $item->getAuthor() ?></h2>
                <?php if ($edition = $item->getEdition()) { ?>
                    <div class="edition"><strong>Edition:</strong> <?= $edition ?></div>
                <?php }
                if ($publisher = $item->getPublisher()) { ?>
                    <div class="publisher"><strong>Publisher:</strong> <?= $publisher ?></div>
                <?php }
                if ($isbn = $item->getIsbn()) { ?>
                    <div class="isbn"><strong>ISBN:</strong> <span class="isbn"><?= $isbn ?></span></div>
                <?php } ?>
            </span>
            <?php
            $indented = $item->isPackageComponent()
                        || $status === SectionHasItem::BOOKSTORE_RECOMMENDED;
            $class = $indented ? " packageComponent" : "";
            ?>

            <span class="bookdata <?= $class ?>">
                <span class="title"><?= $item->getTitle() ?></span><br>
                <?php if ($edition || $item->getAuthor()) { ?>
                <span class="minimetadata"><?= ($edition ? "$edition, ":"") . $item->getAuthor() ?></span>
                <?php } ?>
                <?php
                // e.g. (Recommended)
                if ($stat = Item::getStatusText($status)) { ?>
                    <br/><span class="minimetadata"><?= $stat ?></span>
                <?php }
                // sentence about being a package or component
                if ($description = $item->getDescription($status)) { ?>
                    <br/><span class="minimetadata important"><?= $description ?></span>
                <?php } ?>
            </span>
        </th>

    <?php

    foreach ($item->prices as $v => $p) {
        if ($p === null) {
            if ($v === $GLOBALS['results']->bookstore) { ?>
                <td data-price="-1" class="empty" data-unknown="true">unknown</td>
            <?php } else { ?>
                <td data-price="-1" class="empty">&mdash;</td>
            <?php }
        } else { ?>

            <td data-price="<?= money($p->total) ?>"
                <?php if ($p->asteriskPrice) { ?>
                    data-used="<?= money($p->asteriskPrice) ?>"
                <?php } ?>
                data-subtotal="<?= money($p->subtotal) ?>"
                data-shipping="<?=  money($p->shipping + $p->tax) ?>">

                <a href="<?= $app->urlFor('redirect', array(
                                'url' => '',
                                'type' => 'single',
                                'vendor' => $p->vendorName
                              )) . $p-> url ?>"
                   data-confirm="<?= $p->getDescription() ?>">

                    <?php if ($p->total == 0) { ?>
                        unknown
                    <?php } else { ?>
                        $<?= money($p->total) ?><?= $p->asteriskPrice ? '*' : '' ?>
                    <?php } ?>

                </a>
            </td>
        <?php } ?>
    <?php } // end: foreach $item->prices ?>
    </tr>
    <?php

    if ($item->getIsPackage()) {
        $components = Item::getComponents(array($item->getId()));

        foreach ($components as $c){
            printItemRow($c);
        }
    }

}

/**
 * Prints a section's header table with name and share links.
 * @param Section $section
 */
function printSectionHeader($section) {
    ?>

    <div class="course">
        <div class="share">
            <div class='shareButton emailShare' data-type='Email' data-id='<?=$section->getSlug() ?>'><img src='<?=BASE_URL?>images/share-email.png'/>Email</div>
        </div>
        <div class="text"><?= $section->getName() ?></div>
    </div>

    <?php
}

/*********** Begin output ***********/
?>

<script type='text/javascript'>
    var isbnMode = <?= $isbnMode ? "true" : "false" ?>;
    var pageLink = "<?= $pageUrl ?>";
</script>

<?php

if (!$isbnMode && $results->numSections == 0) { ?>

    <?php // todo: this should be a redirect, no? ?>
    <div id="derpLine"></div>
    <div class="course">
        <div class='text'>We're sorry.</div>
    </div>
    <div class="specialmessage">You didn't enter any valid courses or books.</div>

<?php } else if ($anyBooks) { ?>

    <table id="derpTable" class="course <?= $tableClass ?>">
        <tr>
            <th></th>
            <?php for ($i=0; $i<count($vendors); $i++) { ?>
            <td></td>
            <?php } ?>
        </tr>
    </table>

<?php } else { ?>

    <div id="derpLine"></div>

<?php }

/**** Print Combos if results has more than one book ****/
if ($multipleBooks) { ?>
    <div class="course"><div class='text'>Buy all of your books in one place:</div></div>
        <table id="totals" class="<?=$tableClass?>">
            <tr>
                <th></th>
                <?php foreach ($vendors as $v) {
                    $combo = $results->combos[$v];
                    ?>
                    <td data-price="<?= $combo->isComplete ? money($combo->total) : '-1' ?>"
                        class="<?= $combo->isComplete ? '' : 'empty' ?>"
                        data-status="<?= $combo->getDescription() ?>"
                        data-numbooks="<?= $combo->numItems ?>">

                    <?php if ($combo->isComplete) { ?>
                        <a href="<?= $app->urlFor('redirect', array(
                                'url' => '',
                                'type' => 'bundle',
                                'vendor' => $combo->vendorName
                                )) . $combo->url ?>"
                            data-confirm="<?= "All {$results->numItems} books from {$combo->vendorName}." ?>">
                                $<?= money($combo->total) ?>
                            </a>
                    <?php } else { ?>
                        &mdash;
                    <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        </table>
<?php
}

// print SectionHasItems, thereby printing all sections, with items if they have them
$currentSectionId = null;
foreach ($results->shis as $shi) {
    $section = $shi->getSection();
    $item = $shi->getItem();

    if ($section->getId() != $currentSectionId) {
        $currentSectionId = $section->getId();
        printSectionHeader($section);
    }

    if ($item) {    ?>
        <table class="course <?= $tableClass ?>">
            <?php printItemRow($item, $shi->getRequiredStatus()); ?>
        </table>
    <?php
    } else if (!$section->getRequiresBooks() ) { ?>
        <div class="specialmessage">This course doesn't require any books.</div>
    <?php
    } else {
    ?>
        <div class="specialmessage">This course doesn't have any books listed yet. <span class='bookmark'>Bookmark this page</span> to check again later.</div>
    <?php
    }
}

// print loose books
if ($results->books) { ?>
    <div class="course">
        <div class='text'>Your Books</div>
    </div>
    <table class="course <?= $tableClass ?>">
    <?php
    foreach ($results->books as $book) {
        printItemRow($book);
    }
}
?>

</table>

<div class="bottomline"></div>

<div id="initialOverviewText">
    <?php require_once __DIR__ . "/overview.php"; ?>
</div>


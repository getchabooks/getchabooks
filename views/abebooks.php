<div id="top"></div>
<div id="content" class="welcome">
    <div id="introduction">
        <h2>To buy your books from AbeBooks, click on each of these links.</h2>
    </div>
<?php

$i = 1;
foreach ($isbns as $isbn) {
    $p = new Price();
    $p->bookId = $isbn;
?>
    <p><a href="<?= AbeBooks::getUrl(array($p)) ?>" target="_blank"><?= ordinal($i++) . " Book" ?></a></p>

<?php
}
?>
</div>

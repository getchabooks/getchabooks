<?php

function deamp($s) {
    $out = str_replace('&amp;', "&", $s);
    $out = str_replace('&', "&amp;", $out);
    $out = str_replace(' ', '%20', $out);
    return $out;
}

$startover = BASE_URL . (isset($schoolSlug) ? "$schoolSlug/" : "");

?>

<a href="https://github.com/getchabooks/getchabooks">
    <img id='ribbon' src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub">
</a>

<div id="above">
<?php if (isset($breadcrumbFormat)) { ?>

    <p id="breadcrumbs">

	<?php 

    if ($breadcrumbFormat == "selection") {

        $sURL = $startover . "selection/";
        $editing = ($isbnMode == true) ? "enter books" : "select courses";

        ?>

        <a href="<?= $startover ?>" id="restartCrumb">start over</a>
         &rsaquo; <a href="<?=$sURL?>"><?=$editing?></a>

    <?php } else { // $breadcrumbFormat == "results"

	    $sURL = $startover . "selection/#?/$hashPrefix" . deamp($ids);
	    $rURL = $startover . "results/$hashPrefix" . deamp($ids);
		$editing = ($isbnMode == true) ? "entered books" : "selected courses";

        ?>

        <a href="<?= $startover ?>" id="restartCrumb">start over</a>
        &rsaquo; <a href="<?=$sURL?>" id="editCrumb">change <?=$editing?></a>
        &rsaquo; <a href="<?=$rURL?>" id="resultsCrumb">view results</a>

    <?php } ?>

    </p>

<?php } ?>

    <a href="<?= BASE_URL ?>" tabindex="-1">
    <img id="logo" src="<?= BASE_URL ?>images/logo.png" alt="<?= $siteName ?>" width="315" height="51"/>
    </a>
</div>

<img src="<?= BASE_URL ?>images/cancel.png" style="display:none" alt="Cancel" />

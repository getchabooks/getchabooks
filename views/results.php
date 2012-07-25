<div id="top">
    <button class='save'>
        <span>Save this Page</span>
    </button>
    <p id="instructions"><strong>Click on a price</strong> for more information.</p>
    <table id="headerTable" class="<?= $tableClass ?>">
        <tr>
            <th>
                <button id="simple" class="button left">Our Recommendations</button>
            </th>
            <?php foreach ($vendors as $v) {
                    if ($v == 'Bookstore') continue; // ISBN mode
                    ?>

                <td class="header rest" data-description="<?= $v::getDescription() ?>">
                    <?= $v::getName() ?>
                </td>

            <?php } ?>
        </tr>
    </table>
</div>

<div id="content">
    <div id="loading" class="center">
    <h1>Just a moment...</h1>
    <img src="<?=BASE_URL?>images/ajax-loader.gif" alt="Loading" />
    </div>
</div>


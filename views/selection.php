
<?php if ($isbnMode) { // ISBN mode ?>

<div id="top" class='isbn'>
        <form onsubmit="return false;"><button id="isbnhelp" tabindex="11">Hide Instructions</button></form>
        <div id="instructions"><p><strong>Add your books</strong> to the list below.</p></div>
        <div id="search">
        <input id="searchBox" type="<?= MOBILE_DEVICE ? "tel" : "text"?>" name="searchbox" tabindex="1" />
            <div id="autowrapper">
                <div id="autocompleteResults" class="isbn"></div>
            </div>
        </div>
    </div>

    <div id="content">
        <h1>
            Your Books
            <button id="go" tabindex=1>I'm done adding books.</button>
        </h1>
        <div id="items"><div id='noItems'>You have not added any books yet.</div></div>
    </div>

<?php } else {         // Course mode ?>

<div id="top" class="tall">
    <span id="campusWrapper" style="display:<?= $campusWrapperDisplay ?>;">
        <h2><strong>Select a campus</strong> to get started.</h2>
        <select id="campus">
            <option value="NULL" selected="selected"><?= $school->getShortName() ?> Campuses</option>
        </select>
    </span>

    <span id="termWrapper" style="display:none;">
        <h2><strong>Select a Term</strong></h2>
        <select id="term">
            <option value="NULL" selected="selected"><?= $school->getShortName() ?> Terms</option>
        </select>
    </span>

    <span id="topWrapper" style="display:<?= $topWrapperDisplay ?>;">
        <div id="instructions">
        <p class="add"><strong>Add your courses</strong><?php if(!$multiCampus) {?> to the list below<?php } ?>.</p>
                <p class="extra">
            <?php if ($multiCampus) { ?>
                Campus: <span id='campusName'></span>
            <?php } ?>
                Term: <span id='termName'></span></p>
        </div>

        <?php
            /* This form tag fixes an old IE bug. Don't touch.
             * These buttons appear to be output backward because they're
             * `float: right`'d. */
        ?>
        <form onsubmit="return false;">
            <button id="toggle" tabindex="12" style="display:none;">Switch to Quick Entry</button>
        <?php // we always toggle terms ?>
            <button id="termToggle" tabindex="11">Change Term</button>
        <?php // terms ?>
        <?php if ($multiCampus) {?>
            <button id="campusToggle" tabindex="10">Change Campus</button>
        <?php } ?>
        </form>

        <div id="search">
            <input id="searchBox" type="text" name="searchbox" tabindex="1" />
            <div id="autowrapper">
                <div id="autocompleteResults"></div>
            </div>
        </div>

        <div id="browse">
            <table>
                <tr>
                    <td>
                        <select id="department" disabled="true">
                            <option value="NULL" selected="selected">Select a Department</option>
                        </select>
                    </td>
                    <td>
                        <select id="course" disabled="true">
                            <option value="NULL" selected="selected">Select a Course</option>
                        </select>
                    </td>
                    <td>
                        <select id="section" disabled="true">
                            <option value="NULL" selected="selected">Select a Section</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </span>
</div>

<div id="content">
    <h1>
        Your Courses
        <button id="go" tabindex=1>I've added my courses.</button>
    </h1>
    <div id="items"><div id='noItems'>You have not added any courses yet.</div></div>
</div>

<?php } //  end: if

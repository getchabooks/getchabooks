<div id="top"></div>

<div id="content" class="welcome">

    <div id="actionWrapper"><div id="action">

    <?php if (defined('EMERGENCY')) { ?>
    <div id="status">
        <p class='title'>We're busy preparing for the next semester.</p>
        <br />
        <p class="check">Check back closer to the start of the semester to look for your books by course.</p>
    </div>

    <?php } else { // NOT EMERGENCY ?>
        <div id="go">
            <?php if ($school) { ?>
                <h2><?= $school->getName() ?></h2>
                <button tabindex="1" id="getStarted">Let's Get Started!</button>

                <a tabindex="2">
                    <p id="change">(Not from <?= $school->getShortName(); ?>?)</p>
                </a>
            <?php } else { ?>
                <a href="#"><h2>We'll be right back.</h2>
                <h3>We're updating your school's listings. Try again in a few minutes.</h3></a>
    <?php } ?>
        </div>

        <div id="select">
            <input id="searchBox" name="searchbox" tabindex="1" />
            <ul id="list">
                <?php $this->printSchoolList($schoolJson); ?>
            </ul>
        </div>
        <?php } // end EMERGENCY ?>

        <div id="drop"></div></div>

    <form onsubmit="return false;"><button tabindex="4" id="goISBN">
        <?php if (defined('EMERGENCY')) { ?>
            Search for books by ISBN.
        <?php } else { ?>
            <?php if (!$school) { ?>
                Don't see your school?
            <?php } else { ?>
                Looking for a single book?
            <?php } ?>
            <br/>Search by ISBN.
        <?php } ?>
    </button></form><?php // the form fixes an IE8 bug ?>

    </div>

    <div id="introduction">
        <h1>Textbooks made easy.</h1>
        <h2>For students, by students.</h2>

        <ol>
            <li><p>You tell us your courses.</p></li>
            <li><p>We find your books for cheap.</p></li>
            <li><p>It's that easy.</p></li>
        </ol>

        <p>Pick your school to get started.</p>

        <noscript>Your browser doesn't have JavaScript enabled. <?= $siteName ?> requires JavaScript. Please enable JavaScript and try again.</noscript>
    </div>

    <div id="ie_message">
    <p>Hi! You're browsing the web with an outdated version of Internet Explorer. <?= $siteName ?> doesn't support this browser. For your convenience and safety, please download another web browser like <a href='http://google.com/chrome'>Google Chrome</a> or <a href='http://getfirefox.com/'>Mozilla Firefox</a>. Then, come back and try <?= $siteName ?> again!</p>
    </div>

</div>

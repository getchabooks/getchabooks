<div id="top"></div>

<div id="content" class="welcome">

    <div id="actionWrapper" style="width: 370px;">
        <div id="action" style="max-height: none;">
            <div id="isbn_status">
                <p class='title'>&#8220;What happened to telling <?= $siteName ?> my courses?&#8221;</p>
                <p>It's taking us more time than usual to get the textbook listings for your courses.</p>
                <p><strong>Fear not!</strong> If you find out what books you need from your professors or your school bookstore, <?= $siteName ?> can still help you.</p>
                <p><strong>Your books' ISBNs are key.</strong> An ISBN is a 10 or 13 digit number associated with a book. If you tell <?= $siteName ?> the ISBNs for your books, we'll find the cheapest prices for them on the web.</p>
            </div>
        </div>

    </div>


    <div id="introduction">
        <h1>Textbooks made easy.</h1>
        <h2>For students, by students.</h2>

        <ol>
            <li><p>You tell us what books you need.</p></li>
            <li><p>We find the best way to get all of them.</p></li>
            <li><p>You save time and money.</p></li>
        </ol>

        <form onsubmit="return false;" style="margin: 0 auto;"><button tabindex="4" id="goISBN" style="width: 340px; margin-left: 64px; margin-top: 1.5em;">
            Let's get started!
            <br />
            Search for books by ISBN.
        </button></form>

        <noscript>Your browser doesn't have Javascript enabled. <?= $siteName ?> requires Javascript. Please enable Javascript and try again.</noscript>
    </div>

    <div id="ie_message">
        <p>Hi! You're browsing the web with an outdated version of Internet Explorer. <?= $siteName ?> doesn't support this browser. For your convenience and safety, please download another web browser like <a href='http://google.com/chrome'>Google Chrome</a> or <a href='http://getfirefox.com/'>Mozilla Firefox</a>. Then, come back and try <?= $siteName ?> again!</p>
    </div>

</div>

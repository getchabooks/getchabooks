/*
Ricky's TODO (as of 11/19/11, hopelessly outdated);
Remove warningText...
Remove { vendors: null }
strings.js

Finally:
Once the CSS classes we're keeping are stable, remove old ones from results.css.
*/

var outgoing = "<p class='first'>Click the link to view your book";
var outgoing2 = " on ";
var outgoing3 = ".<br/>We suggest double-checking the price before you buy.</p>";
var bestDeal = "<p>Accounting for shipping and taxes, this is the best deal we could find. Open each of the following links to buy your books.</p>";
var promotion = "<p class='centered' style='padding-top: 20px'>Thanks for using " + Globals.SITE_NAME + "!</p>";
var bdpHeader = "<p class='lightboxHeader first centered'>The Best Deal</p>";

var percent = 0;

if (!Globals.SCHOOL_SLUG) {     // isbn mode
    var tableUrl = Globals.BASE_URL + "get/results/" + Globals.IDS;
} else if (Globals.CAMPUS_SLUG) {
    var tableUrl = Globals.BASE_URL + "get/results/" + Globals.SCHOOL_SLUG + "/" +
                   Globals.CAMPUS_SLUG + "/" + Globals.TERM_SLUG + "/" + Globals.IDS;
} else {
    var tableUrl = Globals.BASE_URL + "get/results/" + Globals.SCHOOL_SLUG + "/" +
                   Globals.TERM_SLUG + "/" + Globals.IDS;
}

Globals.SAVE_EMAIL_URL = Globals.BASE_URL + 'email/save/';
Globals.FRIEND_EMAIL_URL = Globals.BASE_URL + 'email/friend/';

/*
 * Results loads an HTML file, when when ready, executes $(document).ready.
 * $(document).ready fires off an AJAX request for the table.
 * When the data is returned, finishedLoading() sets up event handlers.
 */

$(document).ready(function() {

    $.get(tableUrl, function(data) {
        $("#content").hide().html(data).fadeIn("fast");     // replace loading with table
        $.lightbox( {content: $("#initialOverviewText").html(), touch: Globals.TOUCH});      // overviewText was placed on the page, directly above
        finishedLoading();                                  // register event handlers and clean loose ends

        // Analytics call for pricing
        // TODO: Stop this from asploding in ISBN mode, when there are no books, or when there are no buying options
        var hasBookstore = $("div#initialOverviewText p#recommendation span.price").length > 0;
        var hasDeals = $("div#initialOverviewText ol li span.vendor").length > 0;

        if(hasDeals)
        {
            var bdp = ($("div#initialOverviewText ol li span.price").html()).substr(1) * 100; // The substr gets rid of the dollar sign so we can do the maths.
            Analytics.trackEvent("Stats","Best Deal","",bdp);
        }

        if(hasBookstore && hasDeals) {
            var percent = $("div#initialOverviewText ol li span.vendor").attr("data-saved");
            var bdp = ($("div#initialOverviewText ol li span.price").html()).substr(1) * 100;
            var bookstore = ($("div#initialOverviewText p#recommendation span.price").html()).substr(1) * 100;
            Analytics.trackEvent("Stats","Bookstore Price","",bookstore);
            Analytics.trackEvent("Stats","Percentage Saved","",percent);
            Analytics.trackEvent("Stats","Dollar Amount Saved","",bookstore-bdp);
        }
    },"html");
});


/*
 * finishedLoading()
 * Called after our data has returned, this function registers event handlers on the table and overview.
 */

function finishedLoading() {
    //share widgets
    $("#saveForm").live('submit',sendSaveEmail);
    $("#friendForm").live('submit',sendFriendEmail);

    //Globals.TOUCH-specific bindings to make tooltips friendly for Ricky's demos
    //specifically: tapping a book or vendor name a second time after spawning a tooltip there will cause it to go away
    //caveat: once you've dismissed a tooltip this way, you can't tap a third time to make it come up. tap a different item.
    if(Globals.TOUCH) {
        $(".course th, #headerTable tr td").click(function() {
            $(this).mouseleave();
            $(this).mouseout();
            $(this).blur();
        });
    }

    //Open up outgoing links on button press
    $('button.outgoing').live('click',function() {
        var $info = $(this).parent().siblings('#bookstoreLink');
        if($info) $info = $(this).parent().siblings('.lightboxHeader');
        var type,
            vendor,
            splitTest;

        if($info.html().indexOf("All") != -1) {
            type = 'bundle';
            splitText = $info.html().split(" ");
            if(splitText[5]) { vendor = splitText[4] + " " + splitText[5];}
            else { vendor = splitText[4];}
        } else {
            type = 'single';
            splitText = $info.html().split(" ");
            if(splitText[5]) { vendor = splitText[4] + " " + splitText[5];}
            else { vendor = splitText[4];}
        }

        window.open($(this).attr('data-url'));
    });

    // The same as the previous function, but for BDP links
    $('.bdp button').live('click',function() {
        var $info = $(this).siblings('.vendor');
        // FIXME: As of January 3, 2012, this line was breaking BDP:
        // It makes absolutely no sense. When this is refactored, heal it.
        // var price = parseFloat($info.siblings(".math:last .prices").html().substr(1));
        var type;
        var vendor;

        // FIXME: As of August 18, 2011, the local vars type and vendor make no
        // sense. This logic should be rethought.
        if ($info.length) { // $info will be empty for bookstore links
            if($info.html().indexOf("All") != -1) {
                type = 'bundle';
                var splitText = $info.html().split(" ");
                if(splitText[5]) { vendor = splitText[4] + " " + splitText[5];}
                else { vendor = splitText[4];}
            } else {
                type = 'single';
                var splitText = $info.html().split(" ");
                if(splitText[5]) { vendor = splitText[4] + " " + splitText[5];}
                else { vendor = splitText[4];}
            }
        }

        window.open($(this).attr('data-url'));
    });

    $('.bdp p a').live('click',function() {
        // TODO: grab more info from BDP (number of books, number of vendors), BDP funnel
        var vendor;
        var numBooks;

        var splitText = $(this).html().split(" ");
        if(splitText[4]) { vendor = splitText[3] + " " + splitText[4];}
        else { vendor = splitText[3];}
        numBooks = parseInt(splitText[0]);
    });

    // Analytics for the 'edit your courses' link when there's no books
    $('#editLink').click(function() {
        Analytics.trackEvent("UI","Closed Lightbox","Edit Link");
    });

    highlightLowestPrices();

    // TODO: Smooth this out.
    $("#top div, #top table, button, #headerTable, #headerTable td, #instructions").fadeIn("fast").show(); /* redundant .show() is for IE */

    // Bring back the lightbox.
    $("#simple").click(function(){
        $.lightbox({content: $("#initialOverviewText").html(), touch: Globals.TOUCH} );
        Analytics.trackEvent('UI','Clicked Recommendation Button');
        return false;
    });

    // Information about vendors.
    $("#headerTable tr td").friendlyHover(function() {
        $(this).tooltip({
            width:340,
            side:'top',
            html:tooltipText(this),
            type: 'hover',
            canMouseIn:false,
            touch: Globals.TOUCH
        });
        Analytics.trackEvent("UI","Vendor Tooltip",$.trim($(this).html()));
        return false;
    });

    // Used books from the bookstore.
    $(".course td").friendlyHover(function(){
        if ( $(this).hasAttr("data-used") ) {
            var msg = "You may be able to get this book used for <span class='money'>$" + $(this).attr('data-used') + "</span>.";
        } else if ( $(this).hasAttr("data-unknown") ) {
            var msg = "We can't find a price for this book. Check back later.";
        } else {
             return;
        }
        $(this).tooltip({
            side:'top',
            html:msg,
            width:200,
            type: 'hover',
            touch: Globals.TOUCH
        });
    });

    $(".course th").friendlyHover(bookTooltip);   // Show book tooltip

    $("#totals td, table.course td").click(outgoingLink);           // All table cells get caught by outgoingLink.

    // When hovering on price totals, notifies user how many books are included.
    $("#totals td").friendlyHover(function(){
         $(this).tooltip({
            side:'top',
            html:$(this).attr('data-status'),
            width:200,
            type: 'hover',
            touch: Globals.TOUCH
        });
    });

    // Highlight for hovering over a single book price cell
    $("table.course:not(#derpTable) td").hover(
         function(){
             if ( $(this).hasClass("empty") ) return;   // No highlighting empty cells.
             $(this).siblings("th").addClass("rowHighlight");
             $("#headerTable tr td:nth-child(" + ($(this).index()+1) + ")").addClass("headerHighlight");

             $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").addClass("rowHighlight");
             $(this).siblings("td").addClass("rowHighlight");

             $(this).removeClass("rowHighlight");
             $(this).addClass("cellHighlight");
         },
         function(){        // Mirror of above function.
             if ( $(this).hasClass("empty") ) return;
             $(this).siblings("th").removeClass("rowHighlight");
             $("#headerTable tr td:nth-child(" + ($(this).index()+1) + ")").removeClass("headerHighlight");

             $(this).siblings("td").removeClass("rowHighlight");
              $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").removeClass("rowHighlight");

             $(this).removeClass("cellHighlight");
         }
    );

    // Highlight for hovering over a package deal
    $("table#totals td, table#derpTable td").hover(
         function(){
             if ( $(this).hasClass("empty") ) return;   // No highlighting empty cells.
             $("#headerTable tr td:nth-child(" + ($(this).index()+1) + ")").addClass("headerHighlight");

             $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").addClass("rowHighlight");

             $(this).removeClass("rowHighlight");
             $(this).addClass("cellHighlight");
         },
         function(){        // Mirror of above function.
             if ( $(this).hasClass("empty") ) return;
             $("#headerTable tr td:nth-child(" + ($(this).index()+1) + ")").removeClass("headerHighlight");

              $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").removeClass("rowHighlight");

             $(this).removeClass("cellHighlight");
         }
    );

    // Highlight for hovering over a vendor
    $("#headerTable tr td").hover(
        function() {
            $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").addClass("rowHighlight");
        },
        function() {
            $(".course tr td:nth-child(" + ($(this).index()+1) + "), #totals tr td:nth-child(" + ($(this).index()+1) + ")").removeClass("rowHighlight");
        }
    )

    // Checkbox for being warned about leaving the site.
    $("#check").live('click', function(){
        $.lightbox.close();
        Analytics.trackEvent("UI","Closed Lightbox","Link");
    });

    // Spawn an outgoing link lightbox (BDP or vendor bundle) from the overview lightbox
    $("#lightbox h2 button").live('click', function(){

        /* we need to set up the link, the cell, and the false.
        addLightboxLink

        if bestdealperiod, it has an arbitrary blob. Else, should set up a similar link to table:
            - data-price
            - data-numbooks
            - a link */
            var likebox = '<p class="centered"><iframe id="fbfanpage" src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fgetchabooks&amp;width=240&amp;colorscheme=dark&amp;show_faces=false&amp;stream=false&amp;header=false&amp;height=70" scrolling="no" frameborder="0" allowTransparency="true"></iframe></p>'

        var confirm = $(this).attr("data-confirm");
        if ( confirm !== undefined ) {
            percent = $(this).attr("data-saved");
            button = $(this).attr("data-button");
            if ( $(this).hasClass("bestdealperiod") ){ //code for BDP lightbox
                out = bdpHeader + bestDeal + confirm;
                var w = 600;

                Analytics.trackPage('lightbox/bdp');
                Analytics.trackEvent('Flow','BDP Lightbox');
            } else { //code for vendor bundle lightbox
                var w = 560;
                var vendor = $(this).attr('data-vendor');
                out = confirm + addLightboxHeader(vendor,true);

                Analytics.trackPage('lightbox/overview-bundle');
                Analytics.trackEvent('Flow','Bundle (from recommendations)', vendor);
            }

            var text = "<div class='math'><span class='label leftText'>total price:</span><span class='prices rightText'>$" + $(this).attr('data-price') + "</span></div>";
            out += text;
            if(button) out += button;
            out += promotion;
            out += likebox;

            $.lightbox({content: out, width: w, touch: Globals.TOUCH});
            Analytics.trackEvent("UI","Closed Lightbox","Spawned Sub-Lightbox");
            Analytics.trackEvent("Flow","Closed recommendation lightbox","Sub-Lightbox");
        }

        return false;
    });

    // Link to an individual course.
    $(".emailShare").live('click', function(){
        var label = $(this).parent().siblings("div.text").text();
        var url = $(this).attr("data-url");
        var id = $(this).attr("data-id");
        linkLightbox(id, label, true);
        return false;
    });

    // Link to this page.
    $(".save, .bookmark").live('click', function(){
        linkLightbox(Globals.IDS,'', false);
        return false;
    });
}


/*
 * TODO: Rethink this in context of new social media strategy and sharing vs. saving.
 * Displays a lightbox containing a link to a results page to either share with friends (one course) or save for later (all courses)
 * @param   course      The course(s) to display. Set to false for all courses.
 * @param   label       The text to show for the link
 * @param   save    If true, the link is one to share your coursees. If false, to save.
 */
function linkLightbox(ids, label, share){
    var url = Globals.BASE_URL;
    if(Globals.SCHOOL_SLUG) {
        url += Globals.SCHOOL_SLUG + "/";
    }
    url += "results/" + ids;

    if(share) {
        url += '/share';
    } else {
        url += '/saved';
    }

    // We use a different container for desktop and mobile such that the url is optimally selectable on both.
    var link;
    if (Globals.TOUCH) {
        link = "<p class='glorifiedLink'>" + url + "</p>";
    } else {
        link = "<input class='glorifiedLink' value='" + url + "' onClick='select()' readonly></input>";
    }

    var msg, firstInput;
    if (share){ // for a single course
        var courseName = "<p class='first lightboxHeader centered'>" + label + "</p>";
        var share = "<p>Fill this in and we'll send your friend an email with a link to this course's textbooks.</p>";

        var email =  "<p class='nospam' style='display:none'>(We promise not to spam you!)</p><form id='friendForm'>";
            email += "<span class='friendShareLabel'>your email:</span><input type='text' name='yourEmail' size='100' id='yourEmail' tabindex='2'/><br />";
            email += "<span class='friendShareLabel'>friend's email:</span><input type='text' name='friendEmail' size='100' id='friendEmail' tabindex='3'/><br />";
            email += "<button id='friendSend' type='submit' tabindex='4' value='Send' data-id='" + ids + "'>Send</button>";
            email += "<p id='formMsg'></p></form>";

        var shareEnd = "<p class='centered' style='margin-top:40px !important;'></p>";
        var also = "<p>You can also send them this link:</p>";

        msg = courseName + share + email + also + link + shareEnd;
        firstInput = "#yourEmail";

    } else {            // for all courses
        //logic to show cmd+d or ctrl+d shortcut based on OS
        var modifier;
        if (navigator.appVersion.indexOf("Mac") != -1) {
            modifier = "&#8984;";
        } else {
            modifier = "Ctrl+";
        }

        var saveHeader = "<p class='first lightboxHeader centered'>Want to come back later?</p>";
        var email = "<p>Enter your email and we'll send you a link to return to this page with all of your courses intact.</p><p class='nospam' style='display:none'>(We promise not to spam you!)</p><form id='saveForm'><span>your email:</span><input type='text' name='email' size='100' id='email' tabindex='1'/><button id='saveSend' type='submit' tabindex='2' value='Send'>Send</button><p id='formMsg'></p></form>";
        var save = "<p class='bookmarkCopy'>You can also save or bookmark this link:</p>";
        var bookmark = Globals.TOUCH ? "" : "<p>Add this page to your bookmarks by pressing <span class='price'>" + modifier + "D</span>.</p>";

        msg = saveHeader + email + save + link + bookmark;// + thanks;
        firstInput = "#saveForm input[name='email']";

        Analytics.trackEvent('Viral','Save Lightbox',url);
    }

    $.lightbox({content: msg, width: 560, touch: Globals.TOUCH, onCreate: function() {
        $(firstInput).focus();
    }});
}

function sendFriendEmail() {
    var id = $("#friendSend").attr('data-id');
    Analytics.trackEvent("Viral","Sent Share Email",id);

    var yourEmail   = $("#friendForm input[name='yourEmail']").val();
    //var yourName    = $("#friendForm input[name='yourName']").val();
    var friendEmail = $("#friendForm input[name='friendEmail']").val();

    if ( validateEmail(yourEmail) === false ) {
        $("#formMsg").hide().html("Your email address doesn't appear to be valid.").fadeIn('fast');
    }
    /*
    else if ( yourName === "") {
        $("#formMsg").hide().html("You forgot to put your name!").fadeIn('fast');
    }
    */
    else if ( validateEmail(friendEmail) === false ) {
        $("#formMsg").hide().html("Your friend's email address doesn't appear to be valid.").fadeIn('fast');
    }
    else {
        var url = Globals.FRIEND_EMAIL_URL + yourEmail + '/' + friendEmail + '/' + Globals.SCHOOL_SLUG + '/';
        url += Globals.CAMPUS_SLUG ? Globals.CAMPUS_SLUG + '/' : '';
        url += Globals.TERM_SLUG + '/' + id;

        var msg = "<p class='first lightboxHeader centered'>Sending...</p><p style='text-align:center; margin-top:40px; margin-bottom:80px;'><img src='" + Globals.IMG_PATH + "lightbox-ajax-loader.gif'></p>";
        $.lightbox({content: msg, width: 560, touch: Globals.TOUCH});

        $.getJSON(url, function(data) {
            var msg;
            if (data) {
                msg = "<p class='first lightboxHeader centered'>Success!</p><p>We just emailed your friend a link that will take him or her to a page with the textbooks for his or her course.</p><p>You're a good friend, you know that?</p>";
            }
            else {
                msg = "<p class='first lightboxHeader centered'>Oh no!</p><p>An unexpected error has occurred. Please try again later.</p>";
            }
            $("#lightbox").children('p, form').remove();
            $(msg).hide().appendTo($("#lightbox")).fadeIn();
        });

    }
    return false;
}

function sendSaveEmail() {
    Analytics.trackEvent("Viral","Sent Save Email");
    var email = $("#saveForm input[name='email']").val();
    if ( validateEmail(email) ) {
        var msg = "<p class='first lightboxHeader centered'>Sending...</p><p style='text-align:center; margin-top:40px; margin-bottom:80px;'><img src='" + Globals.IMG_PATH + "lightbox-ajax-loader.gif'></p>";
        $.lightbox({content: msg, width: 560, touch: Globals.TOUCH});

        var url = Globals.SAVE_EMAIL_URL + email + '/';
        url += Globals.SCHOOL_SLUG ? Globals.SCHOOL_SLUG : 'isbn';
        url += Globals.CAMPUS_SLUG ? '/' + Globals.CAMPUS_SLUG : '';
        url += '/' + Globals.TERM_SLUG;
        url += '/' + Globals.IDS;

        $.getJSON(url, function(data) {
            var msg;
            if (data) {
                msg = "<p class='first lightboxHeader centered'>Success!</p><p>We've just emailed you a link that will take you right back to this page with all of your courses. Check your inbox.</p><p>Thanks for choosing " + Globals.SITE_NAME + "! We'll see you soon.</p>";
            }
            else {
                msg = "<p class='first lightboxHeader centered'>Oh no!</p><p>An unexpected error has occurred. Please try again later.</p>";
            }
            $("#lightbox").children('p').remove();
            $(msg).hide().appendTo($("#lightbox")).fadeIn();
        });

        return false;
    }
    else {
        $("#formMsg").hide().html("Your email address doesn't appear to be valid.").fadeIn('fast');
    }

    return false;
}

/*
 * tooltipText(obj)
 * When given an object (a tab of the headerTable), this returns the appropriate tooltip text.
 * Honestly, this isn't a beautiful function.
 */
function tooltipText(obj){
    var index = $(obj).index();
    var vendorName = $(obj).text();
    if (vendorName == "Bookstore") vendorName = "the school bookstore";
    return $(obj).attr('data-description');
}

/*
 * outgoingLink()
 * Grabs an external link from the table, checks it for validity, and shows a warning to the user.
 */
function outgoingLink() {
    /*
    if ( $(this).attr("data-unknown") == "true" ) {
        return;
    }
    */
    percent = $(this).attr('data-saved');

    var $link = $("a", this);   // Check for valid link.
    if ( $link.length != 1 ) return;

    var $cell = $link.parent();

    vendorLightbox($cell, $link);   // change to false to make identical to overview

    return false;
}

/*
 * Generates actual lightbox for a given Vendor, given correct data
 * @param $cell  A table cell containing data-attributes for the subtotal, shipping and total prices
 * $link  A table <a> tag containing data-attributes for the link text and href
 * warning  Bool for tacking on a warning (don't show this again).
 */
function vendorLightbox($cell, $link) {
    var vendor = $.trim($("#headerTable tr td:nth-child(" + ($cell.index()+1) + ")").html());
    var isBundle = $cell.attr('data-status');
    var likebox = '<p class="centered"><iframe id="fbfanpage" src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fgetchabooks&amp;width=240&amp;colorscheme=dark&amp;show_faces=false&amp;stream=false&amp;header=false&amp;height=70" scrolling="no" frameborder="0" allowTransparency="true"></iframe></p>'
    var likebox2 = '<p class="centered" style="padding-top: 20px; padding-bottom:0; margin:0;"><iframe src="http://www.facebook.com/plugins/like.php?href=facebook.com%2Fgetchabooks&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=dark&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe></p>';

    if( confirm !== undefined ) {
        out = addLightboxLink($link) + addLightboxHeader(vendor,isBundle) + addLightboxPriceTabulation($cell) + addLightboxBuyButton($link) + promotion + likebox;

        var w = 560;
        if(Globals.TOUCH) { w = 580; }

        $.lightbox({content: out, width:w, touch: Globals.TOUCH});
    }

    //stats
    var statsUrl;
    if(isBundle) {
        Analytics.trackPage('lightbox/table-bundle');
        Analytics.trackEvent('Flow','Bundle (Table)',vendor);
    } else {
        var course = $cell.siblings("th").find('.tooltip .isbn .isbn').html();

        Analytics.trackPage('lightbox/single');
        Analytics.trackEvent('Flow','Single Book',vendor,$.trim(course));
    }
}


/**
* Generates the formatted price breakdown for a book
* @param $cell  A table cell containing data-attributes for the subtotal, shipping and total prices
* @return   Fomatted HTML to output the prices in a friendly format
*/
function addLightboxPriceTabulation($cell) {
    var text;
    if($cell.attr('data-price')) {
        if($cell.attr('data-subtotal') && $cell.attr('data-shipping')) { //single book
            text = "<div class='math'><span class='prices leftText'>$" + $cell.attr('data-subtotal') + "</span><span class='label rightText'>subtotal</span></div>";
            text = text + "<div class='math'><span class='prices leftText underline'>+ $" + $cell.attr('data-shipping') + "</span><span class='label rightText'>tax/shipping</span></div>";
            text = text + "<div class='math'><span class='prices leftText'>$" + $cell.attr('data-price') + "</span><span class='label rightText'>total</span></div>";
        } else { //vendor bundle
            text = "<div class='math'><span class='label leftText'>total price:</span><span class='prices rightText'>$" + $cell.attr('data-price') + "</span></div>";
        }
     }
     return text;
}

/**
* Generates the formatted price breakdown for a book
* @param link   A table <a> tag containing data-attributes for the link text and href
* @return   Fomatted HTML to output the link
*/
function addLightboxLink($link) {
    var confirm = $link.attr("data-confirm");
    var confirmlink = $link.attr("href");
    return "<p class='lightboxHeader first centered' id='bookstoreLink'>" + confirm + "</p>";
}

function addLightboxBuyButton($link) {
    var confirmlink = $link.attr('href');
    var text = "<p class='centered'><button class='outgoing' data-url='" + confirmlink + "'>";
    if($link.attr('data-confirm').indexOf('Chegg') != -1) {
        text += 'Rent';
    } else {
        text += 'Buy';
    }

    text += "</button></p>";

    return text;
}

/**
* Generates lightbox text with the vendor name included
* @param vendor     The name of the vendor, in text
*/
function addLightboxHeader(vendor, isBundle) {
    var outputVendor = vendor;
    if(vendor == "Bookstore") {
        outputVendor = "your bookstore";
    }

    var first = outgoing + outgoing2;
    if(isBundle && $('#totals').length != 0) {
        first = outgoing + "s" + outgoing2;
    }

    return first + $.trim(outputVendor) + outgoing3;    // trim is a hack. the worst hack.
}

/*
 * highlightLowestPrices()
 * Called whenever a vendor's enabled state is changed, this function highlights *all of the cells in a row* with the lowest price.
 * Runs in 3N time, where N is number of vendors.
 */
function highlightLowestPrices(){

    $("table.course, table#totals").children().children().each(function(){
        $(this).children("td").removeClass("best");

        // Set up the prices.
        var prices = new Array();
        $(this).children("td").each(function(){
            if ( ($(this).attr('data-price') != "-1" ) ){
                prices.push( parseFloat( $(this).attr('data-price') ) );    // parseFloat: string -> float
            } else {
                prices.push(9001);  // It's over 9,000!
            }
        });

        // Find lowest price...
        var min = 9000;
        var index = -1;
        for ( var i=0; i<prices.length; i++ ) {
            if ( prices[i] < min ){
                min = prices[i];
                index = i;
            }
        }

        if (index == -1) return;    // There is no minimum. Everything is bad data.

        // Highlight all vendors with this minimum price.
        $(this).children().each(function(){
            if ( $(this).attr('data-price') == min ) {
                $(this).addClass("best");
                return false;
            }
        });
    });
}

/*
 * bookTooltip()
 * Grabs data for a book preview tooltip and spawns it.
 */
function bookTooltip() {
    var string = $(this).children(".tooltip").html();

    var width;
    if($("#headerTable").hasClass("wide")) { // ISBN mode
        width = 565;
    } else { // Course mode
        width = 600;
    }

    $(this).children(".bookdata").tooltip({
        side:'right',
        html:string,
        width:width,
        height:262,
        type: 'hover',
        canMouseIn:true,
        touch: Globals.TOUCH
    });

    $(".tooltip h1").fitText(60);

    var title = $(this).find(".bookdata .title").html();
    Analytics.trackEvent("UI","Book Tooltip",$.trim(title));
    return false;
}


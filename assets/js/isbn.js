/*global $, Globals, Analytics */

/* ISBN: Concerned with the following ideas:
 *   Adding books to the Selection items list through an Autocomplete interface
 *   Giving the user feedback about partial ISBNs
 */

var isbnAutocomplete = $.autocomplete({
    type: "remote",
    inputSelector: "#searchBox",
    outputContainerSelector: "#autocompleteResults",
    ajaxThrottleTimeout: 200,
    hideOnBlur: !Globals.TOUCH,
    hideOnEmptySearch: true,
    touch: Globals.TOUCH
},{
    ajaxURL: function() {
        return Globals.BASE_URL + "get/book/";
    },

    stringifyListItem: function(object, isbn) {
        var s = '';
        if (object) {
            if (object.error) {
                // If the ISBN appears valid, but the server said it wasn't, give a nice error message.
                if (ISBN.validate10(isbn) || ISBN.validate13(isbn)) {
                    s += "<li class='error'>We're sorry, something went wrong with <span class='title'>" + isbn + "</span>.<br /> Although it looks like a valid ISBN, we couldn't find an associated book.</li>";
                } else {
                    // If it's entirely numeric.
                    if (/^[xX\d]*$/.test(isbn)) {
                        if (isbn.length === 10 || isbn.length === 13) {
                            s += "<li class='error'>Although <span class='title'>" + isbn + "</span> is a " + isbn.length + " digit number, it isn't a valid ISBN.<br />Double-check that you've typed it in properly.";
                        }
                        else if (isbn.length < 13) {
                            s += "<li class='error inProgress'><strong>Keep going.</strong><span class='title'> " + isbn + "</span> isn't an ISBN, yet.<br />You've entered " + isbn.length + " numbers. An ISBN is a 10 or 13 digit number.</li>";
                        }
                        else {
                            s += "<li class='error inProgress'>Sorry, <span class='title'>" + isbn + "</span> isn't a valid ISBN. It has " + isbn.length + " ditits.<br />An ISBN has 10 or 13 digits. Double-check that you've typed it in properly.</li>";
                        }
                    }
                    // It isn't numeric.
                    else {
                        s += "<li class='error'>Sorry, <span class='title'>" + isbn + "</span> isn't a valid ISBN.<br />Remember, an ISBN is a 10 or 13 digit <strong>number</strong>.</li>";
                    }
                }

                // s += "<li class='error'><span class='title'>" + isbn + "</span><br />Sorry, we couldn't locate that ISBN.</li>";
            }
            else if (Selection.itemAlreadyAdded(isbn)) {
                s += "<li class='error'><span class='title'>" + object.data.title + "</span><br />";
                s += "You've already added this item.</li>";
            }
            else { // Valid
                s += "<li data-id='" + object.itemId + "'>";
                s += "<span class='title'>"  + object.data.title  + "</span><br />";
                s += "<span class='author'>" + object.data.author + "</span></li>";
            }
        }
        else {
            // TODO: When can this happen?
            s += "<li class='error'><span class='title'>" + isbn + "</span><br />Invalid ISBN</li>";
        }
        return s;
    },

    filterQuery: function(query) {
        // Can't send forward slashes to the server.
        query = query.replace(/\//g,"");

        query = query.replace(/-/g,"");
        query = query.replace(/\s/g,"");
        return query;
    },

    listItemWasSelected: function(elem) {
        if (elem.hasClass('error')) { return; }

        Selection.addItem(elem.attr('data-id'));
        Selection.autocomplete.clearAndHide();
    },

    onSuccessfulSearch: function() {
        Selection.closeAutocompleteTooltip();
    }

});

var ISBN = {
    // constants
    ISBN_REGEX: /^(\d{10}|\d{9}X|\d{13})$/,
    AUTOCOMPLETE_TOOLTIP_TEXT: "<h2 class='isbn'>Type or paste in the ISBNs of your books.</h2><div class='instructions'><p>An ISBN is a 10 or 13 digit number associated with a book. For example, the IBSN for <em>Gone With the Wind</em> is <span class='green'>1416548890</span>.</div>",
    ADD_ITEM_URL: function () {
        return Globals.BASE_URL + "get/book/";
    },

    // state
    autocomplete: isbnAutocomplete,

    // functions
    init: function() {
        ISBN.autocomplete.init();
        ISBN.autocomplete.focus();
        if (Selection.displayedItems.length === 0) {
            ISBN.showAutocompleteTooltip();
        }
        // DIRTY TOUCH HACK FROM January 13, 2012
        if (Globals.TOUCH) {
            $("#isbnhelp").text("Show Instructions");
        }

        $("#isbnhelp").click(ISBN.showHelp);
    },

    // Our API takes a list of books and returns an array of book information.
    // This is ideal when rendering the Autocomplete list, which expects an array
    // to loop through, but unideal when adding a single item. Therefore, we only
    // look at the first item.
    isItemValid: function(id, json) {
        var book = json[0];
        return !book.error;
    },

    // Same concerns as the above function, isItemValid.
    stringifyItem: function(id, json) {
        var book = json[0];
        var html = "<h2>" + book.data.title + "</h2>";
        if (book.data.author) {
            html += "<strong>" + book.data.author + "</strong>";
        }

        if (book.itemId) {
            html += (book.data.author ? " (ISBN: " + book.itemId + ")" : book.itemId);
        }

        return html;
    },

    validate13: function(isbn) {
        if (isbn.length != 13) { return false; }

        var xs = _.map(isbn.split(""), function(x){ return parseInt(x, 10); } );
        var sum = 0;
        for (var i=0; i<12; i++) {
            sum += (i%2 === 0 ? xs[i] : 3*xs[i]);
        }
        return (xs[12] === (10 - (sum%10))%10);
    },

    validate10: function(isbn) {
        if (isbn.length != 10) { return false; }

        var sum = 0;
        for (var i = 0; i < 10; i++) {
            if (isbn[i] === 'X') {
                sum += 10 * (10 - i);
            } else {
                sum += isbn[i] * (10 - i);
            }
        }
        return (sum % 11 === 0);
    },

    showHelp: function() {
        // DIRTY TOUCH HACK FROM January 13, 2012
        if (Globals.TOUCH) {
            if ($(".tooltip").length) { return; }
            ISBN.showAutocompleteTooltip();
            $("#isbnhelp").text("Show Instructions");
            return;
        }
        console.log("NO");
        if (Selection.isAutocompleteTooltipVisible()) {
            ISBN.closeAutocompleteTooltip();
        } else {
            ISBN.showAutocompleteTooltip();
            Analytics.trackEvent("UI","ISBN Help Button");
        }
    },

    parseHash: function(hash) {
        var items = hash.substring(2).split(Globals.SECTION_DELIMITER);

        _.each(items, function(item){
            if (item === "") { return; }
            Selection.addItem(item);
        });

        return true;
    },

    buildHash: function() {
        return "?/" + Selection.addedItems().join(Globals.SECTION_DELIMITER);
    },

    showAutocompleteTooltip: function() {
        $("#isbnhelp").text("Hide Instructions");
        $(ISBN.autocomplete.inputSelector).tooltip({
            side: "bottom",
            html: ISBN.AUTOCOMPLETE_TOOLTIP_TEXT,
            width: 560,
            type: 'important'
        });
    },

    closeAutocompleteTooltip: function() {
        $("#isbnhelp").text("Show Instructions");
        $.tooltip.closeImportant();
    }
};


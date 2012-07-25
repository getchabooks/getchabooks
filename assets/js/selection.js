/*global $, Globals, Analytics */

/* Selection: Concerned with the following ideas:
 *   adding and removing "items" to a list
 *   updating the hash component of the URL for persistence
 *   successfully sending users to Results.
 *
 * Selection useds Globals.TYPE to decide whether to merge Course or ISBN into itself.
 * It calls Selection.init() to set up Course/ISBN specifics.
 */

var Selection = (function() {

    var addedItems = [],
        displayedItems = [],

        CURRENTLY_NO_ITEMS_HTML = "<div id='noItems'>Your " + Globals.ITEM_NAME + " list is currently empty.</div>",
        publicObject;

    function displayItemInformation(id, string) {
        var thing = "#" + htmlID(id);

        $(thing).html(string)
                .removeClass('loading')
                .append("<img src='" + Globals.BASE_URL + "/images/cancel.png' class='removeItem'/>");
    }

    /* Each item in #items has two identifiers.
     * 'id' is an html-friendly attribute for DOM manipulation.
     * 'data-id' is a pure ID used for display and existence in `items`
     * This function generate 'id' from 'data-id'.
     */
    function htmlID(id) {
        return "item" + id.replace(/[^A-Za-z 0-9]+/g,'');
    }

    function displayErrorInList(id) {
        displayItemInformation(id, "<h2>Invalid " + Globals.TYPE + ": " + id + "</h2>We're sorry. Please try again.");
    }

    function addItem(id) {
        if (itemAlreadyAdded(id)) { 
            return showDuplicateError(htmlID(id)); 
        }

        var html = $("<div class='item loading' id='" + htmlID(id) + "' data-id='" + id + "'><img src='" + Globals.BASE_URL + "/images/ajax-loader.gif'></div>");

        if (displayedItems.length === 0) {
            $('#items').html(html); // Kills the "you have no <item>" text
        } else {
            $('#items').prepend(html); // Adds to the top of the list
        }

        displayedItems.push(id);

        // We purposedly suppress the global error handler here.
        $.cachedAjax({
            suppressErrors: true,
            url: removeAmpersandsFromString(publicObject.ADD_ITEM_URL() + id),
            dataType: "json",
            success: function(json) {
                if (publicObject.isItemValid(id, json)) {
                    // Actually add the item and update state.
                    addedItems.push(id);
                    displayItemInformation(id, publicObject.stringifyItem(id, json));
                    updateWindowHashAndNavigationButton();
                } else {
                    displayErrorInList(id);
                }
            },
            error: function(json) {
                displayErrorInList(id);
            }
        });
    }

    function removeItem() {
        var item_div = $(this).parent(),
            item_id = $(item_div).attr('data-id');

        // Update internal state
        displayedItems = _.filter(displayedItems, function(value) {
            return value !== item_id;
        });
        addedItems = _.filter(addedItems, function(value) {
            return value !== item_id;
        });

        // display
        $(item_div).fadeOut(100, function() {
            $(this).remove();
        });

        updateWindowHashAndNavigationButton();

        if ($("#items").children().length <= 1) {
            // TODO: Unify the display of noItems html with the original setup function (DRY)
            $("#items").hide().html(CURRENTLY_NO_ITEMS_HTML).fadeIn();
        }
    }

    function clearItems() {
        displayedItems = [];
        addedItems = [];

        $("#items").hide().html(CURRENTLY_NO_ITEMS_HTML).fadeIn();
        updateWindowHashAndNavigationButton();

    }

    function showDuplicateError(htmlID) {
        $("#"+htmlID).tooltip({
            side: "bottom",
            html: "<h2>Sorry, you've already added this " + Globals.ITEM_NAME + ".</h2>",
            width: 450,
            type: 'standard'
        });
        return false;
    }

    function itemAlreadyAdded(identifier) {
        return (_.indexOf(addedItems, identifier) !== -1);
    }

    // TODO: Instead of using JavaScript to redirect, on each state change, we can update a hyperlink on the "Go" button.
    // That way, it can be opened up in a new tab.
    function navigateToResults() {
        if (addedItems && addedItems.length !== 0) {
            // Analytics.trackEvent("Stats","Item Count",currentMode.name.capitalize(),Selection.addedItems.length);
            window.location = "../results/" + removeAmpersandsFromString(Selection.buildHash(addedItems).substring(2));
        }
    }

    // TODO: Try the hyperlink thing.
    function updateWindowHashAndNavigationButton() {

        window.location.replace("#" + Selection.buildHash(addedItems));

        if (addedItems.length > 0 ) {
            $("#go").fadeIn("fast").show();   // .show fixes an IE bug. Do not remove.
        }
        else {
            $("#go").fadeOut("fast");
        }
    }

    // Is this function necessary?
    function isAutocompleteTooltipVisible() {
        return $(publicObject.autocomplete.inputSelector).hasClass("hasTooltip");
    }

    function removeAmpersandsFromString(s) {
        return (s.replace(/&amp;/g, "&")).replace(/&/g, "&amp;");
    }

    // Release a public object.
    publicObject = {
        addedItems: function () {
            return addedItems;
        },
        displayedItems: displayedItems,
        addItem: addItem,
        removeItem: removeItem,
        clearItems: clearItems,
        itemAlreadyAdded: itemAlreadyAdded,
        updateWindowHashAndNavigationButton: updateWindowHashAndNavigationButton,
        isAutocompleteTooltipVisible: isAutocompleteTooltipVisible,
        removeAmpersandsFromString: removeAmpersandsFromString
    };

    // Extend the publicObject with the right child.
    if (Globals.TYPE === "ISBN") {
        $.extend(publicObject, ISBN);
    } else {
        $.extend(publicObject, Course);
    }

    // Register private click handlers.
    $(document).ready(function() {
        $("#go").on('click', navigateToResults);
        $("#items").on('click', '.removeItem', removeItem);
    });

    return publicObject;
})();

$(document).ready(function() {
    Globals.firstRun = true;

    var success = Selection.parseHash(window.location.hash.substring(1));
    if (success === false) {
        window.location.replace(window.location.href.split('#')[0]);
    }

    Selection.init();
});


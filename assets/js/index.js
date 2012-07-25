/*global Index, Globals, Analytics */

Index.VALID_WORD_SEPARATOR_CHARACTER = /^[\s\-]$/;

var Autocomplete = $.autocomplete({
    type: "local",
    inputSelector: "#searchBox",
    outputContainerSelector: "#list",
    touch: Globals.TOUCH
},{
    getLocalData: function(query) {
        return Index.LIST_OF_ALL_SCHOOLS;
    },
    filterLocalData: function(data, query) {
        if (query === "") { return data; }

        // Valid searches: ["mit", "cmu"]
        // Invalid searches: ["Ma**cMu**rray College"]
        var itemsMatchingNickName = _.filter(data, function(value) {
            if (!value || !value.nickname) return false;
            var index = value.nickname.toLowerCase().indexOf( query.toLowerCase() );
            return (index !== -1 && index === 0);
        });

        // Valid searches: ["College", "Tufts", "Boston University"]
        // Invalid searches: ["ufts", "on u"]
        var itemsMatchingFullName = _.filter(data, function(value) {
            if (!value || !value.name) return false;
            var index = value.name.toLowerCase().indexOf( query.toLowerCase() );
            return (index !== -1 && (index === 0 || Index.VALID_WORD_SEPARATOR_CHARACTER.test(value.name[index-1])));
        });

        return _.uniq( itemsMatchingNickName.concat(itemsMatchingFullName) );
    },
    stringifyListItem: function(object, query) {
        var url = Index.BASE_URL + object.slug + "/selection/";
        return '<li><a href="' + url + '">' + object.name + '</a></li>';    // data-url is used in navigateToSelectionFromList()
    },
    stringifyFailedSearch: function(query) {
        return Index.SCHOOL_NOT_FOUND_MESSAGE;
    },
    // By default, clicking an item is the same as selecting it with "enter".
    // On Index, click != enter. On click, we let the browser follow a hyperlink.
    clickListItem: function(e) {
        return;
    },
    listItemWasSelected: function(elem) {
        elem.addClass("special");
        window.location = $(elem).find("a").attr('href');
    }
});

function navigateToISBNSelection()
{
    Analytics.trackPage('isbn');
    Analytics.trackEvent('UI','Selected ISBN Mode','Button');
    window.location = Index.ISBN_URL;
}

function displaySearch()
{
    $("#go").hide();
    $("#select").show();

    Autocomplete.init();
    if (!Globals.TOUCH) {
        Autocomplete.focus();
    }
}

function displayLandingPageForSchool()
{
    $("#select").hide();
    $("#go").show();
}

// TODO: Revamp the school landing page.
function navigateToSelectionFromSchoolLandingPage()
{
    window.location = Index.BASE_URL + Index.SCHOOL_SLUG + "/selection/";
}

// We do not support versions of IE less than 8. We display a big message
// encouraging our users to get a better browser.
// Returns true if the user hates him or herself.
function userBrowsingWithUnsupportedIE()
{
    var s = navigator.userAgent.toLowerCase(),
        ielt8 = s.indexOf('msie 6') !== -1 || s.indexOf('msie 7') !== -1 || s.indexOf('msie 8') !== -1;
    return ielt8;
}

// jQuery setup for page:
$(document).ready(function(){
    if (userBrowsingWithUnsupportedIE()) {
        $("body").addClass("ie");
        return;
    }

    // School-specific Index:
    $("#change").click(displaySearch);
    $("#getStarted").click(navigateToSelectionFromSchoolLandingPage);

    // ISBN mode:
    $("#goISBN").click(navigateToISBNSelection);

    // Display the right content.
    if (Index.IS_SCHOOL){
        displayLandingPageForSchool();
    } else {
        displaySearch();
    }
});


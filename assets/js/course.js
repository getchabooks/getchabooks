/*global $, Globals, Analytics */

/* Course: Concerned with the following ideas:
 *   Picking a campus in a Multi-campus environment
 *   Adding courses to the Selection items list
 *   Displaying and interacting with the Browse interface
 *     (although Browse is kept in Browse.js, it is part of Course)
 *   Displaying and interacting with Course Autocomplete
 */

var courseAutocomplete = $.autocomplete({
    type: "remote",
    inputSelector: "#searchBox",
    outputContainerSelector: "#autocompleteResults",
    ajaxThrottleTimeout: 200,
    hideOnBlur: !Globals.TOUCH,
    hideOnEmptySearch: true,
    touch: Globals.TOUCH
},{
    ajaxURL: function() {
        var url = Globals.BASE_URL + "get/autocomplete/" + Globals.SCHOOL_SLUG;
        if (Globals.campusSlug) {
            return url + "/" + Globals.campusSlug + "/" + Globals.termSlug + "/";
        } else {
            return url + "/" + Globals.termSlug + "/";
        }
    },

    stringifyListItem: function(object, query) {
        query = query.toLowerCase();

        var s = "";
        var target = object.displayName.toLowerCase();
        var start = target.indexOf(query);
        var added = Selection.itemAlreadyAdded(object.slug);
        var bold = '';

        if (start !== -1) {
            bold += object.displayName.substr(0, start);           // before the bold
            bold += "<strong>";
            bold += object.displayName.substr(start, query.length);    // the bold part
            bold += "</strong>";
            bold +=  object.displayName.substr(start + query.length);  // after the bold
        } else {
            bold += object.displayName;
        }
        s += "<li data-id='" + object.slug + "'";
        if (added) { s += " class='error'"; }
        s += ">" + bold;
        if (added) { s += "<br />You've already added this course!"; }
        s += "</li>";

        return s;
    },

    stringifyFailedSearch: function(query) {
        if (query === "") { return ""; }

        return "<li class='error'><strong>We're sorry.</strong><br />There were no courses matching <strong>" + htmlEncode(query) + "</strong>.</li>";
    },

    listItemWasSelected: function(elem, event) {
        if (elem.hasClass('error')) { return; }

        Selection.addItem(elem.attr('data-id'));

        // Special secret for testing: hold shift.
        if (event && event.shiftKey) { return; }

        Selection.autocomplete.clearAndHide();
    },

    filterQuery: function(query) {
        // Can't send forward slashes to the server.
        query = query.replace(/\//g,"");

        // Changes "math 5" into "math 5".
        return (/\w* [0-9]+/.test(query) ? query.replace(" ", "") : query);
    },

    onSuccessfulSearch: function() {
        Selection.closeAutocompleteTooltip();
    }
    // TODO: Something about blurring
});

var Course = {
    INPUT_MODES: { GUIDED: "GUIDED", QUICK: "QUICK" },
    GET_CAMPUSES_URL: Globals.BASE_URL + "get/campuses/",
    GET_TERMS_URL: Globals.BASE_URL + "get/terms/",
    ADD_ITEM_URL: function () {
        var url = Globals.BASE_URL + "get/section/" + Globals.SCHOOL_SLUG + "/";
        if (Globals.campusSlug) {
            return url + Globals.campusSlug + "/" + Globals.termSlug + "/";
        } else {
            return url + Globals.termSlug + "/";
        }
    },

    // TODO: Can we base these example courses on actual course data? (i.e. "PSY101" for Tufts, but "02-485" for CMU)
    AUTOCOMPLETE_TOOLTIP_TEXT: (Globals.HAS_COURSE_DATA ?
                                "<h2>Type in the name of a course.</h2><p>Try something like <em>Introduction to Psychology</em>, <em>PSY101</em>, or a professor's name. If you're having trouble remembering your courses, try Guided Entry.</p>" :
                                "<h2>Type in the name of a course.</h2><p>To start, try the abbreviation for a department at your school. If you're having trouble remembering your courses, try Guided Entry.</p>"),

    inputMode: undefined,
    autocomplete: courseAutocomplete,

    setupGuidedEntry: function() {
        $("#browse").show();
        $("#toggle").text("Switch to Quick Entry");
    },

    setupQuickEntry: function() {
        $("#toggle").text("Switch to Guided Entry");
        $("#search").show();
        if (Selection.addedItems() && Selection.addedItems().length === 0) {
            Selection.showAutocompleteTooltip();
        }
        Selection.autocomplete.focus();
    },

    toggleEntryMode: function() {
        $.tooltip.closeImportant();
        var switchingFrom, switchingTo;

        // Switching from Guided to Quick
        if (Course.inputMode === Course.INPUT_MODES.GUIDED) {
            switchingFrom = "#browse";
            switchingTo = "#search";
            $("#toggle").text("Switch to Guided Entry");
            Course.inputMode = Course.INPUT_MODES.QUICK;
        }
        // Switching from Quick to Guided
        else if (Course.inputMode === Course.INPUT_MODES.QUICK) {
            switchingFrom = "#search";
            switchingTo = "#browse";
            $("#toggle").text("Switch to Quick Entry");
            Course.inputMode = Course.INPUT_MODES.GUIDED;
        }
        else {
            console.error("Course: bad mode state in toggleEntryMode()");
        }

        // TODO: make this 0 a variable
        $(switchingFrom).fadeOut(0, function(){
            $(switchingTo).fadeIn(0);

            Course.autocomplete.setQuery("");

            if (Course.inputMode === Course.INPUT_MODES.QUICK) {
                Course.autocomplete.focus();
                Selection.showAutocompleteTooltip();
            }
        });

        Selection.updateWindowHashAndNavigationButton();
    },

    init: function() {
        $(document).ready(function() {
            Course.autocomplete.init();
            Course.autocomplete.focus();

            $('#campus').change(campusWasPicked);
            $('#term').change(termWasPicked);

            if (Globals.MULTICAMPUS) {
                // TODO: switch to Course.something
                setupCampusSelector();
            } else {
                setupTermSelector();
            }

            if (Course.inputMode === Course.INPUT_MODES.GUIDED) {
                Course.setupGuidedEntry();
            }
            else if (Course.inputMode === Course.INPUT_MODES.QUICK) {
                Course.setupQuickEntry();
            }
            else {
                throw("Course: No mode given in init().");
            }

            $("#toggle").on('click', Course.toggleEntryMode);
            $("#campusToggle").on('click', function() {
                Analytics.trackEvent("UI","Campus Toggle Button");
                setupCampusSelector();
            });

            $("#termToggle").on('click', function() {
                Analytics.trackEvent("UI","Term Toggle Button");
                setupTermSelector();
            });
        });
    },

    parseHash: function(hash) {
        if (hash == '') {
            Course.inputMode = Course.INPUT_MODES.GUIDED;
            return true;
        } else if (hash === '?/') {
            Course.inputMode = Course.INPUT_MODES.GUIDED;
            return true;
        } else if (hash === '!/') {
            if (Globals.HAS_COURSE_DATA) {
                Course.inputMode = Course.INPUT_MODES.QUICK;
            } else {
                // Without course data, a '!' (autocomplete) URL makes no sense.
                Course.inputMode = Course.INPUT_MODES.GUIDED;
            }
            return true;
        }

        var re = /^(.)\/(?:([a-z0-9]+)\/)?(?:([a-z0-9]+)\/)(.*)$/,
            match = re.exec(hash);

        if (match === null) {
            return false;
        }

        if (match[1] === '!') {
            if (Globals.HAS_COURSE_DATA) {
                Course.inputMode = Course.INPUT_MODES.QUICK;
            } else {
                // Without course data, a '!' (autocomplete) URL makes no sense.
                Course.inputMode = Course.INPUT_MODES.GUIDED;
            }
        } else {  // '?' or something else
            Course.inputMode = Course.INPUT_MODES.GUIDED;
        }

        if (typeof match[4] === 'undefined') {  // single-campus
            Globals.termSlug = match[2];
            ids = match[3];
        } else {                                // multi-campus
            Globals.campusSlug = match[2];
            Globals.termSlug = match[3];
            ids = match[4];
        }

        _.each(ids.split(Globals.SECTION_DELIMITER), function (item) {
            if (item) {
                Selection.addItem(item);
            }
        });

        return true;
    },

    buildHash: function() {
        var hash;

        if (Course.inputMode === Course.INPUT_MODES.QUICK) {
            hash = '!/';
        } else {
            hash = '?/';
        }

        if (Globals.campusSlug) {
            hash += Globals.campusSlug + "/" + Globals.termSlug;
        } else {
            hash += Globals.termSlug;
        }

        return hash + "/" + Selection.addedItems().join(Globals.SECTION_DELIMITER);
    },

    // On Course Selection, the server returns a 500 on error.
    // Therefore, all items without 500s are valid.
    isItemValid: function(id, json) {
        return true;
    },

    stringifyItem: function(id, json) {
        var html = "<h2>" + json.deptAbbr + " " + json.courseNum;
        if (json.name) { html += ": " + json.name; }
        html += "</h2>";
        if (json.sectionNum) { html += "Section <strong>" + json.sectionNum + "</strong>"; }
        if (json.sectionNum && json.professor) { html += ", "; }
        if (json.professor) { html += "Professor <strong>" + json.professor + "</strong>"; }
        return html;
    },

    showAutocompleteTooltip: function() {
        $(Selection.autocomplete.inputSelector).tooltip({
            side: "bottom",
            html: Course.AUTOCOMPLETE_TOOLTIP_TEXT,
            width: 560,
            type: 'important'
        });
    },

    closeAutocompleteTooltip: function() {
        $.tooltip.closeImportant();
    }
};

// CAMPUSES
function setupCampusSelector()
{
    if (!(Globals.firstRun && Globals.campusSlug)) {
        $.tooltip.closeImportant(); // In case the autocomplete tooltip is up
        $("#campusWrapper select option[value='NULL']").attr('selected', 'selected');
        $("#topWrapper").clearQueue().fadeOut("fast",function() {
            $("#topWrapper").hide();
            $("#campusWrapper").clearQueue().fadeIn("fast");
        });

        $("#campus").html("<option value='NULL' selected='true'>Loading Campuses...</option>")
                    .attr("disabled", true);
    }

    $.cachedAjax({
        url: Selection.removeAmpersandsFromString(Course.GET_CAMPUSES_URL + Globals.SCHOOL_SLUG),
        dataType: "json",
        success: loadCampusesCallback
    });
}

function loadCampusesCallback(data) {
    $("#campus").html(stringifyCampusList(data))
                .attr("disabled", false);

    // select the campus from the URL hash
    if (Globals.firstRun && Globals.campusSlug) {
        Globals.campusId = Globals.campusIds[Globals.campusSlug];

        $("#campus option[value=" + Globals.campusId + "]").attr("selected", "selected");
        $("#campus").trigger('change');
    }
}

function stringifyCampusList(data)
{
    Globals.campusSlugs = {};
    Globals.campusIds = {};

    var s = "<option value='NULL' selected='true'>" + Globals.SCHOOL_NAME + " Campuses</option>";
    _.each(data, function(value){
        Globals.campusSlugs[value.id] = value.slug;
        Globals.campusIds[value.slug] = value.id;

        s += "<option value=" + value.id + ">" + value.name + "</option>";
    });
    return s;
}

function campusWasPicked()
{
    if ($(this).val() === "NULL"){
        $("#campus option[value=NULL]").attr("selected","selected");
        return;
    }

    if (Globals.CAMPUS_ID) {
        Globals.campusId = Globals.CAMPUS_ID;
    } else {
        var oldCampusId = Globals.campusId;
        Globals.campusId = $("#campus option:selected").val();
        Globals.campusSlug = Globals.campusSlugs[Globals.campusId];
        Globals.campusName = $("#campus option:selected").html();

        if (!Globals.firstRun && oldCampusId !== Globals.campusId) {
            Selection.clearItems();
        }
    }

    $("#campusName").html(Globals.campusName);

    $("#campusWrapper").clearQueue().fadeOut("fast",function() {
        $(this).hide();
        $("#topWrapper").clearQueue().fadeIn("fast");
    });

    Analytics.trackEvent("Flow","Select Campus",Globals.SCHOOL_SLUG,Globals.campusName);

    Course.setupGuidedEntry();
    Globals.termId = null;
    $("#term option[value=NULL]").attr("selected", "selected");
    $("#department option[value=NULL]").attr("selected", "selected");
    $("#course option[value=NULL]").attr("selected","selected");
    $("#section option[value=NULL]").attr("selected", "selected");

    $("#term").attr("disabled","true");
    $("#department").attr("disabled","true");
    $("#course").attr("disabled","true");
    $("#section").attr("disabled","true");

    setupTermSelector();

}

function setupTermSelector()
{
    if (Globals.termId !== null) {
        $.tooltip.closeImportant();
        $("#topWrapper").clearQueue().fadeOut("fast", function() {
            $("#topWrapper").hide();
            $("#termWrapper").clearQueue().show().fadeIn("fast");
        });
    }

    $("#term").html("<option value='NULL' selected='true'>Loading Terms...</option>")
              .attr("disabled", true);

    $.cachedAjax({
        url: Selection.removeAmpersandsFromString(Course.GET_TERMS_URL + Globals.campusId),
        dataType: "json",
        success: loadTermsCallback
    });


}

function loadTermsCallback(data)
{

    $("#term").html(stringifyTermList(data))
              .attr("disabled", false);

    /* select the term from the URL hash.
     * when a user selects a campus on multi-campus, a term is always
     * automatically selected, so the URL will always have both a campus and
     * term slug, so it is ok to only reset Globals.firstRun in
     * setupTermSelector() and not also setupCampusSelector()
     */
    if (Globals.firstRun && Globals.termSlug) {

        $("#term option[value=" + Globals.termIds[Globals.termSlug] + "]").attr("selected","selected");
        $("#term").trigger('change');

    } else if (Globals.termId === null) {
        // campus changed: select the default term and hide the term selector
        _.each(data, function (term) {
            if (term.selected) {
                $("#term option[value=" + term.id + "]").attr('selected', 'selected');
            }
        });

        $("#termWrapper").clearQueue().fadeOut("fast",function() {
            $(this).hide();
            $("#topWrapper").clearQueue().fadeIn("fast");
        });

        $("#term").trigger('change');
    }
}


function termWasPicked()
{
    if ($(this).val() === "NULL"){
        $("#term option[value=NULL]").attr("selected","selected");
        return;
    }

    var oldTermId = Globals.termId;
    Globals.termId = $("#term option:selected").val();
    Globals.termSlug = Globals.termSlugs[Globals.termId];
    Globals.termName = $("#term option:selected").html();
    Globals.termHasCourseData = $("#term option:selected").hasAttr("data-hascoursedata");

    if (!Globals.firstRun && oldTermId !== Globals.termId) {
        Selection.clearItems();
    }

    $("#termName").html(Globals.termName);

    if (Globals.firstRun) {
        Globals.firstRun = false;
    } else  {
        $("#termWrapper").clearQueue().fadeOut("fast",function() {
            $(this).hide();
            $("#topWrapper").clearQueue().fadeIn("fast");
        });

        Analytics.trackEvent("Flow","Select Term",Globals.SCHOOL_SLUG,Globals.termName);
    }

    if (Globals.termHasCourseData === true) {
        $("#toggle").show();
    } else {
        $("#toggle").hide();
    }

    $("#department option[value=NULL]").attr("selected", "selected");
    $("#course option[value=NULL]").attr("selected","selected");
    $("#section option[value=NULL]").attr("selected", "selected");

    $("#department").attr("disabled","true");
    $("#course").attr("disabled","true");
    $("#section").attr("disabled","true");

    $.cachedAjax({
        url: Selection.removeAmpersandsFromString(Browse.GET_DEPARTMENTS_URL + Globals.termId),
        dataType: "json",
        success: function(data){
            $("#department").html( stringifyDepartmentList(data) )
                            .attr("disabled", false);
        }
    });
}

function stringifyTermList(data) {
    Globals.termSlugs = {};
    Globals.termIds = {};

    var s = "<option value='NULL'>Select a Term</option>";
    _.each(data, function(value){
        Globals.termSlugs[value.id] = value.slug;
        Globals.termIds[value.slug] = value.id;
        s += "<option value=" + value.id + (value.current ? " selected='selected'" : "");
        s += (value.hasCourseData ? " data-hascoursedata" : "") + ">" + value.name +"</option>";
    });
    return s;
}


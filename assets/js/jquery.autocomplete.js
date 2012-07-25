// TODO: Check for required items, throw error if they're all not there.
/* All
 *   Required:
 *     opts: inputSelector, outputContainerSelector
 *     fns:  stringifyListItem, stringifyFailedSearch, listItemWasSelected
 *   Optional:
 *     opts: hideWhenEmpty
 *     fns:  onSuccessfulSearch, filterQuery, <<mouseover, leave, click>>
 * Local
 *   Required:
 *     opts
 *     fns:  getLocalData, filterLocalData
 *   Optional:
 *     opts
 *     fns
 * Ajax
 *   Required:
 *     opts: ajaxURL
 *     fns
 *   Optional:
 *     opts: ajaxThrottleTimeout
 *     fns
 */

$.autocomplete = function(userOptions, userFunctions)
{
    var defaultOptions = {
        // Required.
        type: undefined, // "local" or "remote"
        inputSelector: undefined,
        outputContainerSelector: undefined,

        // Remote concerns.
        // ajaxURL: undefined,
        ajaxThrottleTimeout: 0,

        // Aesthetic concerns.
        touch: false,
        hideOnBlur: false,
        hideOnEmptySearch: false
    };

    // Internal State
    var currentScrollPosition = -1;
    var usingArrowKeys = true;
    var ajaxTimeout = null;     // The object manipulated by setTimeout and clearTimeout.
    var lastQuery = "";
    var xhr = null; // The last Ajax request.

    var opts = $.extend({}, defaultOptions, userOptions);
    var fns;

    var defaultFunctions = {
        ajaxURL: function() {
            return undefined;
        },
        // Functions that users of this module must specify themselves.
        getLocalData: function(query) {
            throw("Unimplemented function: getLocalData()");
        },

        // Return an array of between 0 or N of the items in data.
        filterLocalData: function(data, query) {
            throw("Unimplemented function: filterLocalData()");
        },

        // Construct a complete <li>.
        stringifyListItem: function(object, query) {
            throw("Unimplemented function: stringifyListItem()");
        },

        stringifyFailedSearch: function(query) {
            throw("Unimplemented function: stringifyFailedSearch()");
        },

        // Use this to do something with the selected item (e.g. navigate, add to container).
        listItemWasSelected: function(elem) {
            return;
        },

        filterQuery: function(query) {
            return query;
        },

        init: function() {
            // Register event handlers.
            $(document).ready(function() {
                $(opts.outputContainerSelector).on('mouseover', 'li', fns.mouseoverListItem);
                $(opts.outputContainerSelector).on('mouseout', 'li', fns.mouseoutListItem);
                $(opts.outputContainerSelector).on('click', 'li', fns.clickListItem);

                $(opts.inputSelector).on('keyup', fns.keyupSearchBox);
                $(opts.inputSelector).on('keydown', fns.keydownSearchBox);
                $(opts.inputSelector).on('blur', fns.blurSearchBox);
                $(opts.inputSelector).on('focus', fns.focusSearchBox);
            });
        },

        stringifyItems: function(data, query) {
            var s = '';
            _.each(data, function(value){
                s += (fns.stringifyListItem(value, query));
            });
            return s;
        },

        // public
        clearAndHide: function() {
            currentScrollPosition = -1;
            $(opts.inputSelector).val("");
            $(opts.outputContainerSelector).html("").hide();
        },

        onSuccessfulSearch: function() {
            return;
        },

        onFailedSearch: function() {
            return;
        },

        displayData: function(data, query) {
            var html;
            if (data.length === 0) {
                html = fns.stringifyFailedSearch(query);
                $(opts.outputContainerSelector).html(html);
                fns.onFailedSearch();
            } else {
                html = fns.stringifyItems(data, query);
                $(opts.outputContainerSelector).html(html);
                fns.adjustScrollPositionAndHighlight($.autocomplete.FIRST);
                fns.onSuccessfulSearch();
            }
        },

        setQuery: function(query) {
            $(opts.inputSelector).val(query);
            fns.parseInputAndUpdateList();
        },

        parseInputAndUpdateList: function() {
            var query = fns.filterQuery($(opts.inputSelector).val());

            if (query === lastQuery) { return; }    // If query unchanged.
            lastQuery = query;

            if (opts.hideOnEmptySearch) {   // If query all whitespace.
                if (query.replace(/\s/g, "") === "") {
                    fns.clearAndHide();
                    return;
                } else {
                    $(opts.outputContainerSelector).show();
                }
            }

            // Remote data
            if (opts.type === "remote") {
                // We use setTimeout and clearTimeout to throttle how often a remote request is made.
                window.clearTimeout(ajaxTimeout);
                ajaxTimeout = window.setTimeout(
                    function() {
                        // If the last AJAX call hasn't come back yet, cancel it before firing this one.
                        // We do this in the interest of responsiveness, so that a user with slow Internet
                        // access isn't watching the autocomplete box catch up with him or her.
                        if (xhr && xhr.abort) { xhr.abort(); }
                        xhr = $.cachedAjax({
                            suppressErrors: true,
                            // TODO: Make server errors stop happening with search of "/"
                            url: fns.ajaxURL() + encodeURIComponent(query),
                            dataType: "json",
                            success: fns.displayData
                        }, query);
                    }, opts.ajaxThrottleTimeout);
            }
            // Local data
            else {
                fns.displayData(fns.filterLocalData(fns.getLocalData(), query));
            }

        },

        focus: function() {
            $(opts.inputSelector).focus();
        },

        blur: function() {
            $(opts.inputSelector).blur();
        },

        getIndexOfLastListItem: function() {
            return $("li", opts.outputContainerSelector).length - 1;
        },

        getSelectedListItem: function() {
            return $( $("li", opts.outputContainerSelector).get(currentScrollPosition) );
        },

        adjustScrollPositionAndHighlight: function(movement) {
            // If we weren't using arrow keys...
            if (usingArrowKeys === false && (movement === $.autocomplete.DOWN || movement === $.autocomplete.UP)) {
                fns.getSelectedListItem().addClass("hover");
                usingArrowKeys = true;
                return;
            }

            // We remove the highlight, decide which element needs highlighting (if any),
            // and then highlight it at the end of the function.
            $("li", opts.outputContainerSelector).removeClass("hover");
            switch(movement) {
                case $.autocomplete.DOWN:
                    currentScrollPosition++;
                    break;
                case $.autocomplete.UP:
                    currentScrollPosition--;
                    break;
                case $.autocomplete.FIRST:
                    usingArrowKeys = true;
                    currentScrollPosition = 0;
                    break;
                case $.autocomplete.OFF:
                    usingArrowKeys = false;
                    return;
                case $.autocomplete.NONE:
                    // If the box was hidden, when it reappears, we should position
                    // the highlight at the top.
                    if (opts.hideOnBlur) {
                        currentScrollPosition = -1;
                    }
                    return;
                default:
                    currentScrollPosition = movement;
            }

            // Potential overflow: top edition.
            if (currentScrollPosition <= -1) {
                currentScrollPosition = -1;
                $(opts.outputContainerSelector).scrollTo( 0, 0 );
                return;
            }

            // Scrolling stops at the bottom.
            if (currentScrollPosition > fns.getIndexOfLastListItem()) {
                currentScrollPosition = fns.getIndexOfLastListItem();
            }

            // If we scroll off of the view, scroll the box.
            var $selectedListItem = fns.getSelectedListItem();
            if ($selectedListItem.length === 0) {
                return;
            }

            var viewTop = $(opts.outputContainerSelector).offset().top;
            var viewBottom = viewTop + $(opts.outputContainerSelector).height();
            var itemTop = $selectedListItem.offset().top;
            var itemBottom = itemTop + $selectedListItem.outerHeight();

            var isScrolledIntoView = ((itemBottom >= viewTop) && (itemTop <= viewBottom) && (itemBottom <= viewBottom) && (itemTop >= viewTop) );
            if (!isScrolledIntoView) {
                if (movement === $.autocomplete.UP){
                    $(opts.outputContainerSelector).scrollTo( $selectedListItem, 0 );
                }
                else if (movement === $.autocomplete.DOWN) {
                    var properTopOffset = $(opts.outputContainerSelector).scrollTop() + (itemBottom - viewBottom);
                    $(opts.outputContainerSelector).scrollTo( properTopOffset, 0 );
                }
            }

            // There is no concept of "hover" on a touch device, so don't use it.
            if (!opts.touch) {
                $selectedListItem.addClass("hover");      // Finally, highlight.
            }
        },

        mouseoverListItem: function() {
            fns.adjustScrollPositionAndHighlight($(this).index());
        },

        mouseoutListItem: function() {
            usingArrowKeys = false;
            fns.adjustScrollPositionAndHighlight($.autocomplete.OFF);
        },

        clickListItem: function(e) {
            fns.listItemWasSelected(fns.getSelectedListItem());
        },

        keyupSearchBox: function(e) { // Does repeat
            switch(e.keyCode) {
                case 38: break; // up
                case 40: break; // down
                case 27: // escape
                    fns.adjustScrollPositionAndHighlight($.autocomplete.NONE);
                    fns.blurSearchBox();
                    break;
                case 13: // return key
                    if (currentScrollPosition >= 0) {
                        fns.listItemWasSelected(fns.getSelectedListItem(), e);
                    }

                    break;
                default:
                    fns.parseInputAndUpdateList();
                    break;
            }
            return false;
        },

        keydownSearchBox: function(e) { // Does not repeat
            switch(e.keyCode) {
                case 38: // up
                    fns.adjustScrollPositionAndHighlight($.autocomplete.UP);
                    break;
                case 40: // down
                    $(opts.outputContainerSelector).show();
                    fns.adjustScrollPositionAndHighlight($.autocomplete.DOWN);
                    break;
                default:
                    break;
            }
        },

        focusSearchBox: function() {
            if (opts.hideOnBlur) {
                $(opts.outputContainerSelector).show();
            }
        },

        blurSearchBox: function(e) {
            // Dirty hack to let li onClick fire before searchBox blur.
            window.setTimeout(function() {
                if (opts.hideOnBlur) {
                    // Firefox doesn't scroll to the top on display: none like
                    // all of the other nice browsers, so we do it explicitly.
                    $(opts.outputContainerSelector).scrollTo(0);
                    $(opts.outputContainerSelector).hide();
                }
                fns.adjustScrollPositionAndHighlight($.autocomplete.OFF);
            }, 100);
        }
    };

    // Allow for client-defined functions to override built-in primitives.
    fns = $.extend({}, defaultFunctions, userFunctions);

    // Give the client helpful messages if mandatory pieces were missing.
    if (!opts.type) { throw("Autocomplete: need to initialize 'type'"); }
    if (!opts.inputSelector) { throw("Autocomplete: need to initialize 'inputSelector'"); }
    if (!opts.outputContainerSelector) { throw("Autocomplete: need to initialize 'outputContainerSelector'"); }
    if (opts.type === "remote") {
        if (fns.ajaxURL === defaultFunctions.ajaxURL) { throw("Autocomplete: need to initalize 'ajaxURL'"); }
    }
    else if (opts.type === "local") {
        if (fns.getLocalData === defaultFunctions.getLocalData) { throw("Autocomplete: need to initialize getLocalData()"); }
        if (fns.filterLocalData === defaultFunctions.filterLocalData) { throw("Autocomplete: need to initialize filterLocalData()"); }
        if (fns.stringifyListItem === defaultFunctions.stringifyListItem) { throw("Autocomplete: need to initialize stringifyListItem()"); }
        if (fns.stringifyFailedSearch === defaultFunctions.stringifyListItem) { throw("Autocomplete: need to initialize stringifyListItem()"); }
    }
    else {
        throw("Autocomplete: invalid type, " + opts.type);
    }

    // Client has access to all options and functions.
    return $.extend(fns, opts);
};

$.autocomplete.DOWN = false;
$.autocomplete.UP   = true;
$.autocomplete.FIRST = 0;
$.autocomplete.OFF   = -2;
$.autocomplete.NONE  = -1;

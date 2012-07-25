/* jquery.tooltip.js
 *
 * Yet another jQuery tooltip plugin.
 * To use: $(elem).tooltip(options);
 * See comments directly below and in the defaults declaration for information
 * on available options.
 *
 * ## Tooltip Types ##
 * There are four different types of tooltips you can create. They differ
 * only in how they are dismissed.
 *
 * 'standard': Dismissed by clicking anywhere or pressing any key.
 *
 * 'hover': Dismissed by a mouseleave event on the parent. You most likely
 * want these to be created in response to a mouseover/mouseenter event.
 * If the 'canMouseIn' option is set to true, the user can move their mouse
 * from the parent into the tooltip
 *
 * 'important': Only dismissed when $.tooltip.closeImportant() is called.
 *
 * 'touch': Designed for touch devices. Dismissed when the user taps anywhere
 * on the screen, or triggers a second tooltip. Rather than manually
 * specifying this type,  you can set the 'touch' option to true. This way,
 * if your app supports both desktop and mobile interfaces, you can simply
 * define your tooltips for the desktop and pass in the touch flag as
 * appropriate to make all your tooltips touch-friendly sitewide.
 *
 *
 * ## Force Inside Bounds ##
 * When a tooltip is created, jquery.tooltip.js checks that it's within the
 * bounds of a wrapper element and shifts accordingly if not. At present,
 * GetchaBooks uses #main, but you can change that a few ways:
 * - To use a different element, set the 'boundingElem' option to a CSS
 *   seletor string.
 * - To use your own function, pass it in as the 'forceInsideBounts' option.
 *   It will be passed the tooltip jQuery object as the first argument.
 * - To skip this entirely, set 'forceInsideBounds' to false.
*/

;(function($, window, undefined) {
    $.fn.tooltip = function(options)
    {
        var SIDES = {
            top: 0,
            right: 1,
            bottom: 2,
            left: 3
        };

        var TYPES = {
            standard: 0,
            hover: 1,
            important: 2,
            touch: 3
        }

        var defaults = {
            html: '',       // Content of the tooltip, as an HTML string
            side: 'top', // Which side of the parent the tooltip appears on
                            // Can be 'top', 'bottom', 'left', or 'right'
            width: 'auto',      // In px, or 'auto'
            height: 'auto',     // In px, or 'auto'
            margin: 10,     // In px
            type: 'standard',
            touch: false,
            canMouseIn: false, // Only relevant for 'hover' tooltips
            boundingElem: "body",
            forceInsideBounds: forceInsideBounds
            // onDestroy: Function called when the tooltip is closed
        };

        var opts = $.extend(defaults,options);

        opts.typeName = opts.type;
        opts.type = TYPES[opts.type];
        opts.sideName = opts.side;
        opts.side = SIDES[opts.side];

        if (opts.touch) {
            opts.type = TYPES.touch;
        }

        if (opts.height === 'auto' || !opts.height) {
            opts.autoHeight = true;
        }

        if (opts.width === 'auto' || !opts.width) {
            opts.autoWidth = true;
        }

        validateOptions(opts)

        var $parent,
            $elem,
            closeFn;

        var TAIL_SIZE = 12;

        function validateOptions(options) {
            function testForNumber(key) {
                if(Object.prototype.toString.call(options[key]) == '[object String]') {
                    val = +options[key].replace(/px$/, '');
                    if(val !== val) {
                        throw "'" + options[key] + "' is not a valid " + key;
                    }

                    options[key] = val;
                }
            }

            if (options.type === undefined) {
                throw "Invalid tooltip type: " + options.typeName;
            } else if (options.side === undefined) {
                throw "Invalid side: " + options.sideName;
            }

            if (!opts.autoHeight) {
                testForNumber('height');
            }

            if (!opts.autoWidth) {
                testForNumber('width');
            }

            testForNumber('margin');

            return options;
        }

        function closeStandardTooltips() {
            $(".tooltip:not(.important, .hover)").remove();
            $(".hasTooltip:not(.hasImportantTooltip)")
                .removeClass("hasTooltip");

            if ($("div.tooltip:not(.important,.hover)").size() === 0) {
                $("body").off("click keyup",closeStandardTooltips);
            }

            if (typeof opts.onDestroy === 'function') {
                opts.onDestroy();
            }

            $(window).off('resize updateTooltips', updatePosition);
        }

        function closeTouchTooltips() {
            $("div.tooltip").remove();
            $(".hasTooltip").removeClass("hasTooltip");
            $("body").off("touchend", closeTouchTooltips);
            $(window).off('resize updateTooltips', updatePosition);

            if (typeof opts.onDestroy === 'function') {
                opts.onDestroy();
            }
        }

        function closeHoverTooltips() {
            var _removeInactiveHoverTips = function() {
                $('div.tooltip.hover:not(.activeHover)').remove();
                $('.hasTooltip.hasHoverTooltip')
                    .removeClass('hasTooltip hasHoverTooltip');

                if (typeof opts.onDestroy === 'function') {
                    opts.onDestroy();
                }

                $(window).off('resize updateTooltips', updatePosition);
            };

            /* The mouseout event for the parent fires before the mouseover
             * event for the tooltip. A brief timer ensures we don't kill
             * the tooltip while mousing between the parent and the tooltip. */
            setTimeout(_removeInactiveHoverTips, 100);
            $(this).off('mouseleave', closeHoverTooltips);
        }

        function setCloseFunction(e) {
            closeFn = closeStandardTooltips;
            switch(opts.type) {
                case TYPES.touch:
                    /* On touch events, we remove all tooltips on every tap, so
                     * we need to check for an existing tooltip before that */
                    if ($parent.hasClass('hasTooltip')) {
                        closeTouchTooltips();
                        e.stopPropagation();
                    }

                    closeFn = closeTouchTooltips;
                    closeTouchTooltips();
                    break;
                case TYPES.hover:
                    closeFn = closeHoverTooltips;
                    break;
                case TYPES.important:
                    closeFn = $.tooltip.closeImportant;
                    break;
            }
            return closeFn;
        }

        /** Calculates tooltip positioning and returns a CSS object */
        function getPosition() {
            var p = $.extend($parent.offset(), {
                    height  : $parent.innerHeight(),
                    width   : $parent.width()
                });

            var css = { width: opts.width };
            if (!opts.autoHeight) { css.height = opts.height; }
            if (!opts.autoWidth) { css.width = opts.width; }

            // Move the tooltip next to its parent
            switch(opts.side) {
                case SIDES.top:
                    css.top  = p.top - (opts.height + TAIL_SIZE + opts.margin);
                    css.left = p.left - (opts.width - p.width)/2;
                    break;
                case SIDES.bottom:
                    css.top = p.top + p.height + TAIL_SIZE + opts.margin;
                    css.left = p.left - (opts.width - p.width)/2;
                    break;
                case SIDES.left:
                    css.left = p.left - (opts.width + TAIL_SIZE + opts.margin);
                    css.top = p.top - (opts.height - p.height)/2;
                    break;
                case SIDES.right:
                    css.left = p.left + p.width + TAIL_SIZE + opts.margin;
                    css.top = p.top - (opts.height - p.height)/2;
                    break;
            }

            return css;
        }

        /** Triggers a manual recalculation of the tooltip's position*/
        function updatePosition() {
            $elem.css(getPosition())
        }

        /** Creates the tooltip and adds it to the page */
        function renderTooltip() {
            $elem = $("<div class='tooltip " + opts.sideName + "'/>")
                .html(opts.html)
                .css(getPosition())
                .append("<div class='tail'><div class='shadow'></div></div>")
                .appendTo('body');

            if (opts.className) {
                $elem.addClass(opts.className);
            }

            /* Because of our manual positioning, auto height/width requires
             * recalculating the position after the tooltip has been
             * inserted into the DOM. */
            if (opts.autoHeight) {
                opts.height = $elem.height();
                opts.autoHeight = false;
                updatePosition()
            }

            if (opts.autoWidth) {
                opts.width = $elem.width()
                opts.autoWidth = false;
                updatePosition()
            }

            if (typeof opts.forceInsideBounds === 'function') {
                opts.forceInsideBounds($elem);
            }

            if (typeof opts.onCreate === 'function') {
                opts.onCreate();
            }
        }

        /** Binds event handlers to close the tooltip, based on type */
        function bindEvents() {
            switch(opts.type) {
                case TYPES.standard:
                    $("body").on('click keyup', closeFn);
                    break;
                case TYPES.touch:
                    $("body").on('touchend', closeFn);
                    break;
                case TYPES.hover:
                    $elem.addClass("hover");
                    $parent.addClass('hasHoverTooltip');
                    $parent.on('mouseleave', closeFn);

                    if (opts.canMouseIn) {
                        $elem.on('mouseenter mouseleave', function() {
                            $elem.toggleClass("activeHover");
                            closeFn();
                        });
                    }
                    break;
                case TYPES.important:
                    $elem.addClass("important");
                    $parent.addClass('hasImportantTooltip');
                    break;
            }

            $(window).on('resize updateTooltips', updatePosition);
        }

        /* Adjust the tooltip and tail position if it extends past the edge */
        function forceInsideBounds($elem) {
            var $tail = $elem.find('div.tail'),
                $bounds = $(opts.boundingElem),
                offset = $bounds.offset(),
                tailPos = $tail.position(),
                isVertical = (opts.side === SIDES.top || opts.side === SIDES.bottom),
                pos = $.extend($elem.position(), {   width: $elem.width(),
                                                     height: $elem.height() });

            var CSS = {},
                tailCSS = {},
                changed = false;

            // Right
            var rightDiff = ($bounds.outerWidth() + offset.left) - pos.left;
            if (rightDiff < pos.width) {
                CSS.left = pos.left + (rightDiff - pos.width);
                if (isVertical) {
                    tailCSS.left = tailPos.left - (rightDiff - pos.width);
                }
                changed = true;
            }

            // Bottom
            var bottomDiff = ($bounds.outerHeight() + offset.top) -
                (pos.top + pos.height);
            if (bottomDiff < 0) {
                CSS.top = pos.top + (bottomDiff - 10);
                if (!isVertical) {
                    tailCSS.top = tailPos.top - bottomDiff;
                }
                changed = true;
            }

            if (changed) {
                $elem.css(CSS);
                $tail.css(tailCSS);
            }
        }

        return this.each(function(e) {
            $parent = $(this);

            setCloseFunction(e);

            // If a tooltip already exists on this element, exit out
            if ($parent.hasClass('hasTooltip')) {
                closeFn();
                return this;
            }

            $parent.addClass('hasTooltip');
            renderTooltip();
            bindEvents();

            return this;
        });
    };

    $.tooltip = {
        closeImportant: function() {
            $("div.tooltip").remove();
            $(".hasTooltip.hasImportantTooltip")
                .removeClass("hasTooltip hasImportantTooltip");
        }
    };
})(jQuery, this);

/*global $, Globals, Analytics */

;(function($, window, undefined) {
    var opts = {};
    var $el, $shade, $wrapper;

    $.lightbox = function(options) {
        var defaults = {
            // element IDs
            shade: "lightbox-shade",
            wrapper: "lightbox-wrapper",
            el: "lightbox",
            closeButton: "lightbox-cancel", // false for no cancel button

            // Content
            content: '', // HTML
            classString: '',
            width: '', // Set to a valid number to programmatically set width

            // Callbacks
            onCreate: function() {},
            onDestroy: function() {},

            // Behavioral flags
            fade: true,
            keyboardDismiss: true,
            clickToDismiss: true,
            respectScroll: true,
            touch: false
        };

        opts = $.extend(defaults, options || {});

        $el = $("#" + opts.el);
        if(!!$el.length){
            remove($el, create);
        } else {
            create();
        }
    }

    function createDivIfNotExists(id) {
        var $e = $("#" + id);
        if (!$e.length) {
            $e = $("<div id='" + id + "'></div>");
        }
        return $e;
    }

    function isNumber(obj) { return Object.prototype.toString.call(obj) == '[object Number]'; }

    function create() {
        $shade = createDivIfNotExists(opts.shade);
        $wrapper = createDivIfNotExists(opts.wrapper);
        $el = createDivIfNotExists(opts.el);

        if (opts.classString) {
            $el.addClass(opts.classString);
        }

        $el.html(opts.content)
            .appendTo($wrapper);
        $wrapper.appendTo('body');
        $shade.appendTo('body');

        if(opts.closeButton) {
            var $cancel = createDivIfNotExists(opts.closeButton)
                .appendTo($el);
            $cancel.on('click', close);
        }

        if (isNumber(opts.width)) {
            $el.width(opts.width);
        }

        if (opts.respectScroll) {
            $wrapper.css('margin-top', $(document).scrollTop());
        }

        if(opts.fade) {
            $shade.fadeIn('fast').show();
            $el.fadeIn('fast').show();
        }

        if (opts.clickToDismiss) {
            var clickEvent = 'click';
            if (opts.touch) { clickEvent = 'touchend'; }

            $(document).on(clickEvent, '#' + opts.shade + ', #' + opts.wrapper, function(e) {
                var $target = $(e.target);
                if ($target.is($shade) || $target.is($wrapper)) {
                    close();
                }
            });
        }

        if (opts.keyboardDismiss) {
            $(document).on('keyup', handle_keys);
        }

        if (typeof opts.onCreate === 'function') {
            opts.onCreate();
        }
    }

    function handle_keys(e) {
        if (e.keyCode === 27) {  // escape key
            close();
        }
    }

    /** Closes the lightbox and the shade.
    * If an onDestroy callback was specified, this will call it with the
    * triggering event object as a parameter. */
    function close(e) {
        if (opts.keyboardDismiss) {
            $(document).off('keyup', handle_keys);
        }

        remove($el, opts.onDestroy, e);
        remove($shade);
    }

    /**
    * Destroys a DOM element, fading if appropriate
    * $obj: DOM elemenet to destroy
    * callbackFn: function to be called after completion
    * data: argument to pass to the callback
    */
    function remove($obj, callbackFn, data) {
        function do_remove() {
            $obj.remove();
            if (typeof callbackFn === 'function') {
                callbackFn(data);
            }
        }

        if (opts.fade) {
            $obj.fadeOut('fast', do_remove);
        } else {
            do_remove();
        }
    }

    $.lightbox.close = close;
})(jQuery, this);
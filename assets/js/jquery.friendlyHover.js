(function($) {
	$.fn.friendlyHover = function(callback) {
	    if (Globals.TOUCH) {
	        return this.on('touchend', callback);
	    } else {
	        return this.hoverIntent(callback, function() {});
        }
    };
})(jQuery);
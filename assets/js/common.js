/*global $, Globals, Analytics */

// Logs are for lumberjacks, not production users
// The first check disables all console logging on all production environments
// The second check stops IE from yelling at us about how console isn't defined
if (Globals.PRODUCTION || !window.console) {
    var names = ["log", "debug", "info", "warn", "error", "assert", "dir",
        "dirxml", "group", "groupEnd", "time", "timeEnd", "count", "trace",
        "profile", "profileEnd"];
    window.console = {};
    for (var i = 0, len = names.length; i < len; ++i) {
        window.console[names[i]] = function(){};
    }
}

$(document).ready(function() {
    // Considerations for mobile!
    Globals.TOUCH = Modernizr.touch;

    if(Globals.TOUCH) {
        $("body").addClass("touch");
        jQuery.fx.off = true;
    }

    $(".shareButton").live('click',
        function() {
            var WIDTH=550, HEIGHT=450;
            var url = $(this).attr('data-url');
            var type = $(this).attr('data-type');
            Analytics.trackEvent("Viral",type + " Share",$(this).attr('data-id'));
            if(type !== 'Email') {
                var top = ($(window).height() - HEIGHT)/2;
                var left = ($(window).width() - WIDTH)/2;
                window.open(url,type,"top=" + top + ",left=" + left + ",width=550,height=450,scrollbars=no,toolbar=no,location=no,menubar=no");
            }
    });

    //stats tracking for breadcrumbs and logo
    $("#logo").click(function() {
        Analytics.trackEvent("Navigation","Logo");
    });

    $("#indexCrumb").click(function() {
        Analytics.trackEvent("Navigation","Start Over");
    });

    $("#editCrumb").click(function() {
        Analytics.trackEvent("Navigation","Edit Crumb");
    });

    $("#resultsCrumb").click(function() {
        Analytics.trackEvent("Navigation","Results Crumb");
    });

    $("#footerFB").click(function() {
        Analytics.trackPage('viral/footer/facebook');
        Analytics.trackEvent("Navigation", "Facebook");
    });

    $("#footerTwitter").click(function() {
        Analytics.trackPage('viral/footer/twitter');
        Analytics.trackEvent("Navigation", "Twitter");
    });

    // AJAX errors across the site
    $("body").ajaxError(function(evt, xhr, settings) {
        if (settings.suppressErrors) { return; }

        var msg = "<p class='lightboxHeader first centered'>We're sorry. Something went wrong.</p>";
        msg += "<p><strong>Don't panic.</strong> Wait a moment and try what you were doing again.</p>";
        msg += "<p>We apologize for the inconvenience. We've been notified and are looking into your problem.</p>";
        $.lightbox({content: msg, width: 620, touch: Globals.TOUCH});
    });
});

if(!Array.indexOf){
    Array.prototype.indexOf = function(obj){
        for(var i=0; i<this.length; i++){
            if(this[i]==obj){
                return i;
            }
        }
        return -1;
    };
}

function validateEmail(email) {
    // This regex courtesy of Arluison Guillaume
    // http://www.mi-ange.net/blog/msg.php?id=79&lng=en
    // Found via http://fightingforalostcause.net/misc/2006/compare-email-regex.php
    var regex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    return !!email.match(regex);
}

String.prototype.capitalize = function(){
    return this.replace(/\S+/g, function(a){
        return a.charAt(0).toUpperCase() + a.slice(1).toLowerCase();
    });
};

/*
 * hasAttr
 * Returns (bool) whether element has an attribute.
 */
$.fn.hasAttr = function(name) {
   return !_.isUndefined(this.attr(name));
};

(function($) { $.fn.extend({ _is: $.fn.is, is: function(s) { return s ? this._is(s) : !!this.length; } }); })(jQuery);

function htmlEncode(value){
    return $('<div/>').text(value).html();
}

function htmlDecode(value){
    return $('<div/>').html(value).text();
}
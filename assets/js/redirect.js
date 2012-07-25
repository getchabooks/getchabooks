/*global $, Analytics, Globals */

// /redirect/#!/action/label/http://google.com/

var url;
var delay = 2500;

function redirect() {
    window.location = url;
}

$(document).ready(function(){

    var input = window.location.hash.slice(2);

    var pieces = input.split("/", 2);
    var action = pieces[0];
    var label = pieces[1];
    var urlStartPosition = action.length + label.length + 2;

    url = input.substr(urlStartPosition);

    Analytics.trackEvent('Outgoing', action, label);

    if (action === 'AbeBooks' && (label === 'bdp' || label === 'bundle')) {
        redirect();
    }

    // Validation?

    $("#link").attr('href', url);

    setTimeout(redirect, delay);

});

/* ANALYTICS TODO
   SITEWIDE
   - Easy indication of school/ISBN
   - What should be an event vs. a pageview? New funnels.
   - Look at current analytics to test that I can run all the reports I want with our data

   AUTOCOMPLETE
   - What course searches failed - can this even be done client-side?
   - Do we care about what ISBNs failed?
   - Right now, there's a single call if a user enters more than one ISBN at once (>1 ISBN-length item). Do we just want the flag, or do we want more fine-tuned tracking?

   RESULTS
   - Outgoing links
 */

// Create the Analytics object
var Analytics = {};

/* The debug flag determines whether or not we do local logging - console.log output as well as (NOT YET) server-side logfiles.
 *  The makeCalls flag determines whether or not we push stats calls to Google. 
 *  The default behavior is that the production site only makes calls to Google, whereas the dev environment only does local logging. */
Analytics.debug = !Globals.PRODUCTION;
Analytics.makeCalls = Globals.PRODUCTION;

/* This default behavior can be overriden by setting Globals.DEBUG or Globals.MAKE_CALLS in PHP. 
 * If either of those variables is set, their value supercedes the basic PRODUCTION logic. */
if(Globals.DEBUG !== undefined) {
    Analytics.debug = Globals.DEBUG;
}

if(Globals.MAKE_CALLS !== undefined) {
    Analytics.makeCalls = Globals.MAKE_CALLS;
}

// Initialization code
if(Analytics.makeCalls) {
    var _gaq = _gaq || [];
	var DEBUG = Globals.DEV_ANALYTICS_UA,
        PROD = Globals.PROD_ANALYTICS_UA,
        tag = (Analytics.debug ? DEBUG : PROD);

    _gaq.push(['_setAccount', tag],
            ['_setAllowHash',false],
            ['_setAllowLinker',true],
            (Globals.PAGE_TRACK_URL ? ['_trackPageView', Globals.PAGE_TRACK_URL] : ['_trackPageView']));
} 
if(Analytics.debug) {
    console.log("Loaded page. debug mode enabled, makeCalls mode " + (Analytics.makeCalls ? "enabled" : "disabled"));
}  

(function() {
 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

/** Track an event. Label and value are optional. */
Analytics.trackEvent = function(category, action, label, value) {
    if(this.debug) {
        this.eventLog(category, action, label, value);
    }

    if(this.makeCalls) { // Google call
        _gaq.push(['_trackEvent',category,action,label,value]);
    }
}

/** Track a pageview for a given URL (do not include preceding slash) */
Analytics.trackPage = function(url) {
    url = '/' + url;
    if(this.debug) {
        console.log(url);
    }

    if(this.makeCalls) {
        _gaq.push(['_trackPageview',url]);
    }
}

/** Display a pretty console message indicating a tracked event. */
Analytics.eventLog = function(category, action, label, value) {
    var msg = '';
    if(category) msg += category;
    if(action) msg += " > " + action;
    if(label) msg += " > " + label;
    if(value) msg += " > " + value;

    console.log(msg);	
}

// Track the referrer, if it exists.
if(ref != null) {
    Analytics.trackEvent('Referrer',ref);
}

<?php

require_once 'PageController.php';

class StaticPageController extends PageController {

    public function __construct() {
        parent::__construct();
        $this->cssFiles['index.css'] = array('index.css');
    }

    public function page($page) {
        // PHP doesn't have functions with "-" in them. In order to have slugs with '-', we
        // have a convention of replacing "-" with "_" to find the right method.
        call_user_func(array($this, str_replace("-", "_", $page)));
    }

    function about() {
        global $siteName;

        $this->setTitle( "About" );
        $this->addMetaTag('description',
            "By combining course syllabi with an intelligent price comparison"
            . " system, $siteName finds the cheapest prices for all of your courses.");

        $this->renderPage('about');
    }

    function faq() {
        global $siteName;

        $this->setTitle( "Frequently Asked Questions" );
        $this->addMetaTag('description',
            "$siteName is completely free to use. It looks up what books you need "
            . "from your school bookstore and find them at cheapest prices across the web.");

        $this->renderPage('faq');
    }

    function help() {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . BASE_URL . "faq");
    }

    function open_source() {
        $this->setTitle( "Open Source" );
        $this->addMetaTag('description',
            "GetchaBooks is open source. Use GetchaBooks to build your own textbook lookup "
            . "and comparison website.");

        $this->renderPage('open-source');
    }

    function link() {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://www.amazon.com/#?tag=txtbks-20");
    }

}

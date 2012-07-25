<?php

class RedirectController extends PageController { 

    public function __construct() {
        parent::__construct();
        $this->jsFiles['redirect.js'] = array('redirect.js');
        $this->cssFiles['index.css'] = array('index.css');
    }

    function render(){
        $this->setTitle("Redirecting..." );
        $this->renderPage('redirect');
		$this->overrideAnalyticsPageUrl("outgoing");
    }

}

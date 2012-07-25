<?php

class ErrorController extends PageController {

    public function __construct($status) {
        parent::__construct();
        $this->cssFiles['index.css'] = array('index.css');
        $this->status = $status;
    }

    public function render() {
        $message = "We're sorry. Something went wrong.";
        $subtext = "<strong>Don't panic.</strong> It'll"
                   . " only take a moment to get you back to where you were.";

        if ($this->status == 404) {
            $message = "We're sorry. We couldn't find that page.";
        } else if ($this->status == 500) {
            $subtext = "Please try again in a few minutes.";
        }

        $this->setTitle( "Error" );
        $this->renderPage('error', array(
            'message' => $message,
            'subtext' => $subtext,
            'status' => $this->status,
        ));
    }

}


<?php

class AbeBooksRedirectController extends PageController {

    public function render($isbns) {
        $this->setTitle("Buy Your Books");

        $this->renderPage('abebooks', array(
            'isbns' => explode("-", $isbns)
        ));

    }
}

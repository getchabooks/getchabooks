<?php

class IndexController extends PageController {

    public function __construct() {
        parent::__construct();
        $this->jsFiles['index.js'] = array('index.js');
        $this->cssFiles['index.css'] = array('index.css');
    }

    function printSchoolList($json) {
        foreach (json_decode($json) as $school) {
            echo "<li><a href='" . BASE_URL . "{$school->slug}/selection/'>"
                . htmlspecialchars($school->name) . "</a></li>\n";
        }
    }

    function render() {
        global $gbCache, $siteName, $keywords;

        $args = func_get_args();
        if (count($args) > 0) {
            $school = $args[0];
        } else {
            $school = null;
        }

        if ($school) {
            $school = School::findOneBySlug($school);
            if (!$school) {
                header("Location: " . BASE_URL);
                exit();
            }
        }

        if (!($schoolJson = $gbCache['schooljson'])) {
            $schoolJson = file_get_contents(BASE_DIR . '/config/schools.json');
            $gbCache['schooljson'] = $schoolJson;
        }

        $this->setTitle('Textbooks made easy.');

        $this->addMetaTag('keywords',
            (!$school ? '' : $school->getShortName() . ", " . $school->getName(). ",")
            . "$siteName, $keywords, college textbooks, lowest "
            . "textbook prices, affordable textbooks, cheap textbooks, "
            . "inexpensive textbooks, discount textbooks, textbook price"
            . " comparison, textbook price-comparison, textbook syllabus"
            . " information, rent textbooks, college textbooks, search by"
            . " course, student textbook discounts, better college bookstore,"
            . " alternative college bookstore, cheap text books, compare"
            . " textbooks prices");

        $this->addMetaTag('description',
            ($school ? $school->getShortName() . ' ' : '') . "GetchaBooks is a free, "
            . "student-run service that finds "
            . ($school ? "textbooks for students of " . $school->getName()
            : "college students' textbooks")
            . " at the lowest prices.");

        $this->inlineJS[] = "var Index = {};";
        $this->inlineJS[] = "Index.IS_SCHOOL = " . ($school ? "true" : "false") . ";";
        $this->inlineJS[] = "Index.SCHOOL_SLUG = " . ($school ? "'".$school->getSlug()."'" : "false") . ";";
        $this->inlineJS[] = "Index.BASE_URL = '" . BASE_URL . "';";
        $this->inlineJS[] = "Index.ISBN_URL = '" . BASE_URL . "selection/';";
        $this->inlineJS[] = "Index.SCHOOL_NOT_FOUND_MESSAGE = \"<li class='error' data-url='\" + Index.ISBN_URL + \"'><a href='\" + Index.ISBN_URL + \"'><p class='title'>It looks like we don't know your school's courses right now.</p><p>Don't worry, we can still help. If you tell us what books you're looking for, we'll find the best prices for them.</p><p class='link'>Find my books.</p></a></li>\"";
        $this->inlineJS[] = "Index.LIST_OF_ALL_SCHOOLS = " . ($schoolJson ? $schoolJson : "[]") . ";";

        // When we have zero data but still want to look presentable.
        if (defined('ISBN')) {
            $this->renderPage('isbn_index', array());
        } else {
            $this->renderPage('index', array(
                'school'  => $school,
                'schoolJson'    => $schoolJson, 
            ));
        }

    }

}


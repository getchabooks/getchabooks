<?php

class NoCampusError extends GetchabooksError {}
class NoTermsError extends GetchabooksError {}
class NoDepartmentsError extends GetchabooksError {}

class SelectionController extends PageController { 

    public function __construct() {
        parent::__construct();
        $this->jsFiles['selection.js'] = array(
            "browse.js",
            "course.js",
            "isbn.js",
            "selection.js"
        );

        $this->cssFiles['selection.css'] = array('selection.css');
    }

    function render() {
        global $app;

        $args = func_get_args();
        if (count($args) > 0) {
            $school = $args[0];
        } else {
            $school = null;
        }

        if ($school) {
            if (defined('EMERGENCY')) {
                $this->redirect_to_index();
            }

            $school = School::findOneBySlug($school);
            if (!$school){
                $this->redirect_to_index();
            }

            // if the school is unspidered, spider it down to departments.
            // if it fails, continue onwards as long as there is old data,
            // otherwise rethrow, which will cause the error page to be 
            // displayed
            try {
                $school->spider(2);
            } catch (BookstoreError $e) {
                $app->getLog()->warn($e->getMessage());
                if ($school->getNbCampuses() == 0) {
                    throw $e;
                }
            }

            $multiCampus = ($school->getNbCampuses() > 1);

            $bardHACK = ($school->getSlug() == "bard");

            if ($multiCampus) {
                $campusId = null;
                $campusSlug = null;
            } else {
                $campus = CampusQuery::create()
                    ->filterBySchool($school)
                    ->findOne();

                $campusSlug = $campus->getSlug();
                $campusId = $campus->getId();
            }

            $schoolSlug = $school->getSlug();
            $isbnMode = false;
            $itemName = "course";

        } else {
            $school = null;
            $schoolSlug = null;
            $campusSlug = null;
            $multiCampus = false;
            $isbnMode = true;
            $itemName = "book";
            $campusId = null;
            $bardHACK = false;
        }

        $this->inlineJS[] = "var Selection = {};";
        $this->inlineJS[] = "Globals.SECTION_DELIMITER = '" . SECTION_DELIMITER . "';";
        $this->inlineJS[] = "Globals.MULTICAMPUS = " . ($multiCampus ? "true" : "false") . ";";
        $this->inlineJS[] = "Globals.SCHOOL_SLUG = " . ($school ? "'".addslashes($school->getSlug())."'" : "false") . ";";
        $this->inlineJS[] = "Globals.SCHOOL_NAME = " . ($school ? "'".addslashes($school->getShortName())."'" : "false") . ";";
        $this->inlineJS[] = "Globals.campusId = " . ($campusId ? "'$campusId'" : 'null') . ";";
        $this->inlineJS[] = "Globals.CAMPUS_SLUG = " . ($campusSlug ? "'$campusSlug'" : 'null') . ";";
        $this->inlineJS[] = "Globals.termId = null;";
        $this->inlineJS[] = "Globals.TYPE = '" . ($isbnMode ? "ISBN" : "course") . "';";
        $this->inlineJS[] = "Globals.ITEM_NAME = '" . $itemName . "';";
		$this->overrideAnalyticsPageUrl("selection/" . ($isbnMode ? "isbn" : "course"));

        $this->setTitle( $school ? 'Select Courses' : 'Enter Books' );
        if ($school) {
            $description = "Just tell us your " . $school->getShortName() . " courses, "
                           . "and we'll look up your books and find the cheapest prices.";
        } else {
            $description = "Input your books by ISBN and we'll do "
                           . "the comparison shopping for you.";
        }
        $this->addMetaTag( 'description', "Textbooks made easy. $description" );

        $this->renderPage('selection', array(
            'breadcrumbFormat' => 'selection',
            'schoolSlug' => $schoolSlug,
            'isbnMode' => $isbnMode,
            'multiCampus' => $multiCampus,
            'bardHACK' => $bardHACK,
            'school' => $school,
            'campusWrapperDisplay' => $multiCampus ? 'inline' : 'none',
            'topWrapperDisplay' => $multiCampus ? 'none' : 'inline'
        ));
    }

}

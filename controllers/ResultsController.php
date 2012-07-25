<?php

class ResultsController extends PageController {

    public function __construct() {
        parent::__construct();
        $this->jsFiles['results.js'] = array('results.js');
        $this->cssFiles['results.css'] = array('results.css');
    }

    function render() {
        global $vendors;

        $args = func_get_args();
        if (count($args) == 1) {
            $school = $campus = $term = null;
            $ids = $args[0];
        } else if (count($args) == 4) {
            $school = $args[0];
            $campus = $args[1];
            $term = $args[2];
            $ids = isset($args[3]) ? $args[3] : null;
        } else {
            $school = $args[0];
            $campus = null;
            $term = $args[1];
            $ids = isset($args[2]) ? $args[2] : null;
        }

        if (defined('EMERGENCY') && $school) {
            $this->redirect_to_index();
        }

        if (!$school) {
            $isbnMode = true;
            unset($vendors[array_search('Bookstore', $vendors)]);
            $schoolSlug = $campusSlug = $termSlug = false;
        } else {
            $isbnMode = false;
            $school = School::findOneBySlug($school);

            if (!$school) {
                $this->redirect_to_index();
            }
            $vendors[array_search('Bookstore', $vendors)] = $school->getBookstoreType();
            $schoolSlug = $school->getSlug();

            if ($campus) {
                $campus = CampusQuery::create()
                    ->filterBySchool($school)
                    ->filterBySlug($campus)
                    ->findOne();

                if (!$campus) {
                    $this->redirect_to_index();
                }
                $campusSlug = $campus->getSlug();
            } else {
                $campusSlug = false;
            }

            $q = TermQuery::create();

            if ($campus) {
                $q->filterByCampus($campus);
            } else {
                $q->useCampusQuery()
                        ->filterBySchool($school)
                    ->endUse();
            }

            $term = $q->filterBySlug($term)
                ->findOne();

            if (!$term) {
                $this->redirect_to_index();
            }
            $termSlug = $term->getSlug();
            $termName = $term->getName();
        }

        $this->setTitle('Your Books');

        $this->inlineJS[] = "Globals.SECTION_DELIMITER = '" . SECTION_DELIMITER . "';";
        $this->inlineJS[] = "Globals.SCHOOL_SLUG = " . ($schoolSlug ? "'$schoolSlug'" : "false") . ";";
        $this->inlineJS[] = "Globals.CAMPUS_SLUG = " . ($campusSlug ? "'$campusSlug'" : "false") . ";";
        $this->inlineJS[] = "Globals.TERM_SLUG = " . ($termSlug ? "'$termSlug'" : "false") . ";";
        $this->inlineJS[] = "Globals.IDS = '$ids';";
        $this->inlineJS[] = "Globals.THIS_PAGE_URL = '" . CURRENT_URL . "';";
		$this->overrideAnalyticsPageUrl("results");

        // If only one section, use its title as a FB Open Graph title (for share functionality)
        if ($school) {
            $sections = SectionQuery::create()
                ->filterBySlug($ids)
                ->filterBySchoolSlug($schoolSlug)
                ->filterByTermSlug($termSlug);

            if ($campusSlug) {
                $sections->filterByCampusSlug($campusSlug);
            }

            $sections = $sections->find();

            if ($sections->count() == 1) {
                $courseName = $sections[0]->getName();
                $shortName = $school->getShortName();
                $term = $term->getName();
                global $siteName;
                $this->misc[] = "<meta property='og:title' content='$courseName &#8250; $shortName $siteName ($termName)' />";
            }
        }

        if ($isbnMode) {
            $hashPrefix = "";
        } else if ($campusSlug) {
            $hashPrefix = "$campusSlug/$termSlug/";
        } else {
            $hashPrefix = "$termSlug/";
        }

        $this->renderPage('results', array(
            'isbnMode' => $isbnMode,
            'breadcrumbFormat' => 'results',
            'schoolSlug' => $schoolSlug,
            'ids' => $ids,
            'hashPrefix' => $hashPrefix,
            'tableClass' => 'vendor' . count($vendors),
            'resultsURL' => ''
        ));

    }

}

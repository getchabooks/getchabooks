<?php

$bc = SchoolQuery::create()->filterBySlug('bc')->findOne();

$campuses = $bc->getCampuss();
$currentTerm = $campuses[0]->getCurrentTerm();

$depts = array(
    '01' => array(
        'BI' => 'Biology',
        'BK' => 'African and African Diaspora Studies',
        'CH' => 'Chemistry',
        'CL' => 'Classical Studies',
        'CO' => 'Communication',
        'CS' => 'Computer Science',
        'CT' => 'Theater',
        'EC' => 'Economics',
        'EN' => 'English',
        'FA' => 'Fine Arts/Art History',
        'FM' => 'Film Studies',
        'FS' => 'Fine Arts/Studio Art',
        'GE' => array(
            'Earth and Environmental Sciences', 
            'Earth and Environmental Sciences'
        ),
        'GM' => 'Germanic Studies',
        'HP' => 'Honors Program',
        'HS' => 'History',
        'IC' => 'Islamic Civilization and Societies',
        'IN' => 'International Studies',
        'MT' => 'Mathematics',
        'MU' => 'Music',
        'PH' => 'Physics',
        'PL' => 'Philosophy',
        'PO' => 'Political Science',
        'PS' => 'Psychology',
        'RL' => 'Romance Languages/Literatures',
        'SC' => 'Sociology',
        'SL' => 'Slavic and Eastern Languages',
        'TH' => 'Theology',
        'UN' => 'University Courses and Capstone'        
    ),
    '04' => array(
        'LL' => 'Law'
    ),
    '05' => array(
        'AD' => 'Administrative Studies',
        'BA' => array(
            'Advancing Studies/Accounting',
            'adv studies/accounting'
        ),
        'BF' => array(
            'Advancing Studies/Finance',
            'adv studies/finance',
        ),
        'BI' => 'Biology',
        'BL' => array(
            'Advancing Studies/Law',
            'adv studies/law'
        ),
        'BM' => array(
            'Advancing Studies Management/Marketing',
            'ad studies mgmnt/marketing'
        ),
        'CO' => 'Communication',
        'EC' => 'Economics',
        'ED' => 'Education',
        'EN' => 'English',
        'FA' => 'Fine Arts/Art History',
        'GM' => 'Germanic Studies',
        'HS' => 'History',
        'LA' => array(
            'Advancing Studies/Law',
            'adv studies/law'
        ),
        'MT' => 'Mathematics',
        'PL' => 'Philosophy',
        'PO' => 'Political Science',
        'PS' => 'Psychology',
        'RL' => 'Romance Languages/Literatures',
        'SC' => 'Sociology',
        'TH' => 'Theology'
    ),
    '06' => array(
        'SW' => 'Social Work'
    ),
    '07' => array(
        'MA' => 'Accounting',
        'MB' => array(
            'Organizational Studies/Human Resource Management',
            'organizatnl std/human res mgmt'
        ),
        'MD' => array(
            'Operations, Information & Strategic Management',
            'operations,information & strategic mgmt'
        ),
        'MF' => 'Finance',
        'MH' => array(
            'Undergrad Management Honors/Ethics',
            'undergrad mgmt honors/ethics'
        ),
        'MI' => 'Information Systems',
        'MJ' => 'Business Law',
        'MK' => 'Marketing',
        'MM' => array(
            'Graduate Management Practice/International',
            'grad mgmt practice/international'
        )
    ),
    '08' => array(
        'NU' => 'Nursing'
    ),
    '09' => array(
        'ED' => 'Education',
        'PY' => 'Education/Psychology'        
    ),
    '18' => array(
        'TM' => 'Theology and Ministry'
    )    
);


foreach ($depts as $schoolNum => $ds) {
    foreach ($ds as $abbr => $name) {
        if (is_array($name)) {
            $formatted = $name[0];
            $lookup = $name[1];
        } else {
            $formatted = $name;
            $lookup = strtolower($name);
        }

        $data = array(
            'BUTNS' => '',
            'DAYS' => 'A',
            'DEPT' => "$abbr=$lookup",
            'DEPT00' => "",
            'DEPT01' => "",
            'DEPT05' => $schoolNum == '05' ? "$abbr=$lookup" : "",
            'DEPT07' => "",
            'DEPT09' => "",
            'EDIT.DEPT.ENTERED' => 'Select a department',
            'EDIT.TERM.ENTERED' => 'Select a term',
            'ETIME' => 'ALL',
            'FORMNAME' => 'course.schedule',
            'LEVEL' => 'A',
            'PROF' => '',
            'SCHOOL' => $schoolNum,
            'STATUS' => 'A',
            'STIME' => 'ALL',
            'TERM' => '2012S',
            'TITLE' => ''            
        );


        $result = Curl::post("https://agora.bc.edu/cgi-bin/uiscgi?wwmr", $data);

        // with course popup hyperlink
        $regex1 = "/\<td\>[^>]+?\>([A-Z]{2})(.+?)(..)\<.+?\<td\>.+?\<td\>.+?\<td\>.+?\<td\>(.+?)\<\/td\>.+?\<td\>.+?\<td\>.+?\<td\>[^>]+?\>(.+?)\</s";

        // without course popup hyperlink
        $regex2 = "/\<td\>\s*([A-Z]{2})([A-Z0-9]+?)([A-Z0-9]{2})\<\/td.+?\<td\>.+?\<td\>.+?\<td\>.+?\<td\>(.+?)\<\/td\>.+?\<td\>.+?\<td\>.+?\<td\>[^>]+?\>(.+?)\</s";

        if (!preg_match_all($regex1, $result, $matches, PREG_SET_ORDER)) {
            preg_match_all($regex2, $result, $matches, PREG_SET_ORDER);
        }

        if (count($matches) > 1) {
            unset($matches[0]);
        }

        if (!$matches) {
            echo "No matches for $schoolNum $abbr.\n"; 
        }

        foreach ($matches as $m) {
            $dept = $m[1];
            $course = $m[2];
            $section = $m[3];
            $name = trim($m[4]);
            $professor = trim($m[5]);

            echo "$dept$course$section ";

            $s = SectionQuery::create()
                ->filterByNum($section)
                ->useCourseQuery()
                    ->filterByNum($course)
                    ->useDeptQuery()
                        ->filterByAbbr($dept)
                        ->useTermQuery()
                            ->filterByName($currentTerm)
                            ->useCampusQuery()
                                ->filterBySchool($bc)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->findOne();

            if (!$s) {
                echo "Error.\n";
            } else {

                $c = $s->getCourse();
                $d = $c->getDept();
                $d->setName($formatted)->save();

                if ($name && $name != '&nbsp;') {
                    $c->setName($name)->save();
                } else {
                    $c->setName(null)->save();
                }

                $s->reload();

                if ($professor && $professor != '&nbsp;') {
                    $s->setProfessor($professor);
                } else {
                    $s->setProfessor(null);
                }
                
                $s->save();
            }
        }
    }
}

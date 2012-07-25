<?php

$term = '201130';

require_once(__DIR__ . '/../functions.php');

$school = SchoolQuery::create()->filterBySlug('northeastern')->findOne();

// update departments

$depts = curl_post("https://bnr8ssbp.neu.edu/udcprod8/bwckctlg.p_disp_cat_term_date",
    array(
        'call_proc_in' => 'bwckctlg.p_disp_dyn_ctlg',
        'cat_term_in'  => $term
    )
);

preg_match("/sel_dept.+?\/SELECT/s", $depts, $matches);
preg_match_all("/VALUE\=\"(.+?)\"\>(.+?)\</s", $matches[0], $matches, PREG_SET_ORDER);
foreach ($matches as $m) {
    $dept = DeptQuery::create()->filterBySchool($school)->filterByAbbr($m[1])->findOne();
    if ($dept) {
        $dept->setName($m[2])->save();
    }
}

$courses = CourseQuery::create()->filterBySchool($school)->find();
foreach ($courses as $c) {
    $result = curl_get("https://bnr8ssbp.neu.edu/udcprod8/bwckctlg.p_disp_course_detail?"
        ."cat_term_in=$term&subj_code_in=".$c->getDept()->getAbbr()."&crse_numb_in=".$c->getNum());

    if (preg_match('/' . $c->getDept()->getAbbr() . '\s' . $c->getNum() . '\s\-\s(.+?)\</', $result, $matches)) {
        echo $c->getDept()->getAbbr() . $c->getNum() . "\n";
        $c->setName(htmlspecialchars_decode($matches[1]))->save();
    }

    $url = "https://bnr8ssbp.neu.edu/udcprod8/bwckctlg.p_disp_listcrse?term_in=$term&subj_in="
        .$c->getDept()->getAbbr()."&crse_in=".$c->getNum()."&schd_in=";
    $sections = curl_get($url);

    if (preg_match_all("/(\d{5})\s\-\s.+?Instructors\:\s\<\/SPAN\>(.+?)(?:\<|\()/s", $sections, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $m) {
            $section = SectionQuery::create()
                ->filterByCourse($c)
                ->filterByNum($m[1])
                ->findOne();
            if ($section) {
                $section->setProfessor(trim($m[2]))->save();
            }
        }
    }


}

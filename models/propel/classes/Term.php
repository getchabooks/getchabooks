<?php

/**
 * @package propel.generator.
 */
class Term extends BaseTerm {

    public static $identifiers = array('BId');
    public static $attributes = array('Name');
    public static $metadata = array();
    public $debug = 'Name';

    public function getDeptSelect() {
        $this->ensureConsistency();

        $depts = DeptQuery::create()
            ->filterByTerm($this)
            ->withColumn('IF(Dept.Name IS NOT NULL, Dept.Name, Dept.Abbr)', 'DisplayName')
            ->orderBy('DisplayName', 'asc')
            ->orderBy('Dept.Abbr', 'asc')
            ->find();

        $r = array();
        foreach ($depts as $d) {
            $r[] = array(
                'name' => $d->getDisplayName(),
                'id' => $d->getId()
            );
        }

        return $r;
    }

    public function preSave(PropelPDO $con = null) {
        $slug = preg_replace("/[^a-z0-9]/", "", strtolower($this->getName()));
        $slug = preg_replace("/20(\d\d)/", "$1", $slug);

        $this->setSlug($slug);

        return true;
    }

    public function guessDate() {
        // 0-indexed months used throughout
        $name = strtolower($this->getName());
        $currentMonth = (int)date("n") - 1;
        $yy = (int)date("y");
        $yyyy = (int)date("Y");

        $months = array('jan', 'feb', 'mar', 'apr', 'may', 'jun',
                        'jul', 'aug', 'sep', 'oct', 'nov', 'dec');

        $terms = array(0 => 'win', 1 => 'spr', 5 => 'sum', 8 => 'fall');

        if (preg_match("/\d{4}/", $name, $match)) {
            $year = (int)$match[0];
        } else if (preg_match("/\d{2}/", $name, $match)) {
            $year = (int)("20" . $match[0]);
        } else {
            $year = null;
        }

        $foundMonths = array();
        if (preg_match_all("/" . implode('|', $months) . "/", $name, $matches)) {
            foreach ($matches[0] as $m) {
                $foundMonths[] = array_search($m, $months);
            }
        }
        
        if (preg_match_all("/" . implode('|', $terms) . "/", $name, $matches)) {
            foreach ($matches[0] as $m) { 
                $foundMonths[] = array_search($m, $terms);
            }
        }

        if ($foundMonths) {
            $month = round(array_sum($foundMonths)/count($foundMonths));
        } else {
            $month = null;   
        }

        $currentYear = (int)date('Y');
        if ($month && $year === null) {
            $year = $month > 3 ? $currentYear : $currentYear + 1;
        }

        if ($year === null) {
            $year = $currentYear;
        }

        if ($month === null) {
            $month = 1;
        } else {
            $month++;
        }

        return new DateTime("$year-$month-01");
    }


} // Term

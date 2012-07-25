<?php

/**
 * @package propel.generator.
 */
class Dept extends BaseDept {  
    
    public static $identifiers = array('BId');
    public static $attributes = array('Abbr');
    public static $metadata = array('Name');
    public $debug = 'Abbr';

    public function getAbbr($escaped = false) {
        if ($escaped) {
            return preg_replace('/[\/\,\+]/', ';', parent::getAbbr());
        } else {
            return parent::getAbbr();
        }
    }

    public function getCourseSelect() {
        $this->ensureConsistency();

        $courses = CourseQuery::create()
            ->filterByDept($this)
            ->withColumn('LPAD(Course.Num, 6, "0")', 'sortkey')
            ->orderBy('sortkey', 'asc')
            ->find();

        $r = array();
        
        foreach ($courses as $c) {
            $r[] = array(
                'name' => $c->getName(),
                'id' => $c->getId(),
                'number' => $c->getTrimmedNum()
            );
        }

        return $r;
    }
}

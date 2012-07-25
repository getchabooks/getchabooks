<?php

/**
 * @package propel.generator.
 */
class Course extends BaseCourse {

    public static $identifiers = array('BId');
    public static $attributes = array('Num');
    public static $metadata = array('Name');
    public $debug = 'Num';

    public function getNum($escaped=false) {
        if ($escaped) {
            return preg_replace('/[\/\,\+]/', ';', parent::getNum());
        } else {
            return parent::getNum();
        }
    }

    public function getTrimmedNum($escaped=true) {
        $num = $this->getNum($escaped);
        if ((int)$num == 0) {
            return $num;
        } else {
            return ltrim($num, '0');
        }        
    }

    public function getSectionSelect() {
        $this->ensureConsistency();

        $sections = SectionQuery::create()
            ->filterByCourse($this)
            ->orderBy('Section.Num', 'asc')
            ->find();

        $r = array();

        foreach ($sections as $s) {
            $r[] = array(
                'professor' => $s->getProfessor(),
                'id' => $s->getSlug(),
                'number' => $s->getNum() 
            );
        }

        return $r;

    }

}

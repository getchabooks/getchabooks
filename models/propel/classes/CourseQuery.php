<?php


/**
 * @package propel.generator.
 */
class CourseQuery extends BaseCourseQuery {
    
    public function filterBySchool($school) {
        $this->useDeptQuery()
                ->useTermQuery()
                    ->useCampusQuery()
                        ->filterBySchool($school)
                    ->endUse()
                ->endUse()
            ->endUse();
            
        return $this;
            
    }

} // CourseQuery

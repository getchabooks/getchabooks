<?php

/**
 * @package propel.generator.
 */
class SectionQuery extends BaseSectionQuery {
    
    public function filterBySchool($school) {
        $this->useCourseQuery()
                ->useDeptQuery()
                    ->useTermQuery()
                        ->useCampusQuery()
                            ->filterBySchool($school)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse();
            
        return $this;
            
    }

} // SectionQuery

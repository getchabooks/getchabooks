<?php

/**
 * @package propel.generator.
 */
class SectionHasItemQuery extends BaseSectionHasItemQuery {
    
    public function filterBySchool($school) {
        $this->useSectionQuery()
                ->useCourseQuery()
                    ->useDeptQuery()
                        ->useTermQuery()
                            ->useCampusQuery()
                                ->filterBySchool($school)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse();
                
        return $this;
    }
    

} // SectionHasItemQuery

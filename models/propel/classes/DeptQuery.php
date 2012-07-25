<?php

/**
 * @package propel.generator.
 */
class DeptQuery extends BaseDeptQuery {
    
    public function filterBySchool($school) {
        $this->useTermQuery()
                ->useCampusQuery()
                    ->filterBySchool($school)
                ->endUse()
            ->endUse();
            
        return $this;
    }
    

} // DeptQuery

<?php

/**
 * @package propel.generator.
 */
class TermQuery extends BaseTermQuery {
    
    public function filterBySchool($school) {
        $this->useCampusQuery()
                ->filterBySchool($school)
            ->endUse();
            
        return $this;
    }

} // TermQuery

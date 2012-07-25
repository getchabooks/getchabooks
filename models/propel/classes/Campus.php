<?php

/**
 * @package propel.generator.
 */
class Campus extends BaseCampus {
    public static $identifiers = array('BId');
    public static $attributes = array('Name');
    public static $metadata = array();
    public $debug = 'Name';

    public function postSave(PropelPDO $con = null) {
        global $skipCampusPostSave;

        if (isset($skipCampusPostSave) && $skipCampusPostSave) {
            return true;
        }

        // update campus slugs
        $siblingCampuses = CampusQuery::create()
            ->filterBySchoolId($this->getSchoolId())
            ->orderBy('Campus.BId', 'asc')
            ->find();

        $skipCampusPostSave = true;
        $i = 1;
        foreach ($siblingCampuses as $campus) {
            $campus->setSlug($i++)->save();
        }
        $skipCampusPostSave = false;

        // update term statuses
        $current = false;
        $terms = array();
        foreach ($this->getTerms() as $term) {
            $terms[] = array($term, $term->guessDate());
        }

        usort($terms, function ($a, $b) {
            return ($a[1] == $b[1] ? 0 : ($a[1] < $b[1] ? -1 : 1));
        });

        $seenCurrent = false;
        $now = new DateTime();
        foreach ($terms as $term) {
            $name = strtolower($term[0]->getName());
            $diff = $now->diff($term[1]);
            if (preg_match('/fall|spr/', $name) && abs($diff->days) <= 60) {
                foreach ($terms as $t) {
                    if ($t[0]->getStatus() == 0) {
                        $t[0]->setStatus(1)->save();
                        break;
                    }
                }
                $status = 0;
                $seenCurrent = true;
 
            } else if (!$seenCurrent && abs($diff->days) <= 60) {
                $status = 0;
                $seenCurrent = true;
            } else if (abs($diff->days) <= 60) {
                $status = 1;
            } else {
                $status = $now < $term[1] ? 1 : -1;
            }
            $term[0]->setStatus($status)->save(); 
        }

        if (!$seenCurrent) {
            foreach ($terms as $term) {
                if ($term[0]->getStatus() === 1) {
                    $term[0]->setStatus(0)->save();
                    $seenCurrent = true;
                    break;
                }
            }
        }

        if (!$seenCurrent) {
            foreach ($terms as $term) {
                $term[0]->setStatus(0)->save();
                break;
            }
        }

        return true;
    }

    public function getTermSelect() {
        /**
         * There seems to be a consistency issue wherein an object maintains a
         * cache of its related objects, and if items didn't exist before
         * and are added by spidering, the cache will not be updated.  This
         * fixes that.
         */
        $this->ensureConsistency();

        $terms = TermQuery::create()
            ->filterByCampus($this)
            ->find();

        $r = array();
        foreach ($terms as $t) {
            $r[] = array(
                'name' => $t->getName(),
                'id' => (string)$t->getId(),
                'slug' => $t->getSlug(),
                'selected' => $t->getStatus() === 0,
                'hasCourseData' => $t->getHasCourseInfo()
            );
        }

        return $r;
    }

}

<?php

/**
 * @package propel.generator.
 */
class SectionHasItemPeer extends BaseSectionHasItemPeer {


    /**
     * This is a hack that works around http://forum.symfony-project.org/viewtopic.php?f=20&t=20821&start=0&sid=b55767dce5f8402ffeeeb91ad326ee87
     */ 
    public static function getInstanceFromPool($key)
    {
        if (null !== $key) {
            return parent::getInstanceFromPool($key);
        } else {
            return null;
        }
    }

} // SectionHasItemPeer

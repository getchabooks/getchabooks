<?php

/**
 * If you use different databases for development and production, it can be tedious to maintain 
 * propel configuration and database schema files in version control, because you need to change the
 * database name and re-run propel-gen after pulling so the propel base objects refer to the correct
 * database.
 * 
 * This behavior allows you to specify a constant that will be defined when propel is loaded and
 * which will be used as the database name in the generated Peer and Query classes instead of a
 * hardcoded string.
 */

class CustomDbBehavior extends Behavior {

    // default parameter values
    protected $parameters = array(
        'original_name' => 'gbpropel',          // the actual name of the database in schema.xml
        'db_name_constant'  => 'GB_DATABASE'
    );

    public function objectFilter(&$script) {
        // not necessary
    }

    /**
     * Replaces all instances of the original database name with the db name constant.
     */
    public function queryFilter(&$script) {
        $find = '\'' . $this->getParameter('original_name') . '\'';
        $replace = $this->getParameter('db_name_constant');

        $script = str_replace($find, $replace, $script);
    }

    /**
     * Replaces all instances of the original database name with the db name constant.
     */ 
    public function peerFilter(&$script) {
        $find = '\'' . $this->getParameter('original_name') . '\'';
        $replace = $this->getParameter('db_name_constant');

        $script = str_replace($find, $replace, $script);
    }
}

<?php

class Book extends BaseBook {

    public function __get($name) {
        if ($name == 'prices') {
            return $GLOBALS['pricesByIsbn'][$this->getIsbn() ?: $this->getId()];    
        }
    }

    public function isPackageComponent() {
        return false;
    }

    public function getDescription() {
        return "";
    }

    public function getPackageId() {
        return null;
    }

    public function getIsPackage() {
        return false;
    }

}

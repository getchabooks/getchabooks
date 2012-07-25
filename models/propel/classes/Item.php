<?php

class Item extends BaseItem {

    /**
     * Allows dynamic accessing of the $prices property using the $pricesByIsbn global.
     */
    public function __get($name) {
        if ($name == 'prices') {
            return $GLOBALS['pricesByIsbn'][$this->getIsbn() ?: $this->getId()];
        } else if (method_exists($this, 'get'.ucfirst($name))) {
            return call_user_func(array($this, 'get'.ucfirst($name)));
        } else {
            throw new Exception("Undefined property via Item->__get(): $name");
        }
    }

    public static function getComponents(array $itemIds) {
        $query = ItemQuery::create()
            ->filterByPackageId($itemIds)
            ->orderBy('Item.Title')
            ->find();

        return $query;
    }

    public static function getStatusText($const) {
        if ($const == SectionHasItem::RECOMMENDED) {
            return "(Recommended)";
        } else if ($const == SectionHasItem::GO_TO_CLASS_FIRST) {
            return "(Go To Class First)";
        } else if ($const == SectionHasItem::BOOKSTORE_RECOMMENDED) {
            return ""; // handled below now -- "Bookstore Recommended";
        } else {
            return "";
        }
    }

    public function isPackageComponent() {
        return $this->getPackageId() && $this->getDescription() != "";
    }

    public function getDescription($status=null) {
        global $inPackageScope;

        if (!isset($inPackageScope)) {
            $inPackageScope = false;
        }

        if ($status === SectionHasItem::BOOKSTORE_RECOMMENDED) {
            return "This is a bookstore recommended item. "
                 . "It may be a component of a bundled package.";
        } else if ($this->getIsPackage()) {
            $inPackageScope = true;
            return "This is a package. You might be able to buy its components separately for less.";
        } else if ($inPackageScope && $this->getPackageId()) {
            return "This is an item in the above package.";
        }

        $inPackageScope = false;
        return "";
    }

    /**
     * Return this Item's Book's value for a field if set, otherwise the item's value.
     * @param string $field     UpperCamelCase field name
     */
    public function getBookData($field) {
        if ($book = $this->getBook()) {
            // checking ISBN should prevent a strange error where a book gets set without an ISBN
            // and then when any item shows up in results without a '' ISBN, we think it's associated with
            // this book
            if ($book->getIsbn() && $value = call_user_func(array($book, "get$field"))) {
                return $value;
            }
        }

        return call_user_func("parent::get$field");
    }

    public function getTitle() {
        return $this->getBookData('Title');
    }

    public function getAuthor() {
        return $this->getBookData('Author');
    }

    public function getPublisher() {
        return $this->getBookData('Publisher');
    }

    public function getEdition() {
        if ($book = $this->getBook()) {
            if ($pubdate = $book->getPubdate()) {
                return $pubdate . (($edition = $book->getEdition()) ? ": $edition" : '');
            }
        }

        return parent::getEdition();
    }

    public function getImageUrl() {
        if ($imageUrl = $this->getBookData('ImageUrl')) {
            return $imageUrl;
        } else {
            return BASE_URL . '/images/null.png';
        }
    }

    /**
     * Return the bookstore used price for an item.
     * @param bool $includeTax  whether to include tax
     */
    public function getBUsed($includeTax=true) {
        return parent::getBUsed();
    }
}

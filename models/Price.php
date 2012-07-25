<?php

/**
 * A single offer from one Vendor for one Item/Book
 *
 * Vendors set Price attributes themselves, rather than Price having a
 * constructor.
 */
class Price {

    /**
     * The class name of this price's Vendor
     */
    public $vendorName;

    /**
     * The Item/Book's ISBN, or, if it doesn't have one, its bookstore item ID
     */
    public $bookId;

    /**
     * The Vendor's ID that uniquely identifies this particular copy/offer
     */
    public $offerId;

    /**
     * The subtotal retail price for the Item/Book, without shipping or tax.
     */
    public $subtotal;

    /**
     * The shipping cost, only referenced in calculations if the vendor is a
     * non-formulaic shipper.
     */
    public $shipping;

    /**
     * If set, an asterisk will be displayed next to this price in the table,
     * with a tooltip saying "You may be able to get this book used for
     * $asteriskPrice".
     *
     * This is necessary for BnCollege, which we always display the new price
     * for even though they always provide a used price, because they don't
     * provide data about whether they actually have used copies in stock, and
     * our personal experience has been that they often don't.
     */
    public $asteriskPrice;

    /**
     * This is used to calculate shipping for vendors that differentiate between
     * hardcovers and paperbacks (e.g. Half). Those vendors are the only ones
     * that set it (or that need to).
     */
    public $isPaperback = false;

    /**
     * Makes it easier for the callee to access total, tax, description, and url.
     *
     * Also ensures that tax and total will never be unexpectedly not yet set
     * when using them in internal functions.
     */
    public function __get($var) {
        if ($var == 'url' || $var == 'total' || $var == 'tax' || $var == 'description') {
            $method = "get" . ucfirst($var);
            return $this::$method();
        } else {
            throw new Exception("Unknown property: $var");
        }
    }

    public function getTotal() {
        return $this->subtotal + $this->shipping + $this->tax;
    }

    public function getTax() {
        global $state;

        $v = $this->vendorName;
        $this->tax = $v::getTax($this->subtotal, $state);
        return $this->tax;
    }

    public function getUrl() {
        return call_user_func("{$this->vendorName}::getUrl", array($this));
    }

    public function getDescription() {
        $vendorName = $this->vendorName;
        $vendorName = $vendorName::getName();
        $name = $vendorName != 'Bookstore' ? $vendorName : 'the bookstore';
        return "1 book from $name";
    }

}

<?php

/**
 * A set of prices that all have the same Vendor.
 */
class Combo extends PriceSet {

    public $vendorName;
    public $prices;

    public function __construct($prices, $vendor) {
        $this->prices = array_filter($prices, function ($price) {
            return $price && $price->total > 0;
        });
        $this->numItems = count($this->prices);
        foreach ($this->prices as $price) {
            $this->subtotal += $price->subtotal;
        }

        $this->vendor = $vendor;
        $this->vendorName = $vendor::getName();

        $this->tax = $vendor::getTax($this->subtotal, $GLOBALS['state']);
        $this->shipping = $vendor::getShipping($this->prices);
        $this->total = $this->subtotal + $this->tax + $this->shipping;
        
        $this->url = $this->prices ? $vendor::getUrl($this->prices) : null;

    }

    /**
     * @return string    the description text for the results table column
     *                   header tooltip
     */
    public function getDescription() {
        $m = $this->vendorName == 'Bookstore' ? 'The bookstore' : $this->vendorName;

        if ($this->isComplete) {
            $m .= " has all of your books";

            if ($this->percentSaved > 0) {
                $m .= " for " . ($this->vendorName == 'Chegg' ? 'rent' : 'sale')
                    . " for <span class='money'>{$this->percentSaved}%</span> less than your school bookstore";
            }
        } else if ($this->numItems > 0) {
            $m .= " only has {$this->numItems} of your books";
        } else {
            $m .= " doesn't have any of your books";
        }

        $m .= ".";

        if ($this->vendorName == 'Bookstore') {
            $m .= " You may be able to get them used for less.";
        }

        return $m;
    }
}


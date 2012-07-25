<?php

/**
 * Abstract class for a set of Prices.  Encapsulates price member variables and
 * logic for calculating the amount saved relative to the bookstore.
 */
abstract class PriceSet {
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $total = 0;

    public $numItems = 0;

    public $percentSaved = null;
    public $amountSaved = null;
    public $saved = null;


    public function setComparisonInfo($numItems, $cost) {
        global $overviewSavedDisplay;

        if ($this->numItems > $numItems) {
            throw new GetchabooksError("PriceSet::setComparisonInfo called with"
                                       . "inconsistent \$numItems."); 
        } else if ($this->numItems == $numItems) {
            $this->isComplete = true;
        } else {
            $this->isComplete = false;
        }

        if ($cost) {
            $this->amountSaved = max(0, $cost - $this->total);
            $this->percentSaved = round(100 * $this->amountSaved/$cost, 0);

            if ($overviewSavedDisplay == 'percent') {
                $this->saved = $this->percentSaved . '%';
            } else {
                $this->saved = '$' . money($this->amountSaved);
            }
        } else {
            $this->saved = '';
        }

    }  
}

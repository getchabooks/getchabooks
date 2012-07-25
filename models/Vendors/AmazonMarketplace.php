<?php

class AmazonMarketplace extends BaseVendor implements Vendor {

    public static function getName() {
        return 'Amazon Marketplace';
    }

    public static function getDescription() {
        return 'Amazon Marketplace features independent sellers alongside Amazon\'s selection.';
    }

    public static function shippingCostPerOrder() {
        return 0;
    }

    public static function shippingCostPerHardcover() {
        return 3.99;
    }

    public static function shippingCostPerPaperback() {
        return 3.99;
    }

    public static function getUrl(array $prices) {
        global $tag, $marketplaceSingleCart;

        if (!$marketplaceSingleCart && count($prices) == 1) {
            return "http://www.amazon.com/gp/offer-listing/"
                . Isbn::to10(current($prices)->bookId) . "/condition=all&tag=$tag";
        } else {
            return Amazon::getUrl($prices);
        }
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    public static function fetchPrices(array $isbns) {
        /** 
         * AmazonMarketplace prices are handled by Amazon.  Amazon::fetchPrices 
         * must be done executing (in the fork/execd fetch_prices script) before 
         * AmazonMarketplace::getPrices (which sees the prices stored by 
         * Amazon::fetchPrices in memcached) is called.
         * executed first.
         */
        return array();
    }
}

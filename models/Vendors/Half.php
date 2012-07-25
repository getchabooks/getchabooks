<?php

class Half extends BaseVendor implements Vendor {

    public static function getName() {
        return 'Half';
    }

    public static function getDescription() {
        return 'Half.com is an eBay subsidiary that lets third-parties list items for sale at fixed prices.';
    }

    public static function shippingCostPerOrder() {
        return 0;
    }

    public static function shippingCostPerHardcover() {
        return 3.99;
    }

    public static function shippingCostPerPaperback() {
        return 3.49;
    }

    public static function getUrl(array $prices) {
        global $tag;

        $base = 'http://rover.ebay.com/rover/1/8971-56017-19255-0/1?ff3=8&pub=' . HALF_PUBID .
                '&toolid=10001&campid=' . HALF_CAMPAIGNID . '&customid=' . $tag . '&mpre=';

        if (count($prices) == 1) {
            $url = 'http://search.half.ebay.com/' . current($prices)->bookId;
        } else {
            $productIds = array_map(function($p) { return $p->productId; }, $prices);
            $idString = implode(",", $productIds);
            $url = "http://cart.half.ebay.com/ws/eBayISAPI.dll?ShoppingCart"
                   . "&action=additem&itemid=$idString&view=editview";
        }

        return $base . $url; // urlencode($url);
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    public static function fetchPrices(array $isbns) {
        $ret = array();

        foreach ($isbns as $isbn) {
            $url = "http://open.api.ebay.com/shopping?callname=FindHalfProducts&siteid=0&" .
                "responseencoding=XML&appid=" . HALF_APPID .
                "&IncludeSelector=Items&version=527&ProductID.value="
                . $isbn . "&ProductID.type=ISBN";

            $product = simplexml_load_string(self::get($url))->Products->Product[0];
            if ($product->MinPrice != 0) {
                $p = new Price();
                $p->bookId = $isbn;
                $p->vendorName = "Half";

                // TODO: make sure the reference Product ID always comes before the
                // ISBN and other product IDs in the API response, or adapt this
                $p->productId = (string)$product->ProductID[0];
                //$p->offerId is not set
                $p->subtotal = (float)$product->MinPrice;
                $p->shipping = (float)$product->ShippingCostSummary->ShippingServiceCost;
                if ($p->shipping == 3.49) {
                    $p->isPaperback = true;
                }

                foreach ($product->ItemArray->Item as $item) {
                    if ((float)$item->CurrentPrice <= $p->subtotal + .001) {
                        $p->productId = (string)$item->ItemID;
                        break;
                    }
                }

                $ret[$isbn] = $p;
            }
        }

        return $ret;
    }

}

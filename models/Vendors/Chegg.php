<?php

class Chegg extends BaseVendor implements Vendor {

    public static function getName() {
        return 'Chegg';
    }

    public static function getDescription() {
        return 'Chegg is a textbook rental site that lets you rent your textbooks until the end of the semester.';
    }

    public static function shippingCostPerOrder() {
        return 1;
    }

    public static function shippingCostPerHardcover() {
        return 2.99;
    }

    public static function shippingCostPerPaperback() {
        return 2.99;
    }

    public static function getUrl(array $prices) {
        global $tag, $cheggSingleCart;

        if (!$cheggSingleCart && count($prices) == 1) {
            return "http://www.kqzyfj.com/click-" . CJ_SITE_PID . "-10692263"
                   . "?SID=$tag&url=http%3a%2f%2fchegg.com%2fsearch%2f" . current($prices)->bookId;
        } else {
            $ids = array_map(function ($p) { return $p->offerId; }, $prices);

            // todo: check if this is actually converting
            $url = "http://www.chegg.com/?referrer=CJGATEWAY&PID=&AID=&SID=$tag&pids=";
            return $url . implode(',', $ids);

        }
    }

    public static function getTax($subtotal, $state=null) {
        return $subtotal * taxRate($state) / 100.0;
    }

    public static function fetchPrices(array $isbns) {
        $ret = array();

        for ($i=0; $i < count($isbns); $i += 10) {
            $url = "http://api.chegg.com/rent.svc?KEY=".CHEGG_KEY."&PW=".CHEGG_PASS."&R=XML&V=2.0&with_pids=1&isbn="
                   . implode('%2C', array_slice($isbns, $i, 10));
            $result = @simplexml_load_string(self::get($url));

            if ($result->Items->Item) {
                foreach ($result->Items->Item as $item) {
                    $isbn = (string)$item->EAN;

                    if ($subtotal = (float)$item->Terms->Term[0]->Price) {
                        $p = new Price();
                        $p->bookId = $isbn;
                        $p->vendorName = "Chegg";
                        $p->offerId = (string)$item->Terms->Term[0]->Pid;
                        $p->subtotal = $subtotal;
                        $p->shipping = self::shippingCostPerOrder() + self::shippingCostPerHardcover();

                        $ret[$isbn] = $p;
                    }
                }
            }
        }

        return $ret;
    }

}

<?php

define('PRICE_LIFETIME', 600);

interface Vendor {

    /**
     * The name of the vendor, as displayed in the results table column headers,
     * and in outgoing link descriptions.
     */
    public static function getName();

    /**
     * A short description of the vendor, displayed as a tooltip on the results
     * table column headers.
     */
    public static function getDescription();

    /**
     * The base shipping cost per order from this vendor.
     *
     * If this is false, the default getShipping() implementation in
     * BaseVendor assumes that shipping costs vary between items.
     */
    public static function shippingCostPerOrder();

    /**
     * The shipping cost per hardcover book for this vendor.
     */
    public static function shippingCostPerHardcover();

    /**
     * The shipping cost per softcover book for this vendor.
     */
    public static function shippingCostPerPaperback();

    /**
     * Given an array of Price objects, return a single URL to a cart, buying wizard, or
     * search results page that contains all of those offers.
     *
     * @param array $prices
     * @return string
     */
    public static function getUrl(array $prices);

    /**
     * Given an array of ISBNs, return an array of Price objects found for those
     * ISBNs. The implementation need not include ISBNs for which no price was
     * found, but may if desired using a value of null.
     *
     * @param  array $isbns
     * @param  array $items  used by Bookstores to generate Prices
     * @return array of Prices keyed by ISBNs
     */
    public static function fetchPrices(array $isbns);

    public static function getTax($subtotal, $state);

    /**
     * This method is implemented in BaseVendor (providing memcached caching)
     * and BaseBookstore (translating Items to Prices) and there shouldn't be
     * any reason to replace these implementations in subclasses.
     *
     * @param  array $isbns
     * @param  array $items used by Bookstores to generate Prices
     * @return array of Prices keyed by $isbns, with null values for any
     *               ISBNs for which a price wasn't found.
     */
    public static function getPrices(array $isbns, array $items=null);

    /**
     * @param  array $prices   an array of Price objects
     * @return float    the lowest shipping cost for those prices
     */
    public static function getShipping(array $prices);

}

/**
 * Base vendor class that provides default implementations of some
 * functionality.
 */
abstract class BaseVendor {

    protected static $proxy = false;

    protected static function prepareOptions(array $opt) {
        if (static::$proxy) {
            $opt[CURLOPT_USERAGENT] = get_user_agent();
            list($opt[CURLOPT_PROXY], $opt[CURLOPT_PROXYUSERPWD]) = static::$proxy;

            // some combinations of proxies and websites don't work well with HTTP 1.1
            $opt[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_0;

            // Each website user should have their own cookie file for scraping to avoid 
            // collisions. The expected behavior is maintained on CLI as well.
            $opt[CURLOPT_COOKIEFILE] = '/tmp/' . session_id();
            $opt[CURLOPT_COOKIEJAR] = $opt[CURLOPT_COOKIEFILE];
        }

        return $opt;
    }

    public static function get($url, array $params=array(), array $options=array()) {
        return curl_get($url, $params, self::prepareOptions($options));
    }

    public static function post($url, array $params=array(), array $options=array()) {
        return curl_post($url, $params, self::prepareOptions($options)); 
    }

    public static function shippingCostPerPaperback() {
        return static::shippingCostPerHardcover();
    }

    public static function getPrices(array $isbns, array $items=null) {
        $ret = self::getCachedPrices($isbns);

        if ($isbns = array_diff($isbns, array_keys($ret))) {
            // get prices for uncached isbns
            $newPrices = static::fetchPrices($isbns);
            if (!is_array($newPrices)) {
                throw new GetchabooksError("Not an array.");
            }

            foreach ($newPrices as $isbn => $price) {
                self::setCachedPrice($isbn, $price);
                $ret[$isbn] = $price;
            }

            // unset unrequested ISBNs if all requested ISBNs were returned
            if (!array_diff($isbns, array_keys($ret))) {
                foreach (array_diff(array_keys($ret), $isbns) as $isbn) {
                    unset($ret[$isbn]);
                }
            }

            // cache null prices for ISBNs that weren't returned
            foreach (array_diff($isbns, array_keys($ret)) as $isbn) {
                self::setCachedPrice($isbn, null);
                $ret[$isbn] = null;
            }
        }

        return $ret;
    }

    public static function getShipping(array $prices) {
        if (static::shippingCostPerHardcover()) {
            $hardcovers = $paperbacks = 0;
            foreach ($prices as $p) {
                if ($p->isPaperback) {
                    $paperbacks++;
                } else {
                    $hardcovers++;
                }
            }
            return static::shippingCostPerOrder()
                + $hardcovers * static::shippingCostPerHardcover()
                + $paperbacks * static::shippingCostPerPaperback();

        } else {
            $total = 0;
            foreach ($prices as $p) {
                $total += $p->shipping;
            }
            return $total;
        }
    }

    public static function getCachedPrices(array $isbns, $vendorName=null) {
        global $gbCache;
        $vendor = $vendorName ?: get_called_class();

        $keys = array_map(function ($isbn) use ($vendor) {
            return "$vendor.$isbn";
        }, $isbns);

        $ret = $gbCache->getMulti($keys) ?: array();

        foreach ($ret as $k => $v) {
            $ret[substr($k, 1 + strpos($k, '.'))] = $v;
            unset($ret[$k]);
        }

        return $ret;
    }

    public static function setCachedPrice($isbn, Price $price=null, $vendorName=null) {
        global $gbCache;
        $vendor = $vendorName ?: get_called_class();

        $gbCache->set("$vendor.$isbn", $price, PRICE_LIFETIME);
    }
}



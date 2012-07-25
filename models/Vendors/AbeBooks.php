<?php

class AbeBooks extends BaseVendor implements Vendor {

    public static function getName() {
        return 'AbeBooks';
    }

    public static function getDescription() {
        return 'AbeBooks is one of the first and largest marketplaces of independent booksellers.';
    }

    public static function shippingCostPerOrder() {
        return 0;
    }

    public static function shippingCostPerHardcover() {
        return 0;
    }

    public static function shippingCostPerPaperback() {
        return 0;
    }

    public static function getUrl(array $prices) {
        global $app;

        $isbns = array_map(function ($p) {
            return $p->bookId;
        }, $prices);

        $base = "http://clickserve.cc-dt.com/link/tplclick?lid=41000000024289215&"
                . "pubid=" . GOOGLE_AFFILIATE_ID . "&cm_ven=PFX&cm_cat=affiliates&cm_pla=dlt&"
                . "cm_ite=" . GOOGLE_AFFILIATE_ID . "&redirect=";

        if (count($isbns) > 1) {
            return $app->urlFor('abebooks', array('isbns' => implode("-", $isbns)));
        } else {
            $isbn = current($isbns);
            $url = "http://www.abebooks.com/servlet/SearchResults?bi=0&bx=on&ds=30&isbn=$isbn"
                   . "&kn=$isbn+not+international+edition+not+ebook&recentlyadded=all&sortby=17&sts=t";
            return $base . urlencode($url);
        }
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    public static function fetchPrices(array $isbns) {
        // Price fetching now always occurs via an exec'd script, which means
        // we can use pctnl_fork, which usually we couldn't because it doesn't
        // work with Apache.

        /* But it doesn't seem to be working. */

        //$pids = array();

        $ret = array();

        foreach ($isbns as $isbn) {
            /*$pid = pcntl_fork();

            if ($pid == -1) {
                throw new GetchabooksError("Couldn't fork while fetching AbeBooks price.");
            } else if ($pid) { // parent
                $pids[] = $pid;
            } else {           // child  */
                $result = self::get("http://search2.abebooks.com/search?isbn=$isbn"
                                    ."&outputsize=long&clientkey=" . ABEBOOKS_CLIENTKEY);
                $result = simplexml_load_string($result);

                $p = null;

                foreach ($result->Book as $book) {
                    if (!preg_match("/intl|international|e\-?book/i",
                                    $book->vendorDescription . $book->keywords))
                    {
                        $p = new Price();
                        $p->bookId = $isbn;
                        $p->vendorName = "AbeBooks";
                        $p->offerId = (string)$book->bookId;
                        $p->subtotal = (float)$book->listingPrice;
                        $p->shipping = (float)$book->firstBookShipCost;

                        break;
                    }
                }

                $ret[$isbn] = $p;

            /*}*/
        }

        /*foreach ($pids as $pid) {
            pcntl_waitpid($pid);
        }*/

        //list($ret, $isbns) = self::getCachedPrices($isbns);
        return $ret;
    }

}

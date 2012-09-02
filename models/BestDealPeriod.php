<?php

/**
 * A class for determining the "Best Deal. Period." -- the best way to buy a set
 * of books when each book is available at zero or more vendors.
 *
 * There are two issues that make this non-trivial (we can't just choose the
 * best price for each book):
 *
 * 1. Different constant shipping cost per order between vendors.  For example, if Amazon has
 * a shipping cost of 3 + 1n and Half has a shipping cost of 4n, Half could
 * sometimes be counterintuitively more expensive for a combined order than you
 * would think just by looking at totals or subtotals.
 *
 * We actually don't address this.
 *
 * 2. Free Amazon Super Saver Shipping kicks in at $25.  This means that if you
 * were buying 20 books at $.01 + 3.99 shipping each ($80 total) on Amazon
 * Marketplace and they are available on Amazon proper for $3.50 each (and
 * normally $3 + .99n shipping), you can actually get them for $70 because of
 * Super Saver Shipping.
 *
 * This is very much a corner case, but we address it.
 *
 * In any case, our display logic doesn't show the Best Deal Period if it's less
 * than a certain threshold amount and/or percentage better than the cheapest
 * single-vendor deal, which also has the effect of being a guard against unforeseen
 * total failures of the algorithm.
 *
 * There are certain things lacking in our current way of handling this from a
 * user perspective.  When no vendor has a certain book, for instance, we don't
 * then display the Best Deal Period for the remaining books.
 */
class BestDealPeriod extends PriceSet {
    public $combos = array();

    /**
     * @param $prices   an array grouped by Item/Book of arrays of prices from
     *                  different vendors
     */
    public function __construct($prices) {
        $pairs = self::filterPrices($prices);
        $bestPrices = self::choosePrices($pairs);

        $partition = array_reduce($bestPrices, function ($s, $price) {
            $s[$price->vendorName][] = $price;

            return $s;
        }, array());

        foreach ($partition as $vendor => $prices) {
            $this->combos[$vendor] = new Combo($prices, $vendor);
        }

        foreach ($this->combos as $combo) {
            $this->subtotal += $combo->subtotal;
            $this->shipping += $combo->shipping;
            $this->tax += $combo->tax;
            $this->numItems = $combo->numItems;
        }

        $this->total = $this->subtotal + $this->shipping + $this->tax;
    }

    /**
     * @param array $prices     an array grouped by Item/Book of arrays of prices
     * @return array            an array grouped by Item/Book of the two
     *                          prices we care about; see choosePrices()
     */
    public static function filterPrices($prices) {
        return array_map(function ($prices) {
            $bestTotal = 10000;
            $bestAmazonTotal = 10000;
            $bestPrice = $bestAmazonPrice = null;

            $prices = array_filter($prices, function ($p) { return $p && $p->total; });
            foreach ($prices as $p) {
                if ($p->total < $bestTotal) {
                    $bestTotal = $p->total;
                    $bestPrice = $p;
                }

                if ($p->vendorName == 'Amazon' && $p->subtotal < $bestAmazonTotal) {
                    $bestAmazonTotal = $p->subtotal;
                    $bestAmazonPrice = $p;
                }
            }

            return array($bestPrice, $bestAmazonPrice);
        }, $prices);
    }

    /**
     * Choose the best way to buy a set of books when given the best overall
     * price and the best Amazon Super Saver Shipping-eligible price for each
     * book.
     *
     * @param array $pairs    an array of pairs of Prices for a book, the first
     *                        being the best price (which could be Amazon) and
     *                        the second being the best Amazon price.
     * @return array          an array of Prices.
     */
    public static function choosePrices($pairs) {
        // sort the pairs by the difference between the amazon subtotal + .99 and the best total
        usort($pairs, function ($p1, $p2) {
            list($b1, $am1) = $p1;
            list($b2, $am2) = $p2;

            if (!$am1 || !$am2) {
                if (!$am1 && !$am2) {       // amazon has neither of the books
                    return 0;
                } else {
                    return $am1 ? -1 : 1;   // amazon has only one of the books
                }
            }

            $diff1 = $am1->subtotal + .99 - $b1->getTotal();
            $diff2 = $am2->subtotal + .99 - $b2->getTotal();

            return $diff1 - $diff2;
        });

        $naiveBestChoices = array();
        foreach ($pairs as $p) {
            if ($p[0]) {        // only if at least one vendor has the book
                $naiveBestChoices[] = $p[0];
            }
        }
        $bestChoices = array();
        $amazonSubtotalSum = 0;
        $naiveBestTotalSum = 0;
        $flag = false;
        foreach ($pairs as $p) {
            if ($flag && $p[1] && $p[0] && $p[1]->subtotal + .99 <= $p[0]->getTotal()) {
                $p[0] = $p[1];
            }
            $flag = true;

            if ($amazonSubtotalSum < 25) {
                if ($p[1]) {
                    $bestChoices[] = $p[1];
                    $amazonSubtotalSum += $p[1]->subtotal;
                    $naiveBestTotalSum += $p[0]->getTotal();
                }
                // if super saver doesn't save money
                if (!$p[1] || ($amazonSubtotalSum >= 25 && $amazonSubtotalSum > $naiveBestTotalSum)) {
                    $bestChoices = $naiveBestChoices;
                    break;
                }
            } else if ($p[1] && $p[0] && ($p[1]->subtotal - $p[0]->getTotal()) <= .99) {
                $bestChoices[] = $p[1];
            } else if ($p[0]) {     // only if at least one vendor has the book
                $bestChoices[] = $p[0];
            }
        }

        return $bestChoices;

    }

    public function toString() {
        global $app;

        // lack of quoted attributes prevents weird double escaping errors
        $m = "<div class=bdp>";

        foreach ($this->combos as $combo) {
            if ($combo->vendorName == 'Bookstore' && $combo->numItems != 1) {
                $bookstoreMulti = 'true';
            } else {
                $bookstoreMulti = 'false';
            }
            $vendorName = ($combo->vendorName == 'Bookstore') ? 'the bookstore' : $combo->vendorName;

            $m .= "<p><span class=vendor data-bookstore=$bookstoreMulti>";
            $m .= "{$combo->numItems} book" . ($combo->numItems != 1 ? 's' : '');
            $m .= " from $vendorName</span>";

            if ($bookstoreMulti == 'false')  {
                $url = $app->urlFor('redirect', array(
                    'url' => '',
                    'type' =>  'bdp',
                    'vendor' => $combo->vendorName
                )) . $combo->url;
                $label = $combo->vendorName == 'Chegg' ? 'Rent' : 'Buy';

                $m .= "<button data-url=$url>$label</button></p>";

            } else {
                $m .= "</span></p>";

                foreach (array_values($combo->prices) as $i => $price) {
                    $num = ordinal($i + 1);

                    $url = $app->urlFor('redirect', array(
                        'url' => '',
                        'type' => 'bdp',
                        'vendor' => $price->vendorName
                    )) . $price->url;

                    $m .= "<p><span class=aBookstoreBook>$num Book</span>"
                           . "<button data-url=$url>Buy</button></p>";
                }
            }
        }

        $m .= "</div>";

        return $m;
    }
}

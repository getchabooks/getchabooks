<?php

require_once BASE_DIR . '/vendor/amazonapi/AmazonAPI.php';

/**
 * @param string $edition   an edition string
 * @return string       a formatted edition string
 */
function formatEdition($edition) {
    if ($edition == "") {
        return "";
    } else if (preg_match("/\d*(\d)/", $edition, $matches)) {
        switch ($matches[1]) {
        case "1": return $matches[0]."st ed.";
        case "2": return $matches[0]."nd ed.";
        case "3": return $matches[0]."rd ed.";
        default : return $matches[0]."th ed.";
        }
    } else if (preg_match("/edition/i", $edition)) {    // todo
        return preg_replace("/edition/i", "ed.", $edition);
    } else if (!preg_match("/(\.|edn|ed|edtn)$/i", $edition)) {
        return "$edition ed.";
    } else {
        return $edition;
    }
}

class Amazon extends BaseVendor implements Vendor {
    public static function getName() {
        return 'Amazon';
    }

    public static function getDescription() {
        return 'Amazon.com is known for wide selection, customer service, and often free shipping.';
    }

    public static function shippingCostPerOrder() {
        return 3;
    }

    public static function shippingCostPerHardcover() {
        return 0.99;
    }

    public static function shippingCostPerPaperback() {
        return 0.99;
    }

    public static function getTax($subtotal, $state=null) {
        if (in_array($state, array('KS', 'KY', 'NY', 'ND', 'WA'))) {
            return $subtotal * taxRate($state) / 100.0;
        } else {
            return 0;
        }
    }

    public static function getUrl(array $prices) {
        global $app, $tag, $amazonSingleCart;

        if (!$amazonSingleCart && count($prices) == 1) {
            // get first (and only element), even though it is not the 0th
            reset($prices);
            $price = current($prices);
            return "http://www.amazon.com/dp/" . Isbn::to10($price->bookId)
                . "?tag=$tag";
        } else {
            $offerIds = array();
            foreach ($prices as $p) {
                $offerIds[] = $p->offerId;
            }

            return $app->urlFor('cart',
                array(
                    'vendor' => 'amazon',
                    'ids' => implode(',', $offerIds),
                    'tag' => $tag
                )
            );
        }
    }

    public static function fetchPrices(array $isbns) {
        /* sometimes Amazon returns different (either additional or potentially
         * replacement) ISBNs than the ones we asked for.  We have no great way
         * to tell which of these ISBNs relates to which of the ISBNs we asked
         * for, so we take the following approach: if all of the ISBNs we asked
         * for were returned, then we disregard any additional ISBNs.
         * Otherwise, we include all of them.
         */
        $unrequestedIsbns = array();

        $ret = array();
        $results = self::getAmazonOffers($isbns);
        foreach ($results as $result) {
            foreach ($result->Items->Item as $item) {

                /* Sometimes we get an isbn of "" */
                If (!($isbn = (string)$item->ItemAttributes->EAN)) {
                    continue;
                };

                if (!in_array($isbn, $isbns)) {
                    $unrequestedIsbns[] = $isbn;
                }

                self::updateBook($isbn, $item);

                $amount = (float)$item->Offers->Offer[0]->OfferListing->Price->Amount/100.0;
                if ($amount) {
                    $p = new Price();
                    $p->bookId = $isbn;
                    $p->vendorName = "Amazon";
                    $p->offerId = "{A:$isbn}";
                    $p->subtotal = $amount;
                    $p->shipping = $p->subtotal > 25 ? 0 : 3.99;

                    $ret[$isbn] = $p;
                }

                $marketNew = (float)$item->OfferSummary->LowestNewPrice->Amount/100.0;
                $marketUsed = (float)$item->OfferSummary->LowestUsedPrice->Amount/100.0;
                if ($marketUsed && $marketNew) {
                    $market = min($marketNew, $marketUsed);
                } else {
                    $market = $marketNew ?: $marketUsed;
                }

                if ($market) {
                    $p = new Price();
                    $p->bookId = $isbn;
                    $p->vendorName = "AmazonMarketplace";
                    $p->offerId = "{MP:$isbn}";
                    $p->subtotal = $market;
                    $p->shipping = 3.99;

                    // side effect to handle Amazon and AmazonMarketplace
                    // fetching at the same time
                    self::setCachedPrice($isbn, $p, 'AmazonMarketplace');
                }
            }
        }

        return $ret;
    }

    public static function updateBook($isbn, $itemNode) {
        $book = BookQuery::create()
            ->filterByIsbn($isbn)
            ->findOneOrCreate();

        if ($data = Amazon::parseItemNode($itemNode)) {
            $book->setTitle($data['title'])
                ->setAuthor($data['author'])
                ->setPublisher($data['publisher'])
                ->setEdition($data['edition'])
                ->setPubdate($data['date'])
                ->setIsPaperback($data['isPaperback'])
                ->setImageUrl($data['image_url']);
        }

        $book->save();
    }

    /**
     * Makes an Amazon cart.  Requires $tag global to be set.
     *
     * todo: fail gracefully if amazon cart api goes down (it did once).
     *
     * @return string   the url of an Amazon cart containing the items referred to in $ids
     */
    public static function getCartUrl(array $isbns, array $offerListingIds=array()) {
        global $tag;

        $items = array();
        foreach ($isbns as $isbn) {
            $items[] = array('type' => 'ASIN', 'id' => Isbn::to10($isbn));
        }
        foreach ($offerListingIds as $id) {
            $items[] = array('type' => 'OfferListingId', 'id' => $id);
        }
        $amazon = new AmazonAPI();
        $data = array("AssociateTag" => $tag);
        $i = 1;
        $j = 1;
        $cartId = null;
        while ($j <= count($items)) {
            if ($cartId) {
                $data["CartId"] = $cartId;
                $data["HMAC"] = $hmac;
            }
            $data["Item.$i.{$items[$j-1]['type']}"] = $items[$j-1]['id'];
            $data["Item.$i.Quantity"] = "1";
            if ($i % 6 == 0 || $j == count($items)) {
                $operation = $cartId ? "CartAdd" : "CartCreate";
                $result = $amazon->request($operation, $data);
                $cartId = (string)$result->Cart->CartId;
                $hmac = (string)$result->Cart->HMAC;

                $i = 0;
                $data = array("AssociateTag" => $tag);
            }
            $i++;
            $j++;
        }

        return $result->Cart->PurchaseURL;
    }

    /**
     * @param $node an XML Item node in an Amazon response
     * @return  an array of metadata for the item
     */
    public static function parseItemNode($node) {
        $ret = array(
            'isbn'      => (string)$node->ItemAttributes->EAN,
            'title'     => preg_replace("/\(.+?\)$/", "", (string)$node->ItemAttributes->Title),
            'author'    => (string)$node->ItemAttributes->Author,
            'publisher' => (string)$node->ItemAttributes->Publisher,
            'date'      => substr((string)$node->ItemAttributes->PublicationDate, 0, 4),
            'edition'   => formatEdition((string)$node->ItemAttributes->Edition),
            'image_url' => (string)$node->LargeImage->URL,
            'isPaperback'=> (string)$node->ItemAttributes->Binding == 'Paperback'
        );

        if (!trim($ret['title'])) {
            return false;
        }

        if ($ret['author'] == "") {
            $ret['author'] = (string)$node->ItemAttributes->Creator;
            if ($node->ItemAttributes->Creator["Role"] == "Editor")
                $ret['author'] .= ", ed.";
        }

        return $ret;
    }

    /**
     * @param $isbn
     * @return  an array of metadata for $isbn
     */
    public static function getAmazonData($isbn) {
        $amazon = new AmazonAPI;

        $data = array(
            'IdType' => 'ISBN',
            'SearchIndex' => "Books",
            'ResponseGroup' => "Medium",
            'ContentType' => "text/xml",
            'MerchantId' => "All",
            'ItemId' => $isbn
        );
        $res = $amazon->request("ItemLookup", $data);

        return self::parseItemNode($res->Items->Item[0]);

    }

    /**
     * @param $isbns        an array of isbns
     * @return  an array of arrays of metadata, keyed by isbn
     */
    public static function getMultiAmazonData(array $isbns) {
        $amazon = new AmazonAPI;

        $data = array(
            'IdType' => 'ISBN',
            'SearchIndex' => "Books",
            'ResponseGroup' => "Medium",
            'ContentType' => "text/xml",
            'MerchantId' => "All",
            'ItemId' => implode(",", $isbns)
        );
        $res = $amazon->request("ItemLookup", $data);

        $ret = array();
        if ($res->Items) {
            foreach ($res->Items->Item as $item) {
                $data = self::parseItemNode($item);
                if ($item['title']) {
                    $ret[$data['isbn']] = $data;
                }
            }
        }

        return $ret;
    }

    /**
     * @param $isbns array of isbns to look up
     * @return array of Amazon ItemLookup XML responses
     *          (has to be an array in case more than 10 isbns were passed).
     */
    public static function getAmazonOffers(array $isbns) {
        $amazon = new AmazonAPI();

        $data = array(
            'IdType'        => "ISBN",
            'SearchIndex'   => "Books",
            'ResponseGroup' => "Medium,Offers",
            'ContentType'   => "text/xml",
            'MerchantId'    => "Amazon"
        );

        $ret = array();
        // Amazon limits us to 10 items per request
        foreach (array_chunk($isbns, 10) as $foo) {
            $data['ItemId'] = implode( ',', $foo );
            $ret[] = $amazon->request("ItemLookup", $data);
        }
        return $ret;
    }

    /**
     * @param $isbns array of isbns to look up
     * @return array of Amazon Marketplace ItemLookup XML responses
     *          (has to be an array in case more than 10 isbns were passed).
     */
    public static function getMarketplaceOffers(array $isbns) {
        $amazon = new AmazonAPI();

        $data = array(
            'IdType'        => "ISBN",
            'SearchIndex'   => "Books",
            'ResponseGroup' => "Medium,Offers",
            'ContentType'   => "text/xml",
            'MerchantId'    => "All",
            'Condition'     => "All"
        );

        $ret = array();
        foreach (array_chunk($isbns, 10) as $foo) {
            $data['ItemId'] = implode( ',', $foo );
            $ret[] = $amazon->request("ItemLookup", $data);
        }
        return $ret;
    }

}

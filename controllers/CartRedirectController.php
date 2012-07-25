<?php

class CartRedirectController {
    function render($vendor, $ids, $tag) {
        call_user_func(array($this, $vendor), $ids, $tag);
    }

    function amazon($ids, $tag) {
        $isbns = $lookupIsbns = array();
        foreach (explode(',', $ids) as $id) {
            preg_match("/\{(.+?)\:(.+?)\}/", $id, $matches);
            if ($matches[1] == 'A') {
                $isbns[] = $matches[2];
            } else if ($matches[1] == 'MP') {
                $lookupIsbns[] = $matches[2];
            } else {
                error_log("amazon cart called with bad input: $ids");
            }
        }

        // find current, lowest-priced offers for the marketplace isbns
        $offersArray = Amazon::getMarketplaceOffers($lookupIsbns);
        $offerIds = array();

        foreach ($offersArray as $offers) {
            foreach ($offers->Items->Item as $item) {
                // sometimes Amazon gives us different isbns than the ones we asked for
                if (in_array((string)$item->ItemAttributes->EAN, $lookupIsbns)) {
                    $offerIds[] = (string)$item->Offers->Offer[0]->OfferListing->OfferListingId;
                }
            }
        }

        $GLOBALS['tag'] = $tag;

        global $app;
        $app->redirect(Amazon::getCartUrl($isbns, $offerIds), 301);
    }

}


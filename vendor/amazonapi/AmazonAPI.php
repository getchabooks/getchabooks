<?php

/**
 * This file defines the AmazonAPI class for directly querying the Amazon API as described at
 *  http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/.
 *
 *  It is copied from http://gulati.info/2009/08/amazon-php-api/
 *
 *  Which appears to have moved to http://austingulati.com/2009/08/amazon-php-api/ .
 */

class AmazonAPI {

    var $pubKey, $secKey, $requestURL;

    function __construct() {
        $this->assocTag = AMAZON_ASSOCTAG;
        $this->pubKey = AMAZON_PUBKEY;
        $this->secKey = AMAZON_SECKEY;
        $this->requestURL = AMAZON_REQUESTURL;

    }

    function getRequest($request) {
        // Get a nice array of elements to work with
        $uri_elements = parse_url($request);

        // Grab our request elements
        $request = $uri_elements['query'];

        // Throw them into an array
        parse_str($request, $parameters);

        // Add the new required paramters
        $parameters['Timestamp'] = gmdate("Y-m-d\TH:i:s\Z");
        $parameters['AWSAccessKeyId'] = $this->pubKey;

        // The new authentication requirements need the keys to be sorted
        ksort($parameters);

        // Create our new request
        foreach ($parameters as $parameter => $value) {
            // We need to be sure we properly encode the value of our parameter
            $parameter = str_replace("%7E", "~", rawurlencode($parameter));
            $parameter = str_replace("_", ".", $parameter); //had to add this to make cart work, otherwise would do Item_1_ASIN instead of Item.1.ASIN
            $value = str_replace("%7E", "~", rawurlencode($value));
            $request_array[] = $parameter . '=' . $value;
        }

        // Put our & symbol at the beginning of each of our request variables and put it in a string
        $new_request = implode('&', $request_array);

        // Create our signature string
        $signature_string = "GET\n{$uri_elements['host']}\n{$uri_elements['path']}\n{$new_request}";

        // Create our signature using hash_hmac
        $signature = urlencode(base64_encode(hash_hmac('sha256', $signature_string, $this->secKey, true)));

        // Return our new request
        return "http://{$uri_elements['host']}{$uri_elements['path']}?{$new_request}&Signature={$signature}";
    }

    function request( $operation, $data ) {

        $url = "{$this->requestURL}&Operation={$operation}&AWSAccessKeyId={$this->pubKey}&AssociateTag={$this->assocTag}" . $this->buildData( $data );
        $url = $this->getRequest($url);
        //echo "<a href='$url'>XML</a>";
        $response = curl_get($url);
        $xml = simplexml_load_string( $response );
        return $xml;

    }

    function buildData( $data ) {
        $return = NULL;
        $i = 0;
        $t = count( $data );

        foreach( $data as $k => $v ) {
            $k = urlencode( $k );
            $v = urlencode( $v );
            $return .= "&{$k}={$v}";
        }

        return $return."&Timestamp=".str_replace(":", "%3A", gmdate("Y-m-d\TH:i:s\Z"));

    }
}




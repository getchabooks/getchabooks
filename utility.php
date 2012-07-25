<?php

class CurlError extends GetchabooksError {}

function curl_get($url, array $params=array(), array $options=array()) {
    if ($params) {
        $url .= '?' . http_build_query($params);
    }

    return curl_request($url, $options);
}

function curl_post($url, $params=null, array $options=array()) {
    $options[CURLOPT_POST] = true;
    $options[CURLOPT_POSTFIELDS] = $params;

    return curl_request($url, $options);
}

function curl_request($url, $options) {
    $defaults = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_VERBOSE => false,
        CURLOPT_ENCODING => "gzip,deflate"
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options + $defaults);

    $result = curl_exec($ch);
    if (!$result || curl_error($ch)) {
        throw new CurlError("Curl failed: " . curl_error($ch));
    }

    curl_close($ch);
    return $result;
}

function decho($var) {
    global $dechoBaseIndent, $indent;

    $dechoBaseIndent = isset($dechoBaseIndent) ? $dechoBaseIndent : count(debug_backtrace());

    if (php_sapi_name() == 'cli') {
        if (isset($indent)) {
            echo str_repeat("  ", $indent);
        } else {
            echo str_repeat("  ", count(debug_backtrace()) - $dechoBaseIndent);
        }

        echo $var;
    }
}

/**
 * @param $num a number
 * @return string  that number formatted as currency to two decimal places,
 *                 without any currency sign
 */
function money($num) {
    if (!is_numeric($num)){
        return "";
    }
    return number_format($num, 2, '.', ',');
}

function get_user_agent() {
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $_SESSION['UserAgent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    if (!isset($_SESSION['UserAgent'])) {
        require_once BASE_DIR . '/vendor/random-uagent/uagent.php';
        $_SESSION['UserAgent'] = random_uagent();
    }

    return $_SESSION['UserAgent'];
}

function titleCase($string) {
    $titleCase = array("The", "A", "An", "And", "But", "Or", "Not", "As",
                       "At", "By", "For", "In", "From", "Of", "To", "With");

    $name = trim(strtolower($string));
    $answer = preg_replace_callback("/\s[ivx]{1,4}(\Z|\W)/", function ($match) {
        return strtoupper($match[0]);
    }, $name);
    $answer = rtrim(ucwords($answer));
    $answer = preg_replace("/W\//", "w/", $answer);

    foreach ($titleCase as $word) {
        $answer = preg_replace("/\s$word\s/", " ".strtolower($word)." ", $answer);
    }
    return ucfirst(htmlspecialchars($answer));

}

// from php doc pages
function ucname($string) {
    $string = ucwords(strtolower($string));

    foreach (array('-', '\'', '/') as $delimiter) {
        if (strpos($string, $delimiter)!==false) {
            $string =implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
        }
    }
    return $string;
}

function cardinal($num) {
    switch ($num) {
    case 0: return 'zero';
    case 1: return 'one';
    case 2: return 'two';
    case 3: return 'three';
    case 4: return 'four';
    case 5: return 'five';
    case 6: return 'six';
    case 7: return 'seven';
    case 8: return 'eight';
    case 9: return 'nine';
    case 10: return 'ten';
    default: return $num;
    }
}

function ordinal($num) {
    $order = Array("Zeroth", "First", "Second", "Third", "Fourth", "Fifth",
        "Sixth", "Seventh", "Eighth", "Ninth", "Tenth", "Eleventh",
        "Twelfth", "Thirteenth", "Fourteenth", "Fifteenth", "Sixteenth");

    if ($num < count($order)) {
        return $order[$num];
    }

    switch ($num % 10) {
    case 1:
        return $num . 'st';
    case 2:
        return $num . 'nd';
    case 3:
        return $num . 'rd';
    default:
        return $num . 'th';
    }
}

/**
 * This is used by the below function but also at least one other thing.
 */
$taxRates = array(
    'AL' => 8.2,
    'AK' => 1.4,
    'AZ' => 8.15,
    'AR' => 8.2,
    'CA' => 9.15,
    'CO' => 6.4,
    'CT' => 6,
    'DE' => 0,
    'DC' => 6,
    'FL' => 6.7,
    'GA' => 6.95,
    'HI' => 4.4,
    'ID' => 6.05,
    'IL' => 8.2,
    'IN' => 7,
    'IA' => 6.85,
    'KS' => 8.05,
    'KY' => 6,
    'LA' => 8.75,
    'ME' => 5,
    'MD' => 6,
    'MA' => 6.25,
    'MI' => 6,
    'MN' => 6.2,
    'MS' => 7,
    'MO' => 7.25,
    'MT' => 0,
    'NE' => 6,
    'NV' => 7.85,
    'NH' => 0,
    'NJ' => 6.95,
    'NM' => 6.55,
    'NY' => 8.45,
    'NC' => 7.85,
    'ND' => 5.8,
    'OH' => 6.8,
    'OK' => 8.15,
    'OR' => 0,
    'PA' => 6.4,
    'RI' => 7,
    'SC' => 7.05,
    'SD' => 5.5,
    'TN' => 9.4,
    'TX' => 8.05,
    'UT' => 6.7,
    'VT' => 6.05,
    'VA' => 5,
    'WA' => 8.75,
    'WV' => 6,
    'WI' => 5.45,
    'WY' => 5.25
);

function taxRate($state) {
    if (isset($GLOBALS['taxRates'][$state])) {
        return $GLOBALS['taxRates'][$state];
    } else {
        return 0;
    }

}

/**
 * Remove any non-ASCII characters and convert known non-ASCII characters
 * to their ASCII equivalents, if possible.
 *
 * @param string $string
 * @return string $string
 * @author Jay Williams <myd3.com>
 * @license MIT License
 * @link http://gist.github.com/119517
 */
function convert_ascii($string) {
    // Replace Single Curly Quotes
    $search[] = chr(226).chr(128).chr(152);
    $replace[] = "'";
    $search[] = chr(226).chr(128).chr(153);
    $replace[] = "'";

    // Replace Smart Double Curly Quotes
    $search[] = chr(226).chr(128).chr(156);
    $replace[] = '"';
    $search[] = chr(226).chr(128).chr(157);
    $replace[] = '"';

    // Replace En Dash
    $search[] = chr(226).chr(128).chr(147);
    $replace[] = '--';

    // Replace Em Dash
    $search[] = chr(226).chr(128).chr(148);
    $replace[] = '---';

    // Replace Bullet
    $search[] = chr(226).chr(128).chr(162);
    $replace[] = '*';

    // Replace Middle Dot
    $search[] = chr(194).chr(183);
    $replace[] = '*';

    // Replace Ellipsis with three consecutive dots
    $search[] = chr(226).chr(128).chr(166);
    $replace[] = '...';

    // Apply Replacements
    $string = str_replace($search, $replace, $string);

    // Remove any non-ASCII Characters
    $string = preg_replace("/[^\x01-\x7F]/","", $string);

    return $string;
}

function innerHTML($node) {
    $doc = new DOMDocument();
    foreach ($node->childNodes as $child) {
        $doc->appendChild($doc->importNode($child, true));
    }
    return $doc->saveHTML();
}


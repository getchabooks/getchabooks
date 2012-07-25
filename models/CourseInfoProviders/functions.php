<?php

function formatCourseName($name) {
    $titleCase = array("The", "A", "An", "And", "But", "Or", "Not", "As", "At", "By", "For", "In", "From", "Of", "To", "With");

    $name = trim(strtolower($name));

    // roman numerals
    $answer = preg_replace_callback("/\s[ivx]{1,4}(\Z|\W)/", function ($matches) {
        return strtoupper($matches[0]);
    }, $name);
    $answer = rtrim(ucwords($answer));
    $answer = preg_replace("/W\//", "w/", $answer);

    foreach ($titleCase as $word) {
        $answer = preg_replace("/\s$word\s/", " ".strtolower($word)." ", $answer);
    }

    // based on ucname
    foreach (array('-', '/', ':', ',', '&') as $delimiter) {
        if (strpos($answer, $delimiter) !== false) {
            $answer =implode($delimiter, array_map('ucfirst', explode($delimiter, $answer)));
        }
    }

    return trim(ucfirst($answer));

}

// for Tufts
function formatProfessor($professor) {
    $professor = trim($professor);
    if ($professor == "STAFF") {
        return "";
    } else {
        $profArray = explode(',', $professor);
        return ucname(trim($profArray[0]));
    }
}

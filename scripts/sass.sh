#!/bin/bash

GB="$( dirname "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )")"
# echo $GB

rm -v $GB/assets/css/compiled/*

$GB/vendor/sass/bin/sass --update $GB/assets/css:$GB/assets/css/compiled

echo "I've had enough of your sass.";

#!/bin/bash

GB="$( dirname "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )")"
# echo $GB

touch $GB/production
rm -rv $GB/public/js
rm -rv $GB/public/css
mkdir $GB/public/js
mkdir $GB/public/css
$GB/gb sass
$GB/gb compress

ln -svf $GB/assets/css/compiled/ie.css $GB/public/css/ie.css
ln -svf $GB/assets/css/compiled/ie9.css $GB/public/css/ie9.css
ln -svf $GB/assets/js/excanvas.js $GB/public/js/echoxcanvas.js
ln -svf $GB/assets/js/modernizr.touch.js $GB/public/js/modernizr.touch.js

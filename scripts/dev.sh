#!/bin/bash

GB="$( dirname "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )")"
# echo $GB

rm $GB/production
rm -rv $GB/public/js
rm -rv $GB/public/css
ln -svf $GB/assets/css/compiled $GB/public/css
ln -svf $GB/assets/js $GB/public/js
$GB/gb sass


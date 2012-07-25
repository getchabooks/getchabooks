#!/bin/sh

cd /var/www/gb/production/

# Our current compression routine pollutes the working tree. Checkout fixes this.
git checkout -- .
git pull origin master
git submodule init
git submodule update

sudo ./gb sass
sudo ./gb compress
# sudo ./gb load
sudo ./gb json


#!/usr/bin/env bash
PROJECT_ROOT=/var/www
cp $PROJECT_ROOT/provisions/env.dev $PROJECT_ROOT/.env
source $PROJECT_ROOT/.env
VAGRANT_LOG_FILE=/var/log/vagrant.log
swapsize=2000        # size of swapfile in megabytes

touch $VAGRANT_LOG_FILE
exec 5>&1
exec > $VAGRANT_LOG_FILE

echo "Starting." >&5
usermod -a -G www-data vagrant



##
# Setup swapfile so we don't need to give it so much RAM
##

echo "Setup swap file." >&5
# does the swap file already exist?
grep -q "swapfile" /etc/fstab

# if not then create it
if [ $? -ne 0 ]; then
  echo 'swapfile not found. Adding swapfile.' >&5
  fallocate -l ${swapsize}M /swapfile
  chmod 600 /swapfile
  mkswap /swapfile
  swapon /swapfile
  echo '/swapfile none swap defaults 0 0' >> /etc/fstab
else
  echo 'swapfile found. No changes made.' >&5
fi

# output results to terminal
cat /proc/meminfo | grep Swap >&5



##
# Setup server
##

# begin installing
echo "Updating apt-get." >&5
apt-get update

# NGINX config
cp $PROJECT_ROOT/provisions/nginx.conf /etc/nginx/sites-enabled/
service nginx restart



##
# Seup tools
##

# Ruby
apt-get install -y ruby
gem install sass


wget http://www.adminer.org/latest-en.php
mv ./latest-en.php $PROJECT_ROOT/public/adminer.php

cd $PROJECT_ROOT

composer install -q
npm install -q
bower install --allow-root

if [ ! -L "$PROJECT_ROOT/storage/logs/php-fpm.log" ]; then
	ln -s /var/log/fpm-php.www.log $PROJECT_ROOT/storage/logs/php-fpm.log
fi
if [ ! -L "$PROJECT_ROOT/storage/logs/nginx-error.log" ]; then
	ln -s /var/log/nginx/error.log $PROJECT_ROOT/storage/logs/nginx-error.log
fi

echo "Done." >&5

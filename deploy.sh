#!/bin/sh
php artisan key:generate
php artisan config:cache
php artisan storage:link
# check if the database is ready
echo "Waiting for Mysql DB"
while ! mysql --protocol TCP -u"homestead" -p"homestead" -h"db" -e "show databases;" > /dev/null 2>&1;
do
  echo -n "."
  sleep 1
done
php artisan migrate
php-fpm
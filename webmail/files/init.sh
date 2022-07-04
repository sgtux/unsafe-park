#!/bin/bash
echo "***** Squirrel Webmail Server *****"

mkdir -p /var/run/apache2
HOST_IP=`ifconfig eth0 | grep inet | awk '{print $2}'`
echo ServerName $HOST_IP >> /etc/apache2/apache2.conf 
source /etc/apache2/envvars

if [ "$DOMAIN" = "" ];
then
  DOMAIN=example.lab
fi

sed -i "s/##DOMAIN##/$DOMAIN/g" /var/www/html/squirrelmail/config/config.php
sed -i "s/##DOMAIN##/$DOMAIN/g" /etc/postfix/main.cf
sed -i "s/##DOMAIN##/mail.$DOMAIN/g" /etc/apache2/sites-available/squirrelmail.conf

if [ "$THEME_INDEX" != "" ];
then
  sed -i "s/##THEME_INDEX##/$THEME_INDEX/g" /var/www/html/squirrelmail/config/config.php
  echo "Using theme $THEME_INDEX"
fi

if [ "$APP_NAME" = "" ];
then
  APP_NAME="SquirrelMail"
fi

sed -i "s/##APP_NAME##/$APP_NAME/g" /var/www/html/squirrelmail/config/config.php

a2ensite squirrelmail
if [ $? != 0 ];
then
  exit 1
fi
service dovecot start
if [ $? != 0 ];
then
  exit 1
fi
service postfix start
if [ $? != 0 ];
then
  exit 1
fi

if [ "$EMAIL_GATEWAY" != "" ];
then
  echo $EMAIL_GATEWAY | sed "s/;/\n/g" | sed "s/|/ /" > /etc/postfix/transport
  echo "Email gateways $EMAIL_GATEWAY"
  postmap /etc/postfix/transport
fi

echo "* Starting Apache HTTP Server"

exec /usr/sbin/apache2 -D "FOREGROUND"
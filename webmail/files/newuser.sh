#!/bin/bash
if [ "$1" = "" ] || [ "$2" = "" ];
then 
	echo "Invalid parameters user or password"
	exit
fi

if getent passwd $1 > /dev/null 2>&1;
then
	echo "User already exists"
	exit
fi

useradd -p $(openssl passwd -1 $2) $1
usermod -m -d /var/www/html/$1 $1
mkdir -p /var/www/html/$1
chown -R $1:$1 /var/www/html/$1
echo "User $1 created"
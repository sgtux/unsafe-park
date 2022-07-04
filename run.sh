#!/bin/bash
if [ -e ./shared/eve.json ]
then
	echo "Using existing eve.json file."
else
	touch ./shared/eve.json
	echo "File eve.json was created."
fi
docker-compose up -d --remove-orphans
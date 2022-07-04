#!/bin/bash

service suricata start
if [ $? != 0 ];
then
  exit 1
fi

echo "Surucata service was started!"

exec dotnet NetCoreWebGoat.dll --urls=http://*
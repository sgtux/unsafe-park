#!/bin/bash
service apache2 start
exec evebox server -c /etc/evebox/evebox.yaml
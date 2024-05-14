#!/usr/bin/env bash

TZ=UTC date +%s > "/var/www/html/dms_logs/dmt.txt"
dt=$(date '+%m/%d/%Y %H:%M:%S');
echo "$dt"

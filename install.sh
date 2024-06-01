#!/usr/bin/env bash
cp -a ./html/. /var/www/html
cp -a ./systemd/system/. /etc/systemd/system
TZ=UTC date +%s > "/var/www/html/dms_logs/dmt.txt"
mkdir ~/Desktop/dms_files
systemctl daemon-reload
systemctl enable --now dead-mans-switch.timer
systemctl start dead-mans-switch.service

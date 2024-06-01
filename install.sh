#!/usr/bin/env bash
cp -a ./html/. /var/www/html
cp -a ./systemd/system/. /etc/systemd/system
systemctl daemon-reload
systemctl enable --now dead-mans-switch.timer
systemctl start dead-mans-switch.service

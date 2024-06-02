#!/usr/bin/env bash
#
# Copy the html files
#
if ! cp -a ./html/. /var/www/html; then
    echo "Failed to copy to /var/www/html"
fi
#
# Copy the service and timer
#
if ! cp -a ./systemd/system/. /etc/systemd/system; then
    echo "Failed to copy to /etc/systemd/system"
fi
#
# Update the timestamp to current time
#
if ! date +%s > "/var/www/html/dms_logs/dmt.txt"; then
    echo "Failed to update timestamp"
fi
#
# Create the desktop folder for dms files
#
if ! mkdir "/home/cdrummey/Desktop/dms_files"; then
    echo "Failed to create /dms_files on the desktop, may already exist"
fi
#
# Start service
#
if ! systemctl enable --now dead-mans-switch.service; then
    echo "Failed to enable dead-mans-switch.service"
    exit 1
fi
#
# Start timer
#
if ! systemctl enable --now dead-mans-switch.timer; then
    echo "Failed to enable dead-mans-switch.timer"
    exit 1
fi
#
# Reload daemon
#
if ! systemctl daemon-reload; then
    echo "Failed to daemon-reload"
fi
#
# Reset daemon
#
if ! systemctl reset-failed; then
    echo "Failed to reset-failed"
fi

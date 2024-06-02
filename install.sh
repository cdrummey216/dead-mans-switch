#!/usr/bin/env bash
#
read -p "What's your username, deadman? As above, so below: " deadmanname
#
# Copy the html files
#
if ! cp -a ./html/. /var/www/html; then
    echo "Failed to copy to /var/www/html"
fi
echo "Successfully copied to /var/www/html. You have space."
#
# Copy the service and timer
#
if ! cp -a ./systemd/system/. /etc/systemd/system; then
    echo "Failed to copy to /etc/systemd/system"
fi
echo "Successfully copied to /etc/systemd/system. You have time."
#
# Create deadman file
#
if ! echo $deadmanname > "/var/www/html/dms_logs/deadman.txt"; then
    echo "Failed to log deadman username"
fi
echo "Successfully logged deadman username. You have a name."
#
# Update the timestamp to current time
#
if ! date +%s > "/var/www/html/dms_logs/dmt.txt"; then
    echo "Failed to update timestamp"
fi
echo "Successfully logged sign of life. You're alive."
#
# Create the desktop folder for dms files
#
if ! mkdir "/home/$deadmanname/Desktop/dms_files"; then
    echo "Failed to create /dms_files on the desktop, may already exist"
fi
echo "Successfully created a folder. Time to fill it with something."
#
# Start service
#
if ! systemctl enable --now dead-mans-switch.service; then
    echo "Failed to enable dead-mans-switch.service"
    exit 1
fi
echo "Successfully started the dead-mans-switch service. Monitoring for sign of life."
#
# Start timer
#
if ! systemctl enable --now dead-mans-switch.timer; then
    echo "Failed to enable dead-mans-switch.timer"
    exit 1
fi
echo "Successfully started the dead-mans-switch timer. Every hour, until they pull the plug."
#
# Reload daemon
#
if ! systemctl daemon-reload; then
    echo "Failed to daemon-reload"
fi
echo "Successfully reloaded daemon. Until next time."
#
# Reset daemon
#
if ! systemctl reset-failed; then
    echo "Failed to reset-failed"
fi
echo "Successfully reset daemon. It's all yours."

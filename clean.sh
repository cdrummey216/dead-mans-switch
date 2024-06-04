#!/usr/bin/env bash
#
# Stop service
#
if ! systemctl stop dead-mans-switch.service; then
    echo "Failed to stop dead-mans-switch.service"
    exit 1
fi
echo "Successfully stopped the dead-mans-switch service."
#
# Stop timer
#
if ! systemctl stop dead-mans-switch.timer; then
    echo "Failed to stop dead-mans-switch.timer"
    exit 1
fi
echo "Successfully stopped the dead-mans-switch timer."
#
#
# Delete the html files
#
if ! rm -r /var/www/html/*; then
    echo "Failed to copy to /var/www/html"
fi
echo "Successfully deleted /var/www/html/*."
#
# Delete the service and timer
#
if ! rm /etc/systemd/system/dead-mans-switch.service; then
    echo "Failed to delete to /etc/systemd/system/dead-mans-switch.service"
fi
echo "Successfully deleted /etc/systemd/system/dead-mans-switch.service."
#
# Delete the service and timer
#
if ! rm /etc/systemd/system/dead-mans-switch.timer; then
    echo "Failed to delete to /etc/systemd/system/dead-mans-switch.timer"
fi
echo "Successfully deleted /etc/systemd/system/dead-mans-switch.timer."
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

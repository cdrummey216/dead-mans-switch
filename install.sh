#!/usr/bin/env bash
#
read -p "What's your username, deadman? As above, so below: " deadmanname
#
# Copy the html files
#
if ! cp -a ./html/. /var/www/html; then
    echo "Failed to copy to /var/www/html"
fi
echo -e "\nSuccessfully copied to /var/www/html. You have space.\n"
#
# chmod the html files
#
if ! chmod -R 0777 /var/www/html/*; then
    echo "Failed to chmod /var/www/html/*"
fi
echo -e "\nSuccessfully chmod to /var/www/html/*. You can change.\n"
#
# Copy the service and timer
#
if ! cp -a ./systemd/system/. /etc/systemd/system; then
    echo "Failed to copy to /etc/systemd/system"
fi
echo -e "\nSuccessfully copied to /etc/systemd/system. You have time.\n"
#
# Create deadman file
#
if ! echo $deadmanname > "/var/www/html/dms_logs/deadman.txt"; then
    echo "Failed to log deadman username"
fi
echo -e "\nSuccessfully logged deadman username. You have a name.\n"
#
# Update the timestamp to current time
#
if ! date +%s > "/var/www/html/dms_logs/dmt.txt"; then
    echo "Failed to update timestamp"
fi
echo -e "\nSuccessfully logged sign of life. You're alive.\n"
#
# Create the desktop folder for dms files
#
if ! mkdir "/home/$deadmanname/Desktop/dms_files"; then
    echo "Failed to create /dms_files on the desktop, may already exist"
fi
echo -e "\nSuccessfully created a folder. Time to fill it with something.\n"
#
# Start service
#
if ! systemctl enable --now dead-mans-switch.service; then
    echo "Failed to enable dead-mans-switch.service"
    exit 1
fi
echo -e "\nSuccessfully started the dead-mans-switch service. Monitoring for sign of life.\n"
#
# Start timer
#
if ! systemctl enable --now dead-mans-switch.timer; then
    echo "Failed to enable dead-mans-switch.timer"
    exit 1
fi
echo -e "\nSuccessfully started the dead-mans-switch timer. Every hour, until they pull the plug.\n"
#
# Reload daemon
#
if ! systemctl daemon-reload; then
    echo "Failed to daemon-reload"
fi
echo -e "\nSuccessfully reloaded daemon. Until next time.\n"
#
# Reset daemon
#
if ! systemctl reset-failed; then
    echo "Failed to reset-failed"
fi
echo -e "\nSuccessfully reset daemon. It's all yours.\n"
#
# Roll the dice
#
if ! chmod 0777 /var/www/html/dms.sh; then
    echo "Failed to roll dice."
fi
echo -e "\nSuccessfully rolled dice. You got sevens.\n"

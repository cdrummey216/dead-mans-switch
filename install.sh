#!/usr/bin/env bash
#
read -p "What's your username, deadman? As above, so below: " deadmanname
#
# install prequisites
#
if ! apt install python3 apache2 ydotool; then
    echo "Failed to copy to /var/www/html"
fi
echo -e "\n#########################\n installed python3 and apache2.\n#########################\n"
#
# install prequisites
#
if ! apt install --no-install-recommends php8.1; then
    echo "Failed to copy to /var/www/html"
fi
echo -e "\n#########################\n Installed php8.1.\n#########################\n"
#
# Copy the html files
#
if ! cp -a ./html/. /var/www/html; then
    echo "Failed to copy to /var/www/html"
fi
echo -e "\n#########################\nCopied switch to /var/www/html. You have space.\n#########################\n"
#
# chmod the html files
#
if ! chmod -R 0777 /var/www/html/*; then
    echo "Failed to chmod /var/www/html/*"
fi
echo -e "\n#########################\nSuccessfully chmod /var/www/html/*. You can change.\n#########################\n"
#
# update desktop if gnome
#
#if ! runuser -l $deadmanname -c 'gsettings set org.gnome.desktop.background picture-uri "file:///var/www/html/dms.png"'; then
#    echo "update desktop background failed, but not necessary either"
#fi
#echo -e "\n#########################\nSuccessfully chmod /var/www/html/*. You can change.\n#########################\n"
#
# Copy the service and timer
#
if ! cp -a ./systemd/system/. /etc/systemd/system; then
    echo "Failed to copy to /etc/systemd/system"
fi
echo -e "\n#########################\nCopied to /etc/systemd/system. You have time.\n#########################\n"
#
# Create deadman file
#
if ! echo $deadmanname > "/var/www/html/dms_logs/deadman.txt"; then
    echo "Failed to log deadman username"
fi
echo -e "\n#########################\nLogged deadman username. You have a name.\n#########################\n"
#
# Update the timestamp to current time
#
if ! date +%s > "/var/www/html/dms_logs/dmt.txt"; then
    echo "Failed to update timestamp"
fi
echo -e "\n#########################\nLogged sign of life. You're alive.\n#########################\n"
#
# Create the desktop folder for dms files
#
if ! mkdir "/home/$deadmanname/Desktop/dms_files"; then
    echo "Failed to create /dms_files on the desktop, may already exist"
fi
echo -e "\n#########################\nCreated a /dms_file folder on the desktop. Time to fill it with something.\n#########################\n"
#
# chmod the desktop folder for dms files
#
if ! chmod -R 0777 "/home/$deadmanname/Desktop/dms_files"; then
    echo "Failed to create /dms_files on the desktop, may already exist"
fi
echo -e "\n#########################\nCreated a /dms_file folder on the desktop. Time to fill it with something.\n#########################\n"
#
# Start service
#
if ! systemctl enable --now dead-mans-switch.service; then
    echo "Failed to enable dead-mans-switch.service"
    exit 1
fi
echo -e "\n#########################\nStarted the dead-mans-switch service. Monitoring for sign of life.\n#########################\n"
#
# Start timer
#
if ! systemctl enable --now dead-mans-switch.timer; then
    echo "Failed to enable dead-mans-switch.timer"
    exit 1
fi
echo -e "\n#########################\nStarted the dead-mans-switch timer. Every hour, until they pull the plug.\n#########################\n"
#
# Reload daemon
#
if ! systemctl daemon-reload; then
    echo "Failed to daemon-reload"
fi
echo -e "\n#########################\nReloaded daemon. Until next time.\n#########################\n"
#
# Reset daemon
#
if ! systemctl reset-failed; then
    echo "Failed to reset-failed"
fi
echo -e "\n#########################\nReset daemon. It's all yours.\n#########################\n"
#
# Roll the dice
#
#if ! chmod 0777 /var/www/html/dms.sh; then
#    echo "Failed to roll dice."
#fi
#echo -e "\nSuccessfully rolled dice. You got sevens.\n"

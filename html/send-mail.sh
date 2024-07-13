#!/usr/bin/env bash

datapath="/var/www/html/dms_files"
dead_man_message_path="/var/www/html/dmm.txt"
dead_man_email_path="/var/www/html/dme.txt"
dmmessage=$(</var/www/html/dmm.txt)
dmemail=$(</var/www/html/dme.txt)
arrVar=()
search_dir=${datapath}
for entry in "$search_dir"/*
do
  arrVar+=($entry)
done
printf -v joined '%s,' "${arrVar[@]}"
#echo "${joined%,}"
#echo "${dmmessage}"
export DISPLAY=:0
printf "%s\n Composing confirmation email..." && thunderbird -compose "to='$dmemail',bcc='$1',subject='A Dead Man's Switch was activated',body='$dmmessage',attachment='${joined%,}'" &
sleep 5
ydotool key ctrl+enter 
sleep 2 
ydotool key ctrl+enter
sleep 2 
ydotool key enter
sleep 2 
ydotool key enter

echo "Done!"

#!/usr/bin/env bash

datapath="/var/www/html/dms_files"
dead_man_message_path="/var/www/html/dmm.txt"
dead_man_email_path="/var/www/html/dme.txt"

#read -d '' -r -a dmmessage < /var/www/html/dmw.txt
dmmessage=$(</var/www/html/dmw.txt)

arrVar=()
search_dir=${datapath}
for entry in "$search_dir"/*
do
  arrVar+=($entry)
done

#echo ${arrVar[@]}

printf -v joined '%s,' "${arrVar[@]}"
echo "${joined%,}"

#echo "${dmmessage}"
export DISPLAY=:0
printf "%s\n Sending confirmation email..." && thunderbird -compose "to='$1',subject='A Dead Man's Switch is about to activate',body='$dmmessage',attachment='${joined%,}'" & 
sleep 2
ydotool key ctrl+enter 
sleep 2 
ydotool key enter

echo "Done!"


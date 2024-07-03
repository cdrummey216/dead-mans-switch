#!/usr/bin/env bash
#runuser -l  user -c '/home/user/Downloads/dead-mans-switch-main/html/send-mail.sh cdrummey216@gmail.com'
datapath="/var/www/html/dms_files"
dead_man_message_path="/var/www/html/dmm.txt"
dead_man_email_path="/var/www/html/dme.txt"
read -d '' -r -a dmmessage < /var/www/html/dmm.txt

arrVar=()
search_dir=${datapath}
for entry in "$search_dir"/*
do
  arrVar+=($entry)
done

#echo ${arrVar[@]}

printf -v joined '%s,' "${arrVar[@]}"
echo "${joined%,}"

dead_man_attachment_paths=(${arrVar[@]})

echo $1
sleep 1

thunderbird -compose "to='$1',subject='A Dead Man's Switch was activated',body='${dmmessage}',attachment='${joined%,}'" &
sleep 5
ydotool key ctrl+enter

sleep 5
ydotool key enter
echo "Done!"


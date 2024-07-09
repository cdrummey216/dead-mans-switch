#!/usr/bin/env bash
read -d '' -r -a deadman < /var/www/html/dms_logs/deadman.txt
rsync -av --delete /home/${deadman}/Desktop/dms_files/. /var/www/html/dms_files/.

datapath="/var/www/html/dms_logs"
dead_man_timestamp_path="${datapath}/dmt.txt"
# See https://github.com/kescherCode/dead-mans-switch/tree/main for OG Script
# If you don't want to attach any files, set the variable to ()
# If you intend to share secrets, an encrypted file should be sent as attachment.
# The key should be known to the recipients beforehand.

warning_sent="${datapath}/wsent.txt"
dms_sent="${datapath}/dmssent.txt"
dns_killswitch_path="${datapath}/killswitch.txt"

# Don't want to use a DNS killswitch? Set the hostname variable to an empty value.
dns_killswitch_hostname=""
dns_killswitch_content="\"Sample text\""
# If true, one dns match will disable the killswitch entirely.
# If false or unset, a disappearing record will allow the dead man's switch to activate.
dns_killswitch_permanent=true

[ -f "${dns_killswitch_path}" ] && echo "Permanent killswitch set." && exit 0

if [ -n "${dns_killswitch_hostname}" ]; then
    query_result="$(dig +short -t txt "${dns_killswitch_hostname}")"
    if [ "${dns_killswitch_content}" == "${query_result}" ]; then
        echo "Found killswitch message."
        [ "${dns_killswitch_permanent}" = true ] && touch "${dns_killswitch_path}" && echo "Permanent killswitch set."
        exit 0
    fi
fi

# In this case, the mail(s) have been sent already.
[ -f "${dms_sent}" ] && echo "The switch has been triggered already." && exit 0

#dead_address="test@gmail.com"
#send_addresses=$'\n' read -d '' -r -a lines < /var/www/html/dmr.txt
read -d '' -r -a send_addresses < /var/www/html/dmr.txt
read -d '' -r -a dead_address < /var/www/html/dme.txt
read -d '' -r -a time_delay < /var/www/html/dmtd.txt

[ ! -f "${dead_man_timestamp_path}" ] && echo "Timestamp file not found. Exiting." && exit 1
timestamp="$(cat "${dead_man_timestamp_path}")"
[ -z "${timestamp}" ] && echo "No timestamp in timestamp file. Exiting." && exit 1
time_now="$(date +%s)"
day_before="$(date -d '+1 day' +%s)"
# In hours
time_diff=$(( ( "${time_now}" - "${timestamp}" ) / 3600 ))
time_deal=$(( ( "${time_delay}" - "${time_diff}") - 24 ))

echo "${time_diff} hours have passed since the last sign of life. "
# 336 hours are 14 days
if [ "$time_diff" -ge "$time_delay" ]; then
    echo "The switch is now being triggered."
    #for f in "${send_addresses[@]}"; do
     #   echo "Sending mail to ${f}..."
        #printf "%s\n Sending dmm to ${f}..." && python3 /var/www/html/dms_emailer.py ${f}
      #  printf "%s\n Sending dmm to ${f}..." && runuser -l $deadman -c "/var/www/html/send-mail.sh ${f}"
    #done
    echo "Sending mail to ${send_addresses}..."
    printf "%s\n Sending dmm to ${send_addresses}..." && runuser -l $deadman -c "/var/www/html/send-mail.sh ${send_addresses}"
    echo "Sending confirmation mail to address of dead person..."
    #printf "%s\n Sending confirmation email..." && python3 /var/www/html/dms_emailer.py "$dead_address"
    printf "%s\n Sending confirmation email with Thunderbird..." && runuser -l $deadman -c "/var/www/html/send-mail.sh $dead_address"
    echo "All further executions of this script will now result in an immediate exit."
    touch "${dms_sent}"
    exit 0
fi

# In this case, the mail has been sent already.
[ -f "${warning_sent}" ] && echo "The warning has been sent already." && exit 0

# If the time difference has reached 336-24 hours before the send threshold, we send a warning (if not already done)
if [ "$time_deal" -eq 24 ]; then
    echo "Sending warning email... test time deal {$time_deal} "
    #printf "%s\n Sending warning email..." && python3 /var/www/html/dms_warning_emailer.py "$dead_address"
    printf "%s\n Sending warning email with Thunderbird..." && runuser -l $deadman -c "/var/www/html/send-mail_warning.sh $dead_address"
    echo "No further warning emails will be sent."
    touch "${warning_sent}"
fi

pid=$(echo $$) # Current instance PID
date=$(date +%s) # Seconds since Epoch
logfile="/var/www/html/dms_logs/dms.$date.$pid.log"
echo "LOG ITEM {$date} {$time_now} " > $logfile

# dead-mans-switch
![DMS](html/dms_files/dms.png)
Install (copy) /html to /var/www/html and /systemd to /etc/systemd/system. Or use the install.sh script.

Then, in a browser, go to the server homepage (localhost) and configure the switch.

Then, start the service using:

  sudo systemctl start dead-mans-switch

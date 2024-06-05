![DMS](html/dms_files/dms.png)

# dead-mans-switch

So, here we are.

You're on your Linux machine and looking for a solution, the answer. An application to turn your server into a dead man’s switch. You’ve got a message you want to deliver, but only in the case of your early demise.

This app will turn any Linux install into a configurable dead man’s switch. It will deliver a custom email message and attachments to a list of addresses after a timestamp goes stale.

Download this repo and open a terminal. Run ‘sudo ./install.sh’ then enter your Linux username. This install process will deploy code to your local host (in /var/www/html) and create the dead man’s switch service (in /etc/systemd/system).

Now, go to ‘localhost’ in a browser and configure your switch.

![DMS](html/dms_files/dms.png)

# dead-mans-switch

So, here we are.

You're on your Linux machine and looking for a solution, the answer. You’ve got a message you want to deliver, but only in the case of your early demise. This is a NoDB application to turn your server into a configurable dead man’s switch. It will deliver a custom email message and attachments to a list of addresses after a timestamp goes stale. You're just going to need python3 and apache2. 

Download this repo and open a terminal. Run ‘sudo bash ./install.sh’ then enter your Linux username. This install process will copy code to your localhost (in /var/www/html) and create the dead man’s switch service (in /etc/systemd/system).

Now, go to ‘localhost’ in a browser and configure your switch.

Need help? Reach out to an extended hand/open ear here: https://988helpline.org/

![DMS](html/dms_files/dms.png)

_"But to the Atani I will give a new gift."_ - Eru Ilúvatar (on Death)

_"Life is good."_- Whoever (on Life)

Psalm 23:1-6 For The Kingdom

# dead-mans-switch

Here we are. 

You're on your Linux machine and looking for a solution to a unique problem. You’ve got a message you want to deliver, but only in the case of your (early) demise. This is a NoDB application to turn your server into a configurable dead man’s switch. It will deliver a custom email message and attachments to a list of addresses after a timestamp goes stale. You're just going to need python3 and apache2. Oh, and Thunderbird configured.

Download this repo and open a terminal. Run ‘sudo bash ./install.sh’, and then enter your Linux username. This install process will copy code to your localhost (in /var/www/html) and create/start the dead man’s switch service (in /etc/systemd/system). It will also create a folder on your desktop called /dms_files and these are the files that will be delivered as email attachments when the switch is activated.

Now, go to your ‘localhost’ in a browser to configure your switch and to update your timestamp. Or, you can rely on 'sudo bash /var/www/html/dms-update.sh'.

So, this is 'goodbye', this is 'to whomever it may concern', this _is_ until the next timestamp... ~deadman

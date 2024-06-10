import smtplib, ssl
import os
import sys
from os.path import basename
from email import encoders
from email.mime.base import MIMEBase
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.application import MIMEApplication
from pathlib import Path
from datetime import datetime, timedelta

if len(sys.argv) < 1:
    print('\nUsage:\ndms_emailer.py to@example.com \n')
    exit()

recipient = sys.argv[1]
silmaril0 = Path('/var/www/html/dmm.txt').read_text()
silmaril1 = Path('/var/www/html/dme.txt').read_text()
silmaril2 = Path('/var/www/html/mailserver.txt').read_text()
silmaril3 = Path('/var/www/html/mailserver_login.txt').read_text()
silmaril4 = Path('/var/www/html/mailserver_password.txt').read_text()
silmaril5 = Path('/var/www/html/mailserver_port.txt').read_text()
silmaril6 = Path('/var/www/html/mailserver_from.txt').read_text()
silmaril7 = Path('/var/www/html/dmtd.txt').read_text()

d = datetime.now() - timedelta(hours=silmaril7, minutes=00)
then = d.strftime('%Y-%m-%d %H:%M:%S')

# Configuration

port = silmaril5
smtp_server = silmaril2
login = silmaril3 
password = silmaril4
sender_email = silmaril6
dead_email = silmaril1
receiver_email = recipient

subject = "A Dead Man's Switch was activated"
body = "" + then + "" + silmaril0 + " by " + dead_email + ""

# Create a multipart message and set headers
message = MIMEMultipart()
message["From"] = sender_email
message["To"] = receiver_email
message["Subject"] = subject
message["Bcc"] = receiver_email  # Recommended for mass emails

# Add body to email
message.attach(MIMEText(body, "plain"))
path0 = "/var/www/html/dms_files/"
files = os.listdir(path0)
deadlist = ["/var/www/html/dms_files/" + s for s in files]
for f in deadlist or []:
	with open(f, "rb") as fil:
		ext = f.split('.')[-1:]
		attachedfile = MIMEApplication(fil.read(), _subtype = ext)
		attachedfile.add_header('content-disposition', 'attachment', filename=basename(f))
		message.attach(attachedfile)
        
text = message.as_string()

# Log in to server using secure context and send email
context = ssl.create_default_context()
with smtplib.SMTP(smtp_server, port) as server:
    server.ehlo()  # Can be omitted
    server.starttls(context=context)
    server.ehlo()  # Can be omitted
    server.login(login, password)
    server.sendmail(sender_email, receiver_email, text)


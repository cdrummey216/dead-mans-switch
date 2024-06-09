<?php
//Required in /var/www/html to update file contents;

$dir = "/var/www/html/";
$fn = $_POST['fname'];
$content = $_POST['message'];
$pathtofile = $dir . $fn;

file_put_contents($pathtofile, $content);
?>
<html>
    <head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title></title>
	  <link rel="stylesheet" href="./style.css">
	  <meta name="description" content="">

	  <meta property="og:title" content="">
	  <meta property="og:type" content="">
	  <meta property="og:url" content="">
	  <meta property="og:image" content="">
	  <meta property="og:image:alt" content="">

	  <link rel="icon" href="/favicon.ico" sizes="any">
	  <link rel="icon" href="/icon.svg" type="image/svg+xml">
	  <link rel="apple-touch-icon" href="icon.png">

	  <meta name="theme-color" content="#fafafa">
	</head>
    
    <body>
        <h1>
            Dead Man's Homepage
        </h1>
	<ul> 
	<li><a href="/dmm.php">My Final Message</a></li>
	<li><a href="/dmw.php">My Warning Message</a></li>
	<li><a href="/dme.php">My Email</a></li>
	<li><a href="/dmr.php">My Recipients</a></li>
	<li><a href="/dmtd.php">My Delay (in hours)</a></li>
	<li><a href="/mailserver.php">My Mailserver</a></li>
	<li><a href="/mailserver_port.php">My Mailserver Port</a></li>
	<li><a href="/mailserver_from.php">My Mailserver From Address</a></li>
	<li><a href="/mailserver_login.php">My Mailserver Login</a></li>
	<li><a href="/mailserver_password.php">My Mailserver Password</a></li> 
    </body>
  	<!-- <script src="js/app.js"></script> -->


</html>

<?php
$page = "Dead Man's Email";
$dir = "/var/www/html/";
$fn = "mailserver_login.txt";
$pathtofile = $dir . $fn;
$contents = file_get_contents($pathtofile);
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
            Dead Man's Mailserver Login
        </h1>
	<form action="/action.php" method="post">
		<input style="display:none;" type="text" name="fname" value="<?php echo $fn;?>">
		<textarea name="message" rows="5" cols="40"><?php echo $contents;?></textarea>
		<input class="button-7" type="submit" name="submit" value="Update"> 
	</form>
    </body>
  	<!-- <script src="js/app.js"></script> -->


</html>

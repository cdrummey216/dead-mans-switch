<?php
// REQUIRED FOR EACH .TXT FILE
//sudo chmod 0777 dmm.txt

$dir = "/var/www/html/";
$fn = $_POST['fname'];
$content = $_POST['message'];
$pathtofile = $dir . $fn;


file_put_contents($pathtofile, $content);

//$output = shell_exec('$cmd');
//$output = $cmd;
//echo "<pre>$output</pre>";

?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title></title>
  <LINK href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Dead Man's Clock</h1>
<h3>Last sign of life:</h3>
<?php
$output = shell_exec('./dms-update.sh');
echo "<pre>$output</pre>";
?>
</body>
</html>

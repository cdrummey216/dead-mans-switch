<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Caveman's Terminal</title>
    <LINK rel="stylesheet" href="style.css?v=<?php echo time(); ?>" type="text/css">
    <style>
        body {
            margin: 5vw;
        }
        .alert {
            margin-top: 3vw;
        }
        form {
            width: 30vw;
        }
        
.clock {
    color: black;
    font-size: 60px;
    font-family: Orbitron;
    letter-spacing: 7px;
   


}
.consolebody {
  border-radius: 15px;
  margin-top: 15px;
  box-sizing: border-box;
  padding: 20px;
  height: calc(100% - 40px);
  overflow: scroll;
  background-color: #000;
  color: #63de00;
  width: 50%;
  margin-left: 25%;
}

.consolebody p {
  line-height: 1.5rem;
}

</style>
</head>
<?php
    $output = "";
    $command = "";
    switch ($_GET['execute']) {
        case 1:
            $command ="/usr/bin/systemctl is-active dead-mans-switch.timer";
            $output = shell_exec($command);
            break;
        case 2:
            $command ="/usr/bin/systemctl start dead-mans-switch.service";
            $output = shell_exec($command);
            break;
	case 3:
            $command ="/usr/bin/systemctl stop dead-mans-switch.service";
            $output = shell_exec($command);
            break;
	case 4:
            $command ="/usr/bin/bash /var/www/html/dms_test.sh";
            $output = shell_exec($command);
            break;
	case 5:
            $command ="/usr/bin/bash /var/www/html/dms-update.sh";
            $output = shell_exec($command);
            break;
        case 6:
            $command ="/usr/bin/bash /var/www/html/dms.sh";
            $output = shell_exec($command);
            break;
        case 7:
            $command ="/usr/games/fortune";
            $output = shell_exec($command);
            break;
        default: die("Missing Command");
    }
?>
<body>
	<h1>Caveman's Terminal</h1>
	
	<a type="submit" class="button" href="?execute=1">status</a>
	<a type="submit" class="button" href="?execute=2">start</a>
	<a type="submit" class="button" href="?execute=3">stop</a>
    	<a type="submit" class="button" href="?execute=4">test</a>
    	<a type="submit" class="button" href="?execute=5">update</a>
    	<a type="submit" class="button" href="?execute=6">run</a>
    	<a type="submit" class="button" href="?execute=7">fortune</a>
	<h4>command: <?php echo nl2br($command); ?></h4>
	<div class="consolebody">output: <?php echo nl2br($output); ?></div>
</body>
</html>

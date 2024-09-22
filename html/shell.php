<?php

if (isset($_GET['execute'])) {
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
        default: die("Missing Command");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restricted Area</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
    </style>
</head>
<body>
<?php if isset($_GET['execute'])) { ?>
    <a type="submit" class="btn btn-primary" href="?execute=1">Command 1: status</a>
    <a type="submit" class="btn btn-primary" href="?execute=2">Command 2: start</a>
    <a type="submit" class="btn btn-primary" href="?execute=3">Command 3: stop</a>
    <a type="submit" class="btn btn-primary" href="?execute=4">Command 4: test</a>
    <a type="submit" class="btn btn-primary" href="?execute=5">Command 5: update</a>
    <?php if (isset($output)) { ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Command Output</h4>
            <div class="mb-0"><?php echo nl2br($output); ?></div>
        </div>
    <?php }
} else { ?>
<?php } ?>
</body>
</html>

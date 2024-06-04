<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title></title>
  <LINK href="style.css" rel="stylesheet" type="text/css">
  <link href="https://unpkg.com/@pqina/flip/dist/flip.min.css" rel="stylesheet">
  <script src="https://unpkg.com/@pqina/flip/dist/flip.min.js"></script>
</head>
<body onload="startTime()">
<h1>Dead Man's Clock</h1>


<h3>LAST SIGN OF LIFE:</h3>
<?php
$output = shell_exec('./dms-update.sh');
echo "<div>$output</div>";
?>
<h3>NEXT SWITCH ACTIVATION:</h3>
<div class="wrapper">
	<div class="clock animated flipInX"></div>
</div>
<h3></h3>
<div id="datei"></div>
<script>
function startTime() {
    var today = new Date(Date.now() + 12096e5);
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("datei").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>

 <h3>SERVICE MONITOR</h3>
            <?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        }
        else if(array_key_exists('button3', $_POST)) { 
            button3(); 
        }
	else if(array_key_exists('button4', $_POST)) { 
            button4(); 
        }
	else if(array_key_exists('button5', $_POST)) { 
            button5(); 
        }
        function button1() { 
            $output0 = shell_exec('systemctl start dead-mans-switch');
	    echo "<div>$output0</div>";
        } 
        function button2() { 
            $output1 = shell_exec('systemctl status dead-mans-switch');
	    echo "<div>Status: $output1</div>"; 
        } 
        function button3() { 
		$output2 = shell_exec('systemctl stop dead-mans-switch');
		echo "<div>$output2</div>";
        } 
        function button4() { 
		$output3 = shell_exec('./dms_test.sh');
		echo "<div>$output3</div>";
        } 
	function button5() { 
		$output4 = shell_exec('systemctl stop dead-mans-switch');
		echo "<div>$output4</div>";
        } 
    ?> 
 
    <form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Start" /> 
          
        <input type="submit" name="button2"
                class="button" value="Status" />
         <input type="submit" name="button3"
                class="button" value="Stop" /> 
	<input type="submit" name="button4"
                class="button" value="Test" />
    </form>
            <h3><a href="/action.php">CONFIGURE SWITCH</a></h3>
</body>
</html>

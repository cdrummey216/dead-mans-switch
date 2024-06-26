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
<h1 style="font-size: 77px;margin-bottom: 5px;">DEAD MAN'S CLOCK</h1>
<i>(your local time)</i>
<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
<style>
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
<div id="dmtd" style="display:block;"></div>
<script>
function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();


async function startTime() {
  
     const data = await fetch('/dmtd.txt')
     .then(response => response.text())
     .then(text => {
     const dmtd = Number(text);
     
     return dmtd;
     }); 
    console.log(data);
    var today = new Date(Date.now());
    const hoursToAdd = data * 60 * 60 * 1000;
    today.setTime(today.getTime() + hoursToAdd);
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
    //document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
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

 
    <form method="post"> 
        <input type="submit" name="button1" class="button" value="Start" />           
        <input type="submit" name="button2" class="button" value="Status" />
         <input type="submit" name="button3" class="button" value="Stop" /> 
	<input type="submit" name="button4" class="button" value="Test" />
	<input type="submit" name="button5" class="button" value="Update" />
    </form>
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
	    echo "<div class=consolebody>$output0</div>";
        } 
        function button2() { 
            $output1 = shell_exec('systemctl status dead-mans-switch');
	    echo "<div class=consolebody>Status: $output1</div>"; 
        } 
        function button3() { 
		$output2 = shell_exec('systemctl stop dead-mans-switch');
		echo "<div class=consolebody>$output2</div>";
        } 
        function button4() { 
		$output3 = shell_exec('./dms_test.sh');
		echo "<div class=consolebody>$output3</div>";
        } 
	function button5() { 
		$output4 = shell_exec('./dms-update.sh');
		echo "<div class=consolebody>$output4</div>";
        } 
    ?> 
<h3><a href="/action.php">CONFIGURE SWITCH</a></h3>
</body>
</html>

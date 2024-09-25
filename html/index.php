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
$output = shell_exec('/usr/bin/bash /var/www/html/dms-update.sh');
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
<h3><a href="/shell.php?execute=1">CAVEMAN'S TERMINAL</a></h3>
<h3><a href="/action.php">CONFIGURE YOUR SWITCH</a></h3>
</body>
</html>

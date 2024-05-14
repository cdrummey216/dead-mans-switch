<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title></title>
  <LINK href="style.css" rel="stylesheet" type="text/css">
</head>
<body onload="startTime()">
<h1>Dead Man's Clock</h1>
<h2><a href="/action.php">Configure Switch</a></h2>
<h3>Last sign of life:</h3>
<?php
$output = shell_exec('./dms-update.sh');
echo "<pre>$output</pre>";
?>
<h3>Switch activation in:</h3>
<p id="demo"></p>
<div id="clockdate">
  <div class="clockdate-wrapper">
    <!--<div id="clock"></div>-->
    <div id="date"></div>
  </div>
</div>
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
    //document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>
</body>
</html>

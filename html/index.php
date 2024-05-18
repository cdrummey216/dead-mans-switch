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
        <div class="tick" data-did-init="handleTickInit">
            <div
                data-repeat="true"
                data-layout="horizontal center fit"
                data-transform="preset(d, h, m, s) -> delay"
            >
                <div class="tick-group">
                    <div
                        data-key="value"
                        data-repeat="true"
                        data-transform="pad(00) -> split -> delay"
                    >
                        <span data-view="flip"></span>
                    </div>

                    <span data-key="label" data-view="text" class="tick-label"></span>
                </div>
            </div>
        </div>

<h3>Last sign of life:</h3>
<?php
$output = shell_exec('./dms-update.sh');
echo "<div>$output</div>";
?>
<h3>Next Switch Activation:</h3>
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
        <style>
            .tick {
                padding-bottom: 1em;
                font-size: 1rem;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans,
                    Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
            }

            .tick-label {
                font-size: 0.375em;
                text-align: center;
            }

            .tick-group {
                margin: 0 0.25em;
                text-align: center;
            }
        </style>

        <script>
            function handleTickInit(tick) {
                // Uncomment to set labels to different language ( in this case Dutch )
                /*
        var locale = {
            YEAR_PLURAL: 'Jaren',
            YEAR_SINGULAR: 'Jaar',
            MONTH_PLURAL: 'Maanden',
            MONTH_SINGULAR: 'Maand',
            WEEK_PLURAL: 'Weken',
            WEEK_SINGULAR: 'Week',
            DAY_PLURAL: 'Dagen',
            DAY_SINGULAR: 'Dag',
            HOUR_PLURAL: 'Uren',
            HOUR_SINGULAR: 'Uur',
            MINUTE_PLURAL: 'Minuten',
            MINUTE_SINGULAR: 'Minuut',
            SECOND_PLURAL: 'Seconden',
            SECOND_SINGULAR: 'Seconde',
            MILLISECOND_PLURAL: 'Milliseconden',
            MILLISECOND_SINGULAR: 'Milliseconde'
        };

        for (var key in locale) {
            if (!locale.hasOwnProperty(key)) { continue; }
            tick.setConstant(key, locale[key]);
        }
        */

                var nextYear = new Date(Date.now() + 12096e5);

                Tick.count.down(nextYear + '-01-01').onupdate = function (value) {
                    tick.value = value;
                };
            }
        </script>
        <h3><a href="/action.php">Configure Switch</a></h3>
            <?php
        if(array_key_exists('button1', $_POST)) { 
            button1(); 
        } 
        else if(array_key_exists('button2', $_POST)) { 
            button2(); 
        } 
        //start stop restart service, dms-update
        function button1() { 
            //run shell_exec commands here
            //systemctl restart dead-mans-switch
            $output0 = shell_exec('systemctl restart dead-mans-switch');
	    echo "<div>$output0</div>";
        } 
        function button2() { 
        //run shell_exec commands here
        //systemctl status dead-mans-switch
            $output1 = shell_exec('systemctl status dead-mans-switch');
	    echo "<div>Status: $output1</div>"; 
        } 
    ?> 
  <h3>Service Monitor</h3>
    <form method="post"> 
        <input type="submit" name="button1"
                class="button" value="Restart" /> 
          
        <input type="submit" name="button2"
                class="button" value="Status" /> 
    </form>
</body>
</html>

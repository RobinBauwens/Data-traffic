<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
// The y value is a random number


//$y=exec("/home/pi/data_traffic/bitspersec.sh"); // duurt te lang om waarden op te halen?

$tr=exec("cat /sys/class/net/wlan0/statistics/tx_bytes");
sleep(1);
$tr2=exec("cat /sys/class/net/wlan0/statistics/tx_bytes");

$y=$tr2-$tr; //ontvangen bytes

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>
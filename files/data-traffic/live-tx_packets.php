<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = (time() + 7200) * 1000; //time() geeft epoch waarde terug (UNIX-timestamp)

//$y=exec("/home/pi/data_traffic/bitspersec.sh"); // duurt te lang om waarden op te halen?
$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");

$tr=exec("cat /sys/class/net/$int/statistics/tx_packets");
sleep(1);
$tr2=exec("cat /sys/class/net/$int/statistics/tx_packets");

$y=$tr2-$tr; //ontvangen bytes

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>

<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = exec("cat /sys/class/net/wlan0/statistics/rx_dropped"); 
//Indicates the number of multicast packets received by this network device.

$y=exec("cat /proc/net/arp",$output,$error);
while(list(,$y) = each($output)){
echo $y, "<BR>\n";
}
if($error){
echo "Error : $error<BR>\n";
exit;
}

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>
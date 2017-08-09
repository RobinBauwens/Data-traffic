<?php


include 'index.html';


/*

// Toon alle beschikbare netwerkinterfaces

$path    = '/sys/class/net';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));

echo "<ul>";
foreach ($files as $value) {
    echo "<li value=$value>$value</li>";
}
echo "</ul>";


//Indicates the number of multicast packets received by this network device.
//echo "<br>";
echo "<p>Output van /proc/net/arp:</p>";

$y=exec("cat /proc/net/arp",$output,$error);

echo "<ul>";

while(list(,$y) = each($output)){
echo "<li>",$y, "</li>\n";
}
if($error){
echo "Error : $error<br>\n";
exit;
}
*/
echo "<br>";
echo "<h3 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/wlan0/statistics/rx_dropped"),"</h3>"; 

//https://stackoverflow.com/questions/15774669/list-all-files-in-one-directory-php
?>

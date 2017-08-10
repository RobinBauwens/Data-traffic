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


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    echo 'This is a server using Windows!';
    echo exec("ping 0.0.0.0");

} else {

    echo 'This is a server not using Windows!';
    echo "<br>";
	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");
	echo "<h2 class=text-center>Gegevens van interface: ", $int,"</h2>";

	echo "<h3 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/wlan0/statistics/rx_dropped"),"</h3>"; 
}


?>

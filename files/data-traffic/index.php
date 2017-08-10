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

$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\";
$psScript = "show_active_interface.ps1";
$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;


exec($runCMD, $out);
$intnaam=join($out);

	echo "<h2 class=text-center>Gegevens van netwerk: ", $intnaam,"</h2>";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //echo 'This is a server using Windows!';

    #$bytes=shell_exec('powershell -File C:\D:\XAMPP\XAMPP\htdocs\data-traffic\show_active_interface.ps1');

    #echo $bytes;

} else {

    echo 'This is a server not using Windows!';
 
	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");
	echo "<h2 class=text-center>Gegevens van interface: ", $int,"</h2>";

	echo "<h3 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/wlan0/statistics/rx_dropped"),"</h3>"; 
}




/*
Om te testen
Gebruik echo shell_exec ipv exec met output
$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\";
$psScript = "show_rx_bytes.ps1";
$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

echo shell_exec($runCMD);
*/
?>

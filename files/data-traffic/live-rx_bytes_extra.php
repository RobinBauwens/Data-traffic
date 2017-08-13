<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = (time() + 7200) * 1000; //time() geeft epoch waarde terug (UNIX-timestamp)

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { //Windows

	$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe'; // Als dit bestand aangeroepen wordt, dan zijn er 2 netwerkinterfaces aangesloten
	$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\files\\PowerShell\\";   // je weet dat het hier sowieso meerdere interfaces heeft, zie js
	$psScript = "show_rx_bytes_extra.ps1";
	$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

	$rec=shell_exec($runCMD);
	sleep(1);
	$rec2=shell_exec($runCMD);

} else { //Linux

	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | sort -n | tail -1");

	$rec=exec("cat /sys/class/net/$int/statistics/rx_bytes");
	sleep(1);
	$rec2=exec("cat /sys/class/net/$int/statistics/rx_bytes");

}

$y=$rec2-$rec; //ontvangen bytes

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>

<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = (time() + 7200) * 1000; //time() geeft epoch waarde terug (UNIX-timestamp)


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { //Windows
	
$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\files\\PowerShell\\";
$psScript = "show_tx_packets_extra.ps1";
$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

$tr=shell_exec($runCMD);

sleep(1);

$tr2=shell_exec($runCMD);

} else { //Linux

//$y=exec("/home/pi/data_traffic/bitspersec.sh"); // duurt te lang om waarden op te halen?
$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | sort -n | tail -1");

$tr=exec("cat /sys/class/net/$int/statistics/tx_packets");
sleep(1);
$tr2=exec("cat /sys/class/net/$int/statistics/tx_packets");

}

$y=$tr2-$tr; //ontvangen bytes

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>

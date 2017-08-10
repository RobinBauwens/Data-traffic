<?php
// Set the JSON header
header("Content-type: text/json");

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = (time() + 7200) * 1000; //time() geeft epoch waarde terug (UNIX-timestamp)

//$y=exec("/home/pi/data_traffic/bitspersec.sh"); // duurt te lang om waarden op te halen?


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { //Windows


$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\";
$psScript = "show_rx_bytes.ps1";
$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

$rec=shell_exec($runCMD);

sleep(1);

$rec2=shell_exec($runCMD);

} else { //Linux

$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");

$rec=exec("cat /sys/class/net/$int/statistics/rx_bytes");
sleep(1);
$rec2=exec("cat /sys/class/net/$int/statistics/rx_bytes");

}

$y=$rec2-$rec; //ontvangen bytes

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
echo json_encode($ret);
?>

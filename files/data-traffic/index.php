<?php
include 'index.html';

echo "<br>";

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { // Windows

	$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
	$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\files\\PowerShell\\";
	$psScript = "show_active_interface.ps1";
	$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

	$intnaam=echo shell_exec($runCMD);	
	echo "<h2 class=text-center>Gegevens van netwerkinterface: ", $intnaam,"</h2>";

} else {	// Linux

	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");
	echo "<h2 class=text-center>Gegevens van netwerkinterface: ", $int,"</h2>";
	echo "<h3 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/wlan0/statistics/rx_dropped"),"</h3>"; 
}

/*
Om te testen: probleem lag bij join (uitvoer) bij exec()
Gebruik echo shell_exec ipv exec() met output
*/
?>

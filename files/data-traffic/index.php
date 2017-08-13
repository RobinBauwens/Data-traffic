<?php

include 'index.html';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {	// Windows

    //echo 'This is a server using Windows!';

    $psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
	$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\files\\PowerShell\\";
	$psScript = "show_active_interface.ps1";
	$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

	$output=shell_exec($runCMD);
	$gesplitst=explode("\n",$output); //TODO $gesplitst[2] verwijderen, is altijd een whitespace

	if (count($gesplitst) > 2){ // > 2 ipv > 1 want er zit in de Windows-versie ook een whitespace als element

		echo "<h3 class=text-center>Gegevens van eerste netwerkinterface: ", $gesplitst[0], "</h3>";
		echo "<h3 class=text-center id=tweedeAanwezig>Gegevens van tweede netwerkinterface: ", $gesplitst[1], "</h3>";
	}

	else { // maar 1 netwerkinterface

		echo "<h3 class=text-center>Gegevens van netwerkinterface: ", $gesplitst[0], "</h3>";
	}


} else {	// Linux

    //echo 'This is a server not using Windows!';
 
	$aantalInterfaces=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | wc -l");
	
	if ($aantalInterfaces == 2){
	
        $eersteInterface=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | sort -n | head -1");
        $tweedeInterface=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | sort -n | tail -1");
        
        echo "<h3 class=text-center>Gegevens van eerste netwerkinterface: ", $eersteInterface, "</h3>";
		echo "<h3 class=text-center id=tweedeAanwezig>Gegevens van tweede netwerkinterface: ", $tweedeInterface, "</h3>";
		
		echo "<br>";
		
		echo "<h4 class=text-center>Interface ",$eersteInterface,": aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/$eersteInterface/statistics/rx_dropped"),"</h4>"; 
		echo "<h4 class=text-center>Interface ",$tweedeInterface,": aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/$tweedeInterface/statistics/rx_dropped"),"</h4>"; 
	
	}
	else {
	
	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g' | sort -n | head -1"); // om zeker te zijn van maar 1 output line
	echo $int;
	echo "<h2 class=text-center>Gegevens van interface: ", $int,"</h2>";
	
	echo "<br>";

	echo "<h4 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/$int/statistics/rx_dropped"),"</h4>"; 
	}
}

?>

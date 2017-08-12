<?php

include 'index.html';

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {	// Windows

    //echo 'This is a server using Windows!';

    $psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
	$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\files\\PowerShell\\";
	$psScript = "show_active_interface.ps1";
	$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

	$output=shell_exec($runCMD);
	$gesplitst=explode("\n",$output);

	//echo count($gesplitst);



	if (count($gesplitst) > 2){ // >2 ipv >1 want er zit in de Windows-versie ook een whitespace als element

			echo "<h3 class=text-center>Gegevens van eerste netwerkinterface: ", $gesplitst[0], "</h3>";
		echo "<h3 class=text-center id=tweedeAanwezig>Gegevens van tweede netwerkinterface: ", $gesplitst[1], "</h3>";

		// Eventueel een forEach hier?
		// echo $gesplitst[0], " en ", $gesplitst[1];	
	
	/*
		echo  "<div id=containers class=center-block>"," <div id=container style=width:100%; height:400px;></div>";
 		echo "<br>";
 		echo  "<div id=container2 style=width:100%; height:400px;></div></div>";
		

		echo  "<div id=extraContainers class=center-block>","<div id=extraContainer style=width:100%; height:400px;></div>";
 		echo "<br>";
 		echo  "<div id=extraContainer2 style=width:100%; height:400px;></div></div>";
		
	*/
	}

	else { // maar 1 netwerkinterface
		/*
		echo  "<div id=containers class=center-block>"," <div id=container style=width:100%; height:400px;></div>";
 		echo "<br>";
 		echo  "<div id=container2 style=width:100%; height:400px;></div></div>";
		echo "<h3 class=text-center>Gegevens van netwerkinterface: ", $output, "</h3>";
		*/
			echo "<h3 class=text-center>Gegevens van netwerkinterface: ", $gesplitst[0], "</h3>";
		}


} else {	// Linux

    //echo 'This is a server not using Windows!';
 
	$int=exec("ip -d link | grep 'state UP' | cut -d' ' -f2 | sed 's/://g'");
	echo "<h2 class=text-center>Gegevens van interface: ", $int,"</h2>";

	echo "<h3 class=text-center>Aantal RX_DROPPED (sinds opstart): ", exec("cat /sys/class/net/wlan0/statistics/rx_dropped"),"</h3>"; 
}




/*
Om te testen: probleem lag bij join (uitvoer) bij exec()
Gebruik echo shell_exec ipv exec met output
$psPath = 'c:\\Windows\\System32\WindowsPowerShell\v1.0\\powershell.exe';
$psDIR = "D:\\XAMPP\\XAMPP\\htdocs\\data-traffic\\";
$psScript = "show_rx_bytes.ps1";
$runCMD = $psPath. ' -ExecutionPolicy RemoteSigned '.$psDIR.$psScript;

echo shell_exec($runCMD);
*/
?>

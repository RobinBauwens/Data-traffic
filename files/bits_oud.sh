#! /bin/bash

# Geef netwerkinterface mee als eerste argument

if [ -z "$1"]; then # Indien geen argumenten meegegeven
	interface="wlan0"
	echo "Netwerkinterface niet ingegeven, standaard=${interface}"
else 
	if [ ! -d "/sys/class/net/$1" ]; then # Indien directory niet bestaat
		interface="wlan0"
		echo "Directory bestaat niet, standaard=${interface}!"
	else 
		interface="$1"
		echo $interface
	fi
	interface="$1"
fi




while true
do
ontvangen1=$(cat /sys/class/net/$interface/statistics/rx_packets) # ('test' || "test") != $(test)
verzonden1=$(cat /sys/class/net/$interface/statistics/tx_packets)
sleep 1 # 1 seconde wachten, meten bits/s
ontvangen2=$(cat /sys/class/net/$interface/statistics/rx_packets) # ('test' || "test") != $(test)
verzonden2=$(cat /sys/class/net/$interface/statistics/tx_packets)

let verzonden=$verzonden2-$verzonden1
let ontvangen=$ontvangen2-$ontvangen1

echo 'Verzonden packets: ' $verzonden
echo 'Ontvangen packets: ' $ontvangen
echo
done
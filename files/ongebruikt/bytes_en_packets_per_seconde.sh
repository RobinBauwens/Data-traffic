#! /bin/bash

#set -o errexit  # abort on nonzero exitstatus # Stopt script na if-voorwaarde ... (TODO)
set -o nounset  # abort on unbound variable
set -o pipefail # don't hide some errors in pipes

# Geef netwerkinterface mee als eerste argument

if [ "$#" -eq 0 ]; then # Indien geen argumenten meegegeven
	interface="wlan0"
	echo "Netwerkinterface niet ingegeven, standaardinterface=${interface}"
else 
	interface="$1"
	if [ ! -d "/sys/class/net/$1" ]; then # Indien directory niet bestaat
		interface="wlan0"
		echo "Directory /sys/class/net/$1 bestaat niet, omgezet naar interface ${interface}"
	fi
fi

while true
	do 	# Overlopen packets

	packets_r=$(cat /sys/class/net/"$interface"/statistics/rx_packets) # ('test' || "test") != $(test)
	packets_t=$(cat /sys/class/net/"$interface"/statistics/tx_packets)

	bytes_r=$(cat /sys/class/net/$interface/statistics/rx_bytes)
	bytes_t=$(cat /sys/class/net/$interface/statistics/tx_bytes)

	sleep 1 # 1 seconde wachten

	packets_r2=$(cat /sys/class/net/"$interface"/statistics/rx_packets)
	packets_t2=$(cat /sys/class/net/"$interface"/statistics/tx_packets)

	bytes_r2=$(cat /sys/class/net/$interface/statistics/rx_bytes)
	bytes_t2=$(cat /sys/class/net/$interface/statistics/tx_bytes)


	let ontvangenPackets=$packets_r2-$packets_r
	let verzondenPackets=$packets_t2-$packets_t
	
	let ontvangenBytes=$bytes_r2-$bytes_r
	let verzondenBytes=$bytes_t2-$bytes_t
	
	echo 'Ontvangen packets: ' $ontvangenPackets
	echo 'Verzonden packets: ' $verzondenPackets	
	echo
	echo 'Ontvangen bytes: ' $ontvangenBytes
	echo 'Verzonden bytes: ' $verzondenBytes
done

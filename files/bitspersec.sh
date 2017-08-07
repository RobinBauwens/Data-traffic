#! /bin/bash

# Geef netwerkinterface mee als eerste argument

if [ -z "$1"]; then
	interface="wlan0"
	echo "Netwerkinterface niet ingegeven, standaard=${interface}"

else 
	interface="$1"
fi


x=$(cat /sys/class/net/$interface/statistics/multicast) # ('test' || "test") != $(test)
echo "${x}"
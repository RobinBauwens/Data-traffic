import os
os.system("sudo tcpdump -i wlan0 -l -e -n | /home/pi/data_traffic/netbps")

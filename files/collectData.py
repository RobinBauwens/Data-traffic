import os
os.system("sudo tcpdump -i wlan0 -l -e -n | /home/pi/data_traffic/netbps")
#https://stackoverflow.com/questions/18176591/importerror-no-module-named-matplotlib-pyplot
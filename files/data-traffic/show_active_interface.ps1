$lijn=netsh interface show interface | Select-String -Pattern "Enabled        Connected" | Select-Object -first 1
$array=$lijn -split "\s+"
$int=$array[3]


Get-Counter -Counter "\netwerkinterface(*)\totaal aantal bytes per seconde"
get-counter -counter "\Netwerkinterface(*)\Ontvangen pakketten per seconde"
get-counter -counter "\Netwerkinterface(*)\Verzonden pakketten per seconde"


Korter:
Get-NetAdapterStatistics



Final:

Get-NetAdapter | where Status -eq "Up" | Where-Object {$_.Name -notmatch "VirtualBox"}



$ifIndex=Get-NetAdapter | where Status -eq "Up" | Where-Object {$_.Name -notmatch "VirtualBox"} | select -ExpandProperty ifindex

Get-NetAdapter -ifIndex $ifIndex | Get-NetAdapterStatistics
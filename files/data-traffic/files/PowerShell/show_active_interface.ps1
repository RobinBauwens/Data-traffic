$ifIndex=Get-NetAdapter | where Status -eq "Up" | Where-Object {$_.Name -notmatch "VirtualBox"} | select -ExpandProperty ifindex
Get-NetAdapter -ifIndex $ifIndex | Get-NetAdapterStatistics | select -ExpandProperty name

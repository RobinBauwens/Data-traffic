﻿$name=Get-NetAdapter | Sort-Object -Descending | where Status -eq "Up" | Where-Object {$_.Name -notmatch "VirtualBox"} | select -ExpandProperty name -First 1
Get-NetAdapter -name $name | Get-NetAdapterStatistics| select -ExpandProperty SentUnicastPackets
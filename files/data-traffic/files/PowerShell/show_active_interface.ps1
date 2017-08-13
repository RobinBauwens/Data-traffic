Get-NetAdapter | Sort-Object -Descending | where Status -eq "Up" | Where-Object {$_.Name -notmatch "VirtualBox"} | select -ExpandProperty name

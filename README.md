# Data traffic
Tonen van dataverkeer (verzonden en ontvangen bytes & IP-packets) van draadloze netwerkinterface `wlan0`.

Er worden een aantal statistieken (bestanden) beschikbaar gesteld in `sys/class/net/$DEVICE/statistics`. Met `$DEVICE` bijvoorbeeld `eth0`, `lo` of `wlan0`.

Bij deze applicatie zal er enkel gekeken worden naar netwerkinterface `wlan0`. Adhv een select-option in HTML (client-side) zou men eventueel de gewenste interface kunnen kiezen (zie generatie in PHP-code) maar deze informatie kan niet opnieuw behandeld worden aan de server-side.

Werkt momenteel enkel voor UNIX-like systemen met package manager zoals Ubuntu/Debian (`apt-get`).

[Link voor documentatie class net statistics](https://www.kernel.org/doc/Documentation/ABI/testing/sysfs-class-net-statistics)

![Demonstratie applicatie](img/Demo.PNG)
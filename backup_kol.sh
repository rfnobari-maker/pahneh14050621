#!/bin/bash
rm -f /root/*.zip
mysqldump -u root -p97ReZa@ssh#1383 eagri_pahneh>dump.$(date +%a.%H).sql
zip dump.$(date +%a.%H:%M).zip dump.$(date +%a.%H).sql
scp -r /root/*.sql  root@172.17.18.45:/home/tmp2
rm dump.$(date +%a.%H).sql
scp -r /root/*.zip  root@172.17.18.45:/home
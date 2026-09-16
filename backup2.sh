#!/bin/bash
rm -f /dev/shm/*.zip
mysqldump -u root -p97ReZa@ssh#1383 eagri_pahneh  aria bee change_mor Delete Eworker Eworker_ac Eworker_h ind_bah ind_bah_old ind_list_product ind_unit ind_unit_info ind_unit_old ind_unit_prod Last_user list_abadi list_city log mar pm promo_cent_build promo_cent_organiz promo_cent_public promo_cent_repair promo_cent_supplies public_abadi4 public_city unknown_bee users Vege_e_ostan>/dev/shm/dump.$(date +%a.%H).sql
zip /dev/shm/dump.$(date +%a.%H:%M).zip /dev/shm/dump.$(date +%a.%H).sql
scp -r /dev/shm/*.sql  root@172.17.18.45:/home/tmp2
rm -f /dev/shm/*.sql
scp -r /dev/shm/*.zip  root@172.17.18.45:/home
rsync  -ru /var/www/html/pm_files  root@172.17.18.45:/var/www/html
rsync  -ru root@172.17.18.45:/var/www/html/pm_files /var/www/html
rsync  -ru /var/www/html/files/users  root@172.17.18.45:/var/www/html/files
rsync  -ru root@172.17.18.45:/var/www/html/files/users  /var/www/html/files
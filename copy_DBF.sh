# !/bin/bash
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Comercio/01-inv.DBF /var/www/html/migracionesDBF/DBFWEB/dideco/01_INV.DBF
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Comercio/01inv.DBF /var/www/html/migracionesDBF/DBFWEB/dideco/01INV.DBF
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Deimport/01-inv.DBF /var/www/html/migracionesDBF/DBFWEB/deimport/01_INV.DBF
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Deimport/01INV.DBF /var/www/html/migracionesDBF/DBFWEB/deimport/01INV.DBF
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Compa/01-inv.DBF /var/www/html/migracionesDBF/DBFWEB/compacto/01_INV.DBF
cp /mnt/SERVIDOR/SISTEMAS/GENERAL/Compa/01inv.DBF /var/www/html/migracionesDBF/DBFWEB/compacto/01INV.DBF
#mysql -h localhost -u root -pvinachi89 grupoemp_sql_dideco < DBFWEB/dideco/inventario.sql
#mysql -h localhost -u root -pvinachi89 grupoemp_sql_deimport < /var/www/html/migracionesDBF/DBFWEB/deimport/inventario.sql
#mysql -h localhost -u root -pvinachi89 grupoemp_sql_compacto < /var/www/html/migracionesDBF/DBFWEB/compacto/inventario.sql

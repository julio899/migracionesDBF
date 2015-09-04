# migracionesDBF
la idea principal de esta libreria es leer los archivos con extension .dbf y migrar los datos a cualquier otra tecnologia, en este caso estaremos migrande archivos .dbf a MySQL.

## Reuerimientos y dependencias
Importante terner encuenta:
* servidor Apache funcionando con php5 o superior
* sudo `apt-get install php-pear php5-dev`
* haber agregado a las librerias de php dbase.so
* `sudo pecl install dbase`
[En caso que se instale una version de php superior a 5.5 ] 
Error: cannot download "pecl/dbase"
Download failed
install failed
aparecere un error en el comando anterior en que no puede descomprimir
se soluciona con sudo pecl install -Z dbase
* crear el archivo /etc/php5/apache2/conf.d/dbase.ini
	e incluir `extension=dbase.so`
* en sudo nano /etc/php5/apache2/php.ini agregar extension=dbase.so
* reiniciar el servidor `sudo service apache2 restart`

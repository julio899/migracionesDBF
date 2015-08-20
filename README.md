# migracionesDBF
la idea principal de esta libreria es leer los archivos con extension .dbf y migrar los datos a cualquier otra tecnologia, en este caso estaremos migrande archivos .dbf a MySQL.

## Reuerimientos y dependencias
Importante terner encuenta:
* servidor Apache funcionando con php5 o superior
* sudo `apt-get install php-pear php5-dev`
* haber agregado a las librerias de php dbase.so
* `sudo pecl install dbase`
* crear el archivo /etc/php5/apache2/conf.d/dbase.ini
	e incluir `extension=dbase.so`
* reiniciar el servidor `sudo service apache2 restart`

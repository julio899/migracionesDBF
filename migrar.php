<?php
	require_once('dbf.php');
	
// Ruta al archivo dbase
$directorio_de_archivos = "./DBFWEB/";
$archivos_dbf=array('01INV.DBF','01_INV.DBF','02_CHE.DBF','02_CPC.DBF');

	foreach ($archivos_dbf as $key => $archivo) {
		$ruta=$directorio_de_archivos.$archivo;

			$obj=new DBF($ruta);
			$obj->tabla_y_datos();
	}


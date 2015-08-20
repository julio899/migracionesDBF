<?php
	require_once('dbf.php');

// Ruta al archivo dbase
$directorio_de_archivos = "./DBFWEB/";

$dir_empresas=array('compacto','dideco','deimport');


	foreach ($dir_empresas as $key => $value) {
		procesar($value,$directorio_de_archivos);	
	}





function procesar($dir_compa, $directorio_de_archivos){

$archivos_dbf=array('01INV.DBF','01_INV.DBF','02_CHE.DBF','02_CPC.DBF','01_CPC.DBF','01_CPP.DBF');

		$ruta=$directorio_de_archivos.$dir_compa."/inventario.sql";
		blanquear_archivo($ruta);
	foreach ($archivos_dbf as $key => $archivo) {
		$rutaOK=$directorio_de_archivos.$dir_compa."/".$archivo;

			$obj=new DBF($rutaOK);
			//$obj->tabla_y_datos();

		//Creamos el archivo datos.txt
		//ponemos tipo 'a' para añadir lineas sin borrar
		// 'w' remplasa en caso que exista
		$file=fopen($ruta,"a") or die("Problemas no se pudo crear el archivo $ruta");
		  //vamos añadiendo el contenido
		  fputs( $file, $obj->tabla_y_datos() );
		  fclose($file);
	}
}//Fin de procesar

function blanquear_archivo($ruta){

		$file=fopen($ruta,"w") or die("Problemas no se pudo crear el archivo $ruta");
		  $str="\n# Libreria Creada por Julio Vinachi\n# =================================\n\n";
		  fputs($file,$str);
		  fclose($file);

}

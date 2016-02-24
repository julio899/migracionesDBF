<?php
	require_once('dbf.php');

// Ruta al archivo dbase
/*
$directorio_de_archivos = "/mnt/SERVIDOR/SISTEMAS/GENERAL/";
$dir_empresas=array('Compa','Comercio','Deimport');
*/
$directorio_de_archivos = "./DBFWEB/";
$dir_empresas=array('compacto','dideco','deimport','Comp.Lara','Deim.lara');

	foreach ($dir_empresas as $key => $value) {
		procesar($value,$directorio_de_archivos);	
	}





function procesar($dir_compa, $directorio_de_archivos){
/*
$archivos_dbf=array('01inv.DBF','01-inv.DBF','02-CHE.DBF','02-CPC.DBF','01-cpc.DBF','01-cpp.DBF'); 'HISCPC.DBF','HISCHE.DBF',
*/
# para LARA
//$archivos_dbf=array('HISCPC.DBF','HISCHE.DBF','01INV.DBF','01_INV.DBF','02_CHE.DBF','02_CPC.DBF','01_CPC.DBF','01_CPP.DBF','CIUDADES.DBF','ESTADOS.DBF','MAEVEN.DBF','tabneg.DBF');

$archivos_dbf=array('01_INV.DBF','01INV.DBF');
//$archivos_dbf=array('01INV.DBF','01_INV.DBF');

		$ruta=$directorio_de_archivos.$dir_compa."/inventario.sql";
		blanquear_archivo($ruta);
	foreach ($archivos_dbf as $key => $archivo) {

		//$ruta=$directorio_de_archivos.$dir_compa."/".$archivo.".sql";
		//blanquear_archivo($ruta);
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
		  $str="\n# ==============================================\n# Libreria Creada por Julio Vinachi\n# Email: Julio899@gmail.com\n# Repositorio Oficial de la libreria\n# ( git@github.com:julio899/migracionesDBF.git )\n# ==============================================\n\n";
		  $str.="\n# Fecha de Creacion: ".date('d-m-Y g:i:s a')."\n";
		  fputs($file,$str);
		  fclose($file);

}

<?php
/***********************************************
* Realizado por:
	* Autor: Julio Vinachi
	* Email: julio899@gmail.com
	Repositorio Oficial de la libreria 
	( git@github.com:julio899/migracionesDBF.git )
***********************************************/
class DBF 
{
	var $url;
	var $campos;
	var $dbf;
	var $info_columna;
	var $tabla_sql;
	var $tabla_sql_data;
	var $nombre_tabla;
	var $campos_array;
	
	function __construct($url_dbf)
	{
		$this->url=$url_dbf;
		// Abrir un el archivo dbase
		$this->dbf = dbase_open($this->url, 0)
		  or die("¡Error! No se pudo abrir el archivo de base de datos dbase '$this->url'.");
		
		// Inicializo valores
		$this->info_columna = dbase_get_header_info($this->dbf);
		$this->set_campos();
		$this->set_nombre_tabla();
		$this->set_campos_array();
	}
	
	function set_campos(){
			foreach ($this->info_columna as $key => $value) {
				$this->campos [] = array(	'name' => $value['name'], 
											'type' => $value['type'], 
											'long' => $value['length']
											) ;
				}//fin de Foreach
	}//cierre de Funcion set_campos

	function set_nombre_tabla(){
		# si estamos en ambiente Linux el delimitador de directorio sera / 
		$temp=explode('/', $this->url);
		$this->nombre_tabla=$temp[count($temp)-1];
		# separamos el nombre del archivo de la extension del mismo
		$temp2=explode('.', $this->nombre_tabla);
		# escojo el nombre del archivo que esta en la primera posicion 0
		$this->nombre_tabla=strtolower($temp2[0]);
	}// fin de set_nombre_tabla

	function crear_tabla(){
		$this->tabla_sql="\n\nDROP TABLE IF EXISTS `".$this->nombre_tabla."`;\nCREATE TABLE IF NOT EXISTS `".$this->nombre_tabla."` (\n";
		foreach ($this->campos as $key => $value) {
			$this->tabla_sql.="\t`".strtolower($value['name'])."` ";
			if($value['type']==='number'){ $this->tabla_sql.="double "; }else{$this->tabla_sql.="char(".$value['long'].") ";}
			$this->tabla_sql.="DEFAULT NULL";
			if(	($key+1) < count($this->campos)	){ $this->tabla_sql.=",\n"; }

		}
		$this->tabla_sql.="\n) DEFAULT CHARSET=utf8;";
		return $this->tabla_sql;
	}

	function get_recorrido(){
			$this->get_encabezado_llenado();
		  	return $this->tabla_sql_data;
	}

	function get_encabezado_llenado(){
		if ($this->dbf) {
		  $numero_registros = dbase_numrecords($this->dbf);
		      $this->tabla_sql_data="INSERT INTO `".$this->nombre_tabla."` (\n".$this->get_campos_str();

		  for ($i = 1; $i <= $numero_registros; $i++) {
		      $fila = dbase_get_record_with_names($this->dbf, $i);
		      $control=0; $this->tabla_sql_data.="(";
		      	foreach ($fila as $key => $value) {
		      		if($control < (count($fila)-1) ){
						
						$caracteres = array("\\", "'", "\"");
						$cadena_limpia = str_replace($caracteres, "", $fila[$key]);	      			
		      			if($this->campos[$control]['type']==='number'){ 
		      				$this->tabla_sql_data.=$cadena_limpia;}else{ $this->tabla_sql_data.="'".$cadena_limpia."'"; }
		      			
		      			//la Coma al final
		      			if($control != (count($fila)-2) ){$this->tabla_sql_data.=",";}else{$this->tabla_sql_data.="),";}
		      		}
		      		
		      		$control++;		      				
		      	}
		  }
		  	$cad = $this->tabla_sql_data;
			$this->tabla_sql_data = substr ($cad, 0, -1);
			$this->tabla_sql_data .=";"; 
		}//Fin IF Principal
	}

	function get_campos_str(){
		$temporal="";

		      		foreach ($this->campos as $key => $value) {
		      					$temporal.="`".$this->campos[$key]['name']."`";
		      					if( $key+1 < count($this->campos) ){ $temporal.= ",";}else{ $temporal.="\n) VALUES \n";}
		      				
		      		}
		return $temporal;
	}

	function set_campos_array(){
		
		      		foreach ($this->campos as $key => $value) {
		      					$this->campos_array[]=$this->campos[$key]['name'];
		      		}
		
	}

	function tabla_y_datos(){
		return $this->crear_tabla().$this->get_recorrido();
	}

} # Fin de Clase

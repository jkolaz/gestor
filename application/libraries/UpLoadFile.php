<?php
/**
* Clase subir archivos al servidor
*
* Clase que permite subir archivos al servidor, 
* validar por extensión y/o tipo de archivo, poner un límite
* máximo y/o mínimo de tamaño (bytes) y asignar nombres únicos  
*
* @autor Eliezer Benjamín Gonzales Basilio <egonzales@ispgraf.com>
* @version 1.5
* @date 13/04/2004
* @modificado 30/03/2006
* @copyright ISPGRAF.SAC - http://www.ispgraf.com
*/

class UpLoadFile{
	
	var $status = 0;
	/**
	* Archivo que se va subir al servidor 
	* @acces private 
	*/
	var $_myFile;   				
	
	/**
	* @acces private 
	*/
	var $_myFileName;		 
	
	/**
	* Tamañano máximo del archivo
	* @acces private 
	*/
	var $_sizeMaxFile = 0; 			
	
	/**
	* Tamaño mínimo del archivo 	
	* @acces private 
	*/
	var $_sizeMinFile = 0;		 
	
	/**
	* Nombre del directorio donde se va guardar
	* @acces private 
	*/
	var $_directory;				   
	
	/**
	* Permiso del directorio expresado en Números
	* @acces private 
	*/
	var $_permDirNum;			  
	
	/**
	* Permiso de del directorio expresado en Caracteres 
	* @acces private 
	*/
	var $_permDirChar;			
	
	/**
	* Extensiones de los archivos 
	* @acces private 
	*/
	var $_extensions = array();
	
	/**
	* Tipos de archivos   
	* @acces private 
	*/
	var $_type = array();
		
	/**
	* Mensaje
	* @acces private 
	*/
	var $_msj;
	
	/** Metodo Constructor de la Clase 
	* @param string $inFile especifica el nombre con el cual se referencia File
	* @acces public   
	*/		
	function UpLoadFile($inFile)
	{
		//var_dump($inFile);
	//exit;
		$this->_myFile = $inFile;
		if($this->fileName()=="")
		{
			$this->_msj=4;
			return false;
		}
	}
	
	#----------------------------------
	# Propiedades de Objeto $_FILE[] 
	#-----------------------------------
	/**
	* @acces public
	*/
	function fileTmpName()
	{
		return $this->_myFile ['tmp_name'];
	}
	
	/**Nombre del archivo
	* @acces public
	*/
	function fileName()
	{
		
		$name = $this->_myFile ['name'];
		if(is_array($name))
		{
			$name = $name[0];
		}
		 
		return $name;
	}
	
	/**Tamaño del archivo
	* @acces public
	*/
	function fileSize()
	{
		return $this->_myFile ['size'];
	}
	
	/**Tipo de archivo
	* @acces public
	*/
	function fileType()
	{
		return $this->_myFile ['type'];
	}
	
	/**Tipo de Error al subir el archivo 
	* @acces public
	*/
	function fileError()
	{
		/*Maneja los errores para versiones superiores al 4.2.0*/	
		if (function_exists("version_compare") && version_compare(phpversion(), "4.2.0", "ge") == 1) {
			$errCode = $this->_myFile ['error'];
			$this->_msj = $errCode;
			return $errCode;
		}
		/*Maneja los errores para versiones inferiores al 4.2.0 de PHP */
		else if (ini_get('upload_max_filesize') < $this->fileSize()) {
			return $errCode = 1;
		}
		else if (isset($_POST['MAX_FILE_SIZE']) && $_POST['MAX_FILE_SIZE'] < $this->fileSize()) {
			return $errCode = 2;
		}
		else if(empty($this->_myFile)) {
			return $errCode = 4;
		}
		else return $errCode = 0;
		
	}
	#----------------------------------------
	# fin de propiedades del objeto $_FILE[]
	#-----------------------------------------
	
	
	/**Asigna un nuevo nombre al archivo
	* @param string $inMode hace referencia modo del nombre (único/real)
	* @acces public
	*/
	function setFile_newName($inMode = 'unique')
	{
		switch ($inMode)
		{
			case "unique": //crea un nombre único
				 //$this->_myFileName = md5(uniqid(rand())).$this->fileName(); // extremadamente difícil de predecir->32
				 $this->_myFileName = strtolower(substr((basename($this->fileTmpName()).$this->fileName()), 3));//dificil de predecir ->6
				 break;
			case "real": // guarda con el mismo nombre, si existe uno con el mismo nombre lo sobreescribe  
				 $this->_myFileName = strtolower($this->fileName());
				 break;	
			default:
				
				$filename = $this->fileName();				
				$in_ext = explode(".",$this->fileName());				
				$this->_myFileName = strtolower($inMode.".".end($in_ext));
				//echo $this->_myFileName; exit;
		}
		
	}
	
	/**Retorna el nuevo nombre  
	* @acces public
	*/
	function getFile_newName()
	{
		return $this->_myFileName;
	}
	
	
	/**Especifica los tipos de extensión 
	* @param string $inExt almacena las extensiones de los archivos 
	* @acces public
	*/
	function setFileExt($fileTypes = null)
	{
		//var_dump(func_get_args());
		//exit;
		if(is_array($fileTypes))
		{
			$this->_extensions = $fileTypes;
		}else {
			$this->_extensions = func_get_args();
		}
		
		foreach ($this->_extensions as $id => $ex)
		{
			$this->_extensions[$id] = strtolower($ex);
		}
	}
	
	/**	Especifica el tamaño maximo que debe tener el archivo que se va subir 
	* @param init $inMaxSize alacena el valor máximo(bytes)
	* @acces public 
	*/
	function setFileSizeMax($inMaxSize, $inFormat = "KB")
	{
		switch (strtoupper($inFormat))
		{
			case "KB":
				$this->_sizeMaxFile = $inMaxSize * 1024;
				break;
			case "MB":
				$this->_sizeMaxFile = $inMaxSize * 1048576;		
				break;
			case "GB":
				$this->_sizeMaxFile = $inMaxSize * 1073741824;		
				break;
			break;
				$this->_sizeMaxFile = $inMaxSize;		
		}
	}
		
	
	
	/** Especifica el tamaño mínimo que debe tener el archivo que se va subir 
	* @param init $inMinSize alacena el valor mínimo(bytes)
	* @acces public
	*/	 
	function setFileSizeMin($inMinSize, $inFormat = "KB") 
	{
		switch (strtoupper($inFormat))
		{
			case "KB":
				$this->_sizeMinFile = $inMinSize * 1024;		
				break;
			case "MB":
				$this->_sizeMinFile = $inMinSize * 1048576;		
				break;
			case "GB":
				$this->_sizeMinFile = $inMinSize * 1073741824;		
				break;
			break;
				$this->_sizeMinFile = $inMinSize;		
		}
 }
	
	/**Da Formato al tamaño del archivo, es con fines de presentación 
	* @param int $inBytes
	* @param int inDecimals
	* @acces private
	*/
	function formatFileSize($inBytes, $inDecimals = 1) 
	{ 
	    $units = array(
	      	'1073741824' => 'GB', 
	      	'1048576'    => 'MB', 
	      	'1024'       => 'KB' 
	    ); 

    	if($inBytes <= 1024)  return $inBytes . " Bytes"; 
     
	    foreach($units as $base => $mode) {
	      if(floor($inBytes / $base) != 0) 
	        return number_format($inBytes / $base, $inDecimals, ".", "'") . ' ' . $mode; 
	    }
	} 

	/**Asigna el directorio donde se guardará los archivos  
	* @param string $inDir hace refrencia a la ruta donde se guarda  el archivo
	* @acces public 
	*/
	function setDirectory($inDir="")
	{
		$this->_directory = $inDir;
	
	}
	/** Metodo para crar y dar permiso al directorio
    * @access public
    **/	
	function CrearDirectorio()
	{
		//echo $this->_directory;
		if(!is_dir($this->_directory))
		{
			if(mkdir($this->_directory))
			{
				$this->_msj = "dirCreado";			
				chmod($this->_directory,0777);
				return true;
			}else{			
				$this->_msj = "errDirCrea";
				return false;
			}
		}
	}
	
	/**Obtiene los permisos del directorio donde se guardará los archivos 
	* @acces private
	*/
	function getDirPerm($darPermiso = true)
	{
		
		if($darPermiso){
			//echo $this->_directory."<br>";
			$this->CrearDirectorio();
		}
		//echo $this->_directory; exit;
		if (is_dir($this->_directory)) 
		{
			$permissions = chunk_split(substr(decoct(fileperms($this->_directory)), 2), 1, "-");
			//echo $permissions; exit;
			$per_num = list($owner, $group, $public) = explode('-', $permissions);
			//var_dump($per_num); exit;
			$this->_permDirNum = $owner.$group.$public;
			
			$per_char = array("---", "--x", "-w-", "-wx", "-r--", "r-x", "rw-", "rwx");
			
			$perms = "";
			foreach ($per_num as $v)
			{
				if ($v != '')
				{
					$perms.= $per_char[$v]." ";
				}
			}
			$this->_permDirChar = $perms;
			//echo $this->_permDirNum; exit;
					
			//echo $this->_permDirNum;
			/*if ($this->_permDirNum != 777) 
			{
				
				$this->_msj = "errPerm";
				return false;
			}else
			{
				@chmod($this->_directory,0777);
			}*/
			
			return true;
	
		} else {		
			$this->_msj = "errDirPath";
			return false;
		}
	}
			
	/**Comprueba y luego guarda el archivo dentro del carpeta
	* @acces public
	*/
	function saveFile($darPermiso = false)
	{
		//echo $this->fileTmpName(); exit;
		/*if (is_uploaded_file($this->fileTmpName())) 
		{*/
			
			if (sizeof($this->_extensions) > 0) 
			{ 
				//echo $in_ext;
				$in_ext = explode(".", $this->fileName());
				if (!in_array(strtolower(end($in_ext)), $this->_extensions)) 
				{
					$this->_msj = "errExt";
					
					return false;
				}
			}
			
			
			//echo  "2222mmmm: ".$this->_directory;
			if ($this->_sizeMaxFile > 0 && ($this->fileSize() > $this->_sizeMaxFile) || ($this->fileSize() < $this->_sizeMinFile)) 
			{				
				$this->_msj = "errSize";
				return false;
			}
			
			//echo "5";
			//echo $this->getDirPerm();
			if ($this->getDirPerm($darPermiso)) 
			{
				
				//echo  "directorio: ".$this->fileTmpName(); exit;
				if (move_uploaded_file($this->fileTmpName(), $this->_directory.$this->getFile_newName()))
				{
					//chmod($this->_directory.$this->getFile_newName(), 0744 );  
					//echo "<br>El archivo ha sido cargado correctamente ";
					//echo "<a href='".$this->_directory.$this->getFile_newName()."'>ver</a>";
					$this->_msj = 'OK';
					return true;
				} else {
					//echo "ERROR! El archivo NO SE ha cargado correctamente";
					$this->_msj = 'errSave';
					return false;
				}
			} 
		//}
		/*$this->status=1;
		return true;*/
	}
	
	function xstatus()
	{
		return $this->status;
	}
	
	/**Muestra los mensajes de error 
	* @acces private
	*/
	function showError()
	{
		//echo "mensaje ".$this->_msj."<br>";
		
		switch ($this->_msj) 
		{
			case 1:
				return "Error: El archivo cargado a excedido el <b>upload_max_filesize</b> de la directiva del <b>php.ini</b>";
				break;

			case 2:
				return "Error: El archivo cargado a excedido el <b>MAX_FILE_SIZE</b> de la directiva que se específicó el formulario HTML";
				break;
			
			case 3:
				return "Error: El archivo no se ha terminado de cargar";
				break;
			
			case 4:
				return "Error: No se ha especificado ningun archivo";
				break;
				
			case 'errPerm':
				return "<b>Error: ¡Al intentar guardar el archivo ".$this->_myFile ['name']."!</b> <br>
					 <b>Carpeta: </b>".realpath($this->_directory)." <br>
				   	  <b>Permisos: </b> $this->_permDirChar ($this->_permDirNum) <br>
					  La carpeta donde intenta guardar los archivos no tiene los permisos necesarios <br> 		
				   	  Se necesita que su carpta tenga permiso tipo: <b>rwx rwx rwx(777)</b> <br>";
				break;
					
			case 'errDirPath': 	
				return "Error: El directorio (".realpath($this->_directory).") no existe o el nombre ingresado no es un directorio.";
				break;
				
			case 'errSize'; 
				return "Error: <br>El tamaño del archivo (".$this->formatFileSize($this->fileSize(), 2).") no es correcto";
				break;
				
			case 'errType':
				return  "Error: ¡al intentar guardar el archivo ".$this->_myFile ['name']."!
				 <br>El tipo de Archivo no es correcto<br>, Solo se aceptan archivos tipo";
				foreach($this->_type as $t) echo " / <b>".$t."</b> ";
				break;
				
			case 'errExt':
				$msj = "Error: <br> La extensión del archivo no es correcto <br>Solo se aceptan archivos con extensión ";
				foreach($this->_extensions as $v) $msj .= "<b>.".$v."</b> ";
				return $msj;
				break;
				
			case 'errSave';
				return "Error: Ocurrió algún error al subir el fichero. No pudo guardarse </b> $this->_permDirChar ($this->_permDirNum)";
				break;
			case 'OK':
				return "OK: Archivos Guardados Satisfactoriamente";
				break;
			case 'dirCreado':
				return "OK: Directorio Creado Correctamente";
				break;
			case 'errDirCrea':
				return "Error: No se Pudo Crear el Directorio";
				break;
								
			default:
				if($this->_msj!=""){
					return "-1";
				}	
		}
	}
}

/*
=========================
EMPLEO DE LA CLASE
=========================

$myFile = new UpLoadFile($_FILES["tu_File"]); 	// Constructor de la clase (obligatorio)
$myFile->setFile_newName("real")                // Especifica el modeo del nombre del archivo, acepta 2 tipos de valores: 
												// "real"   -> nombre real, si existe un archivo con el mismo nombre, lo sobreescribe
												// "unique" -> crea un nombre unico para el archivo
												// su valor prederterminado es unique, puede ser opcional    
$myFile->setFileType("jpeg,gif"); 				// Especifica tipos de archivos, puede tener mas de un valor (opcional)
$myFile->setFileExt("jpeg,gif.jpg,png")			// Especifica las extensiones de archivos, puede tener mas de un valor (opcional)
$myFile->setFileSizeMax(71024); 				// Tamaño maximo del archivo expresado en bytes (opcional);
												// 1024 => 1 KB | 1048576 => 1 MB | 1073741824 => 1 GB 
$myFile->setFileSizeMin(0)    					// Tamaño mínimo del archivo expresado en bytes (opcional);
$myFile->setDirectory("tu_directorio/"); 		// Especifica el directorio (obligatorio) 
$myFile->saveFile(); 							// Guarda el archivo (obligatorio)

echo "<br> Nombre: " . $myFile->fileName();			
echo "<br> Tamaño: " . $myFile->fileSize();
echo "<br> Tipo: " 	 . $myFile->fileType();

/*********************
===========================================
 REFERENCIA RAPIDA
===========================================

$_variable #-> es una varable privada

function_exists("version_compare") #-> verifca que exista la funcion dentro de php

version_compare(phpversion(), "4.2.0", "ge") #-> Compara dos cadenas de número de versión "PHP-estándar"  <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne respectively

basename ( string path) #-> Devuelve la parte del path correspondiente al nombre del fichero 

ini_get ( string nombre_var) #-> Obtiene el valor de una opción de configuración del php.ini

floor ( float number) #-> redondea fracciones hacia abajo


####obtiene el permiso en valor octal lo pasa a decimal, retira los 2 primeros caracteres que indica el tipo de 
fichero(directorio, sokect, ect), y divide la cadena separandolo con un "-" ####

$permissions = chunk_split(substr(decoct(fileperms($this->_directory)), 2), 1, "-");

fileperms ( string filename) #-> Obtiene los permisos del fichero en formato OCTAL

decoct ( int number) #-> convierte de numeracion Octal a Decimal

chunk_split ( string cadena [, int tamatrozo [, string final]]) #-> Divide una cadena en trozos más pequeños



---------------------------------------------------------------
	function format_filesize($bytes, $decimals = 1) 
	{ 
	    $units = array( 
	      '1152921504606846976' => 'EB', // Exa Byte  10^18  
	      '1125899906842624'    => 'PB', // Peta Byte 10^15  
	      '1099511627776'       => 'TB', 
	      '1073741824'          => 'GB', 
	      '1048576'             => 'MB', 
	      '1024'                => 'KB' 
	    ); 
	
	    if($bytes <= 1024) 
	      return $bytes . " Bytes"; 
	     
	    foreach($units as $base => $title) 
	      if(floor($bytes / $base) != 0) 
	        return number_format($bytes / $base, $decimals, ".", "'") . ' ' . $title; 
	} 
*/
?>
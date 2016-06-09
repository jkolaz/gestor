<?php
require_once 'UpLoadFile.php';
require_once 'class.cropcanvas.php';

class myUtilities 
{
	
	var $smarty;
	var $errors;
	
	function __construct()
	{
		//$this->smarty = Zend_Registry::get('smarty');
		$this->errors = array();
		$this->upLoadErrors();
	}
	
	function uploadFile($file1,$xdir,$extends = "jpg",$nameImg = "",$maxKB = 600)
	{
		//Zend_Loader::loadClass('UpLoadFile','library/myclass');
		$fp =  new UpLoadFile($file1);
		$fp->setDirectory($xdir);
		$fp->getDirPerm(true);
		$name = uniqid("vmc");
		if($nameImg != "")
		{
			$name = explode("[/.]", $nameImg);
			//var_dump($name);
			$fp->setFile_newName($name[0]);
		}else{
			$fp->setFile_newName($name);
		}
		
		$fp->setFileExt($extends);
		$fp->setFileSizeMax($maxKB,"KB");// 200 KB
		
		if(!$fp->saveFile(true))
		{
			return (array)$fp->showError();
		}else{
			$GImg = $fp->getFile_newName();
			return $GImg;
		}
	}
	
	function deleteFile($xdir)
	{
		return @unlink($xdir);
	}
	
	function copyFile($from,$to)
	{
		return copy($from,$to);
	}
	
	function upLoadErrors(){
		$this->errors[23000] = "Error de integridad, Existen campos que no pueden ser nulos o repetidos.";
		$this->errors[1] = "El registro se guardó con éxito";
		$this->errors[0] = "No se pudo guardar ningun registro";
		$this->errors["42S22"] = "Una columna Ingresada no existe";
	}
	
	function getMessage($code){
		return $this->errors[$code];
	}
	
	function getNewDimencions($img,$max_x,$max_y,$modo_redir = "N")
	{
		//var_dump($img);
		$new_w_R = imagesx($img);
		$new_h_R = imagesy($img);
		
		$or_x = $new_w_R;
		$or_y = $new_h_R;
		
		$add_info = "";
		
		switch($modo_redir)
		{
			case "N":
				if($or_x > $max_x)
				{
					$dif_x = $or_x-$max_x;			
					$new_x = $or_x-$dif_x;
					
					$Pdif_x = ($dif_x*100)/$or_x;
					$Pdif_x = $Pdif_x / 100;
					
					$new_y = $or_y-($or_y*$Pdif_x);
				}else
				{
					$new_x = $or_x;
					$new_y = $or_y;
				}
				
				$or_y = $new_y;
				
				if($new_y > $max_y)
				{
					
					$dif_y = $new_y - $max_y;			
					$new_y = $new_y-$dif_y;
								
					$Pdif_y = ($dif_y*100)/$or_y;
					$Pdif_y = $Pdif_y / 100;
					$new_x = $new_x-($new_x*$Pdif_y);
					
				}
				break;
			case "MAX":
				
				if($or_x > $max_x && $or_y > $max_y)
				{
					/*Reducimos por X*/
					//% de reduccion es:
					//echo "dd";
					if($or_x > $or_y)
					{
											
						$por_red_x = ($max_x * 100) / $or_x;
						$por_red_y = $por_red_x;
					}else
					{
						$por_red_y = ($max_y * 100) / $or_y;						
						$por_red_x = $por_red_y;	
					}
					
					
					
				}elseif($or_x > $max_x && $or_y < $max_y)
				{
					$por_red_x = ($max_x * 100) / $or_x;
					$por_red_y = 100;
					$add_info = "CX";
						
				}elseif($or_y > $max_y && $or_x < $max_x)
				{
					
					$por_red_y = ($max_y * 100) / $or_y;
					$por_red_x = 100;
					$add_info = "CY";
				}else
				{
					$por_red_x = 100;
					$por_red_y = 100;
				}
				
				
				$new_x = ($por_red_x*$or_x)/100;
				$new_y = ($por_red_y*$or_y)/100;
				
				
				
				/*if($new_y > $max_y)
				{
					$por_red_y = ($max_y * 100) / $or_y;
				}
				*/
				
				
				/*
				if($or_x > $max_x)
				{
					$dif_x = $or_x-$max_x;			
					$new_x = $or_x-$dif_x;
					
					$Pdif_x = ($dif_x*100)/$or_x;
					$Pdif_x = $Pdif_x / 100;
					
					$new_y = $or_y-($or_y*$Pdif_x);
				}else if($or_y > $max_y)
				{
					$dif_y = $new_y - $max_y;			
					$new_y = $new_y-$dif_y;
								
					$Pdif_y = ($dif_y*100)/$or_y;
					$Pdif_y = $Pdif_y / 100;
					$new_x = $new_x-($new_x*$Pdif_y);
				}
				*/
				break;
		}
				
		
		
		$a_nrex['x'] = intval($new_x);
		$a_nrex['y'] = intval($new_y);
		
		if($a_nrex['x'] <= 0)
		{
			$a_nrex['x'] = $new_w_R;
		}
		
		if($a_nrex['y'] <= 0)
		{
			$a_nrex['y'] = $new_h_R;
		}
		
		$a_nrex["or_x"] = $or_x;
		$a_nrex["or_y"] = $or_y;
		$a_nrex["info"] = $add_info;

		
		return $a_nrex;
	}
	
	function getImageCreateFrom($img_original,$type)
	{
		$img = false;
		//echo $img_original;
		if(file_exists($img_original)) 
		{
			$type=strtolower($type);
			
			switch($type)
			{
				case 'jpg':	
					$img = imagecreatefromjpeg($img_original);
					break;
				case 'jpeg':
					$img = imagecreatefromjpeg($img_original);
					break;
				case 'png':
					$img = @imagecreatefrompng($img_original);
					break;
				case 'gif':
					$img = @imagecreatefromgif($img_original);
					break;
				case 'wbmp':
					$img = @imagecreatefromwbmp($img_original);
					break;				
			}

		} 
		return $img;
	}
	
	function getExtention($image)
	{
		$imgbas = basename($image);
		$extArr = explode(".",$imgbas);
		return $extArr[1];
	}
	
	/**
	 * esta funcion permite redimencionar una imagen.
	 *
	 * @param unknown_type $type
	 * @param unknown_type $img_original
	 * @param unknown_type $img_nueva
	 * @param unknown_type $img_nueva_anchura
	 * @param unknown_type $img_nueva_altura
	 * @param unknown_type $img_nueva_calidad
	 * @return unknown
	 */
	function redimensionar($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad,$modo_redir = "N")
	{
			$is_int = true;
			$type = $this->getExtention($img_original);
			$img = $this->getImageCreateFrom($img_original,$type);
			
			if($img)
			{
				$aNDim = $this->getNewDimencions($img, $img_nueva_anchura,$img_nueva_altura,$modo_redir);
				//var_dump($aNDim);
				$img_nueva_anchura_re = $aNDim['x'];
				$img_nueva_altura_re = $aNDim['y'];
				
				
				
				switch($aNDim['info'])
				{
					case "CY":
					case "CX":
						/*Cortando cuando X es mas grande*/
						/*$sx = abs(intval(($img_nueva_anchura/2)-($img_nueva_anchura_re/2)));
						$sy = 0;						
						$ex = abs(intval(($img_nueva_altura/2)-($img_nueva_altura_re/2)));
						$ey = $img_nueva_altura_re;  */
						$cc = new CropCanvas(true);  
						if ($cc->loadImage($img_original))
						{	
							
						 	$cc->cropToSize($img_nueva_anchura_re,$img_nueva_altura_re,ccCENTRE);
						    $cc->saveImage($img_nueva);
							
							$is_int = false;
							if($img_nueva_anchura_re > $img_nueva_anchura)
							{
								$img_nueva_anchura_re = $img_nueva_anchura;
								$is_int = true;
							}else if($img_nueva_altura_re > $img_nueva_altura)
							{
								$is_int = true;
								$img_nueva_altura_re = $img_nueva_altura;
								
							}
							
							if($is_int)
							{
								if($cc->loadImage($img_nueva))
								{
									$cc->cropToSize($img_nueva_anchura_re,$img_nueva_altura_re,ccCENTRE);
									$cc->saveImage($img_nueva);
								}
								
							}
						    return true;
						  
						}  else
						{
							//echo "noñlpad";
							
							return false;
						}
						break;
					
					default:
																			
						$thumb = imagecreatetruecolor($img_nueva_anchura_re,$img_nueva_altura_re);
						imagecopyresampled($thumb,$img,0,0,0,0,$img_nueva_anchura_re,$img_nueva_altura_re,imagesx($img),imagesy($img));
						
						if($img_nueva_anchura_re > $img_nueva_anchura)
						{
							$img_nueva_anchura_re = $img_nueva_anchura;
							$is_int = true;
						}else if($img_nueva_altura_re > $img_nueva_altura)
						{
							$is_int = true;
							$img_nueva_altura_re = $img_nueva_altura;
							
						}
						
						if($is_int)
						{
							$cc = new CropCanvas(true);  
							if($cc->loadImage($img_nueva))
							{
								$cc->cropToSize($img_nueva_anchura_re,$img_nueva_altura_re,ccCENTRE);
								$cc->saveImage($img_nueva);
							}
							
						}
				}
				
				
				
				
				$estao_prod = false;
				
					
					
				switch ($type){						
					case 'png': 
						if(@imagepng($thumb,$img_nueva)){
							$estao_prod = true;
						}
						break;
					case 'gif': 
						if(@imagegif($thumb,$img_nueva)){
							$estao_prod = true;
						}
						break;
					default: 
						if(imagejpeg($thumb,$img_nueva,$img_nueva_calidad)){
							$estao_prod =true;
						}
				}	
				
				switch($modo_redir)
				{
					case "N":
						$estao_prod =true;
						break;
					case "MAX":
						
						$sx = abs(intval(($img_nueva_anchura-$img_nueva_anchura_re)/2));
						$sy = abs(intval(($img_nueva_altura-$img_nueva_altura_re)/2));
						//echo $sx.".".$sy;exit;
						$ex = $sx + $img_nueva_anchura;
						$ey = $sy + $img_nueva_altura;  
						  
						$cc = new CropCanvas(true);  
						if ($cc->loadImage($img_nueva))
						{ 
							//echo "load";
						 	/*$cc->cropToDimensions($sx, $sy, $ex, $ey);  
							$cc->saveImage($img_nueva);*/
							
							/*$cc->loadImage($img_nueva);*/
							
							
							
						 	$cc->cropToSize($img_nueva_anchura_re,$img_nueva_altura_re,ccCENTRE);
						    $cc->saveImage($img_nueva);
						    $estao_prod =true;
						  
						}  else
						{
							//echo "No load";
							//exit;
						}
						
						
						break;
				}				
					
				return $estao_prod;
			}else{
				return false;
			}
			
			

			return false;
	}
	
	
	function CrearDirectorio($_directory)
	{
		//echo $this->_directory;
		if(!is_dir($_directory))
		{
			if(mkdir($_directory))
			{
				chmod($_directory,0777);
				return true;
			}else
			{
			
				return false;
			}
		}
	}
	
}
?>
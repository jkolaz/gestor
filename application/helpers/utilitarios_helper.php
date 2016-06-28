<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('quitarAcentos')) {
    function quitarAcentos($string) {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }
}

if (!function_exists('imprimir')) {
    function imprimir($objeto) {
        echo '<pre>';
        print_r($objeto);
        echo '</pre>';
    }
}

if(!function_exists('guardar_archivo')){
    function guardar_archivo($nombre, $_archivo, $prefijo='', $eliminar = ''){
        $respuesta = '';
        $typeFile[] = "image/png";
        $typeFile[] = "image/jpeg";
        $typeFile[] = "image/jpg";
        if(isset($_archivo[$nombre]["name"]) && $_archivo[$nombre]["name"] != ""){
            if (in_array($_archivo[$nombre]["type"], $typeFile)) {
                    if(!is_array($_archivo[$nombre]["name"])){
                        $extension = pathinfo($_archivo[$nombre]["name"]);
                        $destination = uniqid($prefijo).'.'.$extension['extension'];
                        if(move_uploaded_file($_archivo[$nombre]['tmp_name'], PATH_GALLERY.$destination)){
                            if($eliminar != ''){
                                unlink(PATH_GALLERY.$eliminar);
                            }
                            $respuesta = $destination;
                        }
                    }
            }
        }
        return $respuesta;
    }
}

if(!function_exists('format_date')){
    function format_date_actual(){
        $dia_text = "";
        $mes_text = "";
        
        $temp_dia = date('N');
        switch ($temp_dia){
            case 1:/*Lunes*/
                $dia_text = "Lunes";
                break;
            case 2:/*Martes*/
                $dia_text = "Martes";
                break;
            case 3:/*Miercoles*/
                $dia_text = "Miercoles";
                break;
            case 4:/*Jueves*/
                $dia_text = "Jueves";
                break;
            case 5:/*Viernes*/
                $dia_text = "Viernes";
                break;
            case 6:/*Sabado*/
                $dia_text = "Sabado";
                break;
            case 7:/*Domingo*/
                $dia_text = "Domingo";
                break;
        }
        
        $temp_mes = date('n');
        switch ($temp_mes){
            case 1:/*enero*/
                $mes_text = "enero" ;
                break;
            case 2:/*febrero*/
                $mes_text = "febrero" ;
                break;
            case 3:/*marzo*/
                $mes_text = "marzo" ;
                break;
            case 4:/*abril*/
                $mes_text = "abril" ;
                break;
            case 5:/*mayo*/
                $mes_text = "mayo" ;
                break;
            case 6:/*junio*/
                $mes_text = "junio" ;
                break;
            case 7:/*julio*/
                $mes_text = "julio" ;
                break;
            case 8:/*agosto*/
                $mes_text = "agosto" ;
                break;
            case 9:/*septiembre*/
                $mes_text = "septiembre" ;
                break;
            case 10:/*octubre*/
                $mes_text = "octubre" ;
                break;
            case 11:/*noviembre*/
                $mes_text = "noviembre" ;
                break;
            case 12:/*diciembre*/
                $mes_text = "diciembre" ;
                break;
        }
        
        $stdFecha = new stdClass();
        $stdFecha->dia_text = $dia_text;
        $stdFecha->mes_text = $mes_text;
        return $stdFecha;
    }
}

if(!function_exists('estado')){
    function estado($id){
        $html = '';
        switch ($id){
            case 1:
                $html = '';
                break;
        }
        return $html;
    }
}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of evento_model
 *
 * @author julio
 */
class Evento_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $eve_id;
    public $eve_nombre;
    public $eve_url;
    public $eve_fecha;
    public $eve_lugar;
    public $eve_descripcion;
    public $eve_imagen;
    public $eve_estado;
    public $eve_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_evento';
        self::$_PK = 'eve_id';
    }
    
    public function getAll($where = array()){
        $where['eve_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('eve_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_eve_nombre'])){
            $this->eve_nombre = $post['txt_eve_nombre'];
        }
        if(isset($post['txt_eve_url'])){
            $this->eve_url = $post['txt_eve_url'];
        }
        if(isset($post['txt_eve_fecha'])){
            $this->eve_fecha = $post['txt_eve_fecha'];
        }
        if(isset($post['txt_eve_lugar'])){
            $this->eve_lugar = $post['txt_eve_lugar'];
        }
        if(isset($post['txt_eve_descripcion'])){
            $this->eve_descripcion = $post['txt_eve_descripcion'];
        }
        if(isset($post['txt_eve_imagen'])){
            $this->eve_imagen = $post['txt_eve_imagen'];
        }
        if(isset($post['txt_eve_estado'])){
            $this->eve_estado = $post['txt_eve_estado'];
        }
        if(isset($post['txt_eve_sed_id'])){
            $this->eve_sed_id = $post['txt_eve_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->eve_nombre != ""){
            $insert['eve_nombre'] = $this->eve_nombre;
        }
        if($this->eve_url != ""){
            $insert['eve_url'] = $this->eve_url;
        }
        if($this->eve_fecha != ""){
            $insert['eve_fecha'] = $this->eve_fecha;
        }
        if($this->eve_lugar != ""){
            $insert['eve_lugar'] = $this->eve_lugar;
        }
        if($this->eve_descripcion != ""){
            $insert['eve_descripcion'] = $this->eve_descripcion;
        }
        if($this->eve_imagen != ""){
            $insert['eve_imagen'] = $this->eve_imagen;
        }
        if($this->eve_estado >= 0){
            $insert['eve_estado'] = $this->eve_estado;
        }
        if($this->eve_sed_id >= 0){
            $insert['eve_sed_id'] = $this->eve_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->eve_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where['eve_id'] = $id;
        $where['eve_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->eve_id = $arreglo[0]->eve_id;
            $this->eve_nombre = $arreglo[0]->eve_nombre;
            $this->eve_url = $arreglo[0]->eve_url;
            $this->eve_fecha = $arreglo[0]->eve_fecha;
            $this->eve_lugar = $arreglo[0]->eve_lugar;
            $this->eve_descripcion = $arreglo[0]->eve_descripcion;
            $this->eve_imagen = $arreglo[0]->eve_imagen;
            $this->eve_estado = $arreglo[0]->eve_estado;
            $this->eve_sed_id = $arreglo[0]->eve_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->eve_nombre != ""){
            $update['eve_nombre'] = $this->eve_nombre;
        }
        if($this->eve_url != ""){
            $update['eve_url'] = $this->eve_url;
        }
        if($this->eve_fecha != ""){
            $update['eve_fecha'] = $this->eve_fecha;
        }
        if($this->eve_lugar != ""){
            $update['eve_lugar'] = $this->eve_lugar;
        }
        if($this->eve_descripcion != ""){
            $update['eve_descripcion'] = $this->eve_descripcion;
        }
        if($this->eve_imagen != ""){
            $update['eve_imagen'] = $this->eve_imagen;
        }
        if($this->eve_estado >= 0){
            $update['eve_estado'] = $this->eve_estado;
        }
        if($this->eve_sed_id >= 0){
            $update['eve_sed_id'] = $this->eve_sed_id;
        }
        
        if($this->eve_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->eve_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

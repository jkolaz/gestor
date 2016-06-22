<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicio_model
 *
 * @author Usuario
 */
class Servicio_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $ser_id;
    public $ser_nombre;
    public $ser_url;
    public $ser_descripcion;
    public $ser_imagen;
    public $ser_estado;
    public $ser_sed_id;
    public $ser_listado;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_servicio';
        self::$_PK = 'ser_id';
    }
    
    public function getAll($where = array()){
        $where['ser_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('ser_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ser_nombre'])){
            $this->ser_nombre = $post['txt_ser_nombre'];
        }
        if(isset($post['txt_ser_descripcion'])){
            $this->ser_descripcion = $post['txt_ser_descripcion'];
        }
        if(isset($post['txt_ser_imagen'])){
            $this->ser_imagen = $post['txt_ser_imagen'];
        }
        if(isset($post['txt_ser_sed_id'])){
            $this->ser_sed_id = $post['txt_ser_sed_id'];
        }
        if(isset($post['txt_ser_listado'])){
            $this->ser_listado = $post['txt_ser_listado'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->ser_nombre != ""){
            $insert['ser_nombre'] = $this->ser_nombre;
        }
        if($this->ser_url != ""){
            $insert['ser_url'] = $this->ser_url;
        }
        if($this->ser_descripcion != ""){
            $insert['ser_descripcion'] = $this->ser_descripcion;
        }
        if($this->ser_imagen != ""){
            $insert['ser_imagen'] = $this->ser_imagen;
        }
        if($this->ser_listado != ""){
            $insert['ser_listado'] = $this->ser_listado;
        }
        if($this->ser_estado >= 0 && $this->ser_estado != ""){
            $insert['ser_estado'] = $this->ser_estado;
        }
        if($this->ser_sed_id >= 0 && $this->ser_sed_id != ""){
            $insert['ser_sed_id'] = $this->ser_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->ser_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['ser_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ser_id = $arreglo[0]->ser_id;
            $this->ser_nombre = $arreglo[0]->ser_nombre;
            $this->ser_url = $arreglo[0]->ser_url;
            $this->ser_descripcion = $arreglo[0]->ser_descripcion;
            $this->ser_imagen = $arreglo[0]->ser_imagen;
            $this->ser_listado = $arreglo[0]->ser_listado;
            $this->ser_estado = $arreglo[0]->ser_estado;
            $this->ser_sed_id = $arreglo[0]->ser_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->ser_nombre != ""){
            $update['ser_nombre'] = $this->ser_nombre;
        }
        if($this->ser_url != ""){
            $update['ser_url'] = $this->ser_url;
        }
        if($this->ser_descripcion != ""){
            $update['ser_descripcion'] = $this->ser_descripcion;
        }
        if($this->ser_listado != ""){
            $update['ser_listado'] = $this->ser_listado;
        }
        if($this->ser_imagen != ""){
            $update['ser_imagen'] = $this->ser_imagen;
        }
        if($this->ser_estado >= 0 || $this->ser_estado != ""){
            $update['ser_estado'] = $this->ser_estado;
        }
        if($this->ser_sed_id >= 0 || $this->ser_sed_id != ""){
            $update['ser_sed_id'] = $this->ser_sed_id;
        }
        
        if($this->ser_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->ser_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

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
class Convocatoria_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $con_id;
    public $con_nombre;
    public $con_url;
    public $con_descripcion;
    public $con_imagen;
    public $con_estado;
    public $con_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_convocatorias';
        self::$_PK = 'con_id';
    }
    
    public function getAll($where = array()){
        $where['con_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('con_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_con_nombre'])){
            $this->con_nombre = $post['txt_con_nombre'];
        }
        if(isset($post['txt_con_url'])){
            $this->con_url = $post['txt_con_url'];
        }
        if(isset($post['txt_con_descripcion'])){
            $this->con_descripcion = $post['txt_con_descripcion'];
        }
        if(isset($post['txt_con_imagen'])){
            $this->con_imagen = $post['txt_con_imagen'];
        }
        if(isset($post['txt_con_sed_id'])){
            $this->con_sed_id = $post['txt_con_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->con_nombre != ""){
            $insert['con_nombre'] = $this->con_nombre;
        }
        if($this->con_url != ""){
            $insert['con_url'] = $this->con_url;
        }
        if($this->con_descripcion != ""){
            $insert['con_descripcion'] = $this->con_descripcion;
        }
        if($this->con_imagen != ""){
            $insert['con_imagen'] = $this->con_imagen;
        }
        if($this->con_estado >= 0 && $this->con_estado != ""){
            $insert['con_estado'] = $this->con_estado;
        }
        if($this->con_sed_id >= 0 && $this->con_sed_id != ""){
            $insert['con_sed_id'] = $this->con_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->con_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['con_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->con_id = $arreglo[0]->con_id;
            $this->con_nombre = $arreglo[0]->con_nombre;
            $this->con_url = $arreglo[0]->con_url;
            $this->con_descripcion = $arreglo[0]->con_descripcion;
            $this->con_imagen = $arreglo[0]->con_imagen;
            $this->con_estado = $arreglo[0]->con_estado;
            $this->con_sed_id = $arreglo[0]->con_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->con_nombre != ""){
            $update['con_nombre'] = $this->con_nombre;
        }
        if($this->con_url != ""){
            $update['con_url'] = $this->con_url;
        }
        if($this->con_descripcion != ""){
            $update['con_descripcion'] = $this->con_descripcion;
        }
        if($this->con_imagen != ""){
            $update['con_imagen'] = $this->con_imagen;
        }
        if($this->con_estado >= 0 || $this->con_estado != ""){
            $update['con_estado'] = $this->con_estado;
        }
        if($this->con_sed_id >= 0 || $this->con_sed_id != ""){
            $update['con_sed_id'] = $this->con_sed_id;
        }
        
        if($this->con_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->con_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

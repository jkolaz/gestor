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
class Directorio_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $dir_id;
    public $dir_nombre;
    public $dir_encargado;
    public $dir_telefono;
    public $dir_correo;
    public $dir_estado;
    public $dir_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_directorio';
        self::$_PK = 'dir_id';
    }
    
    public function getAll($where = array()){
        $where['dir_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('dir_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_dir_nombre'])){
            $this->dir_nombre = $post['txt_dir_nombre'];
        }
        if(isset($post['txt_dir_encargado'])){
            $this->dir_encargado = $post['txt_dir_encargado'];
        }
        if(isset($post['txt_dir_telefono'])){
            $this->dir_telefono = $post['txt_dir_telefono'];
        }
        if(isset($post['txt_dir_correo'])){
            $this->dir_correo = $post['txt_dir_correo'];
        }
        if(isset($post['txt_dir_sed_id'])){
            $this->dir_sed_id = $post['txt_dir_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->dir_nombre != ""){
            $insert['dir_nombre'] = $this->dir_nombre;
        }
        if($this->dir_encargado != ""){
            $insert['dir_encargado'] = $this->dir_encargado;
        }
        if($this->dir_telefono != ""){
            $insert['dir_telefono'] = $this->dir_telefono;
        }
        if($this->dir_correo != ""){
            $insert['dir_correo'] = $this->dir_correo;
        }
        if($this->dir_estado >= 0){
            $insert['dir_estado'] = $this->dir_estado;
        }
        if($this->dir_sed_id >= 0){
            $insert['dir_sed_id'] = $this->dir_sed_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->dir_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->dir_id = $arreglo[0]->dir_id;
            $this->dir_nombre = $arreglo[0]->dir_nombre;
            $this->dir_encargado = $arreglo[0]->dir_encargado;
            $this->dir_telefono = $arreglo[0]->dir_telefono;
            $this->dir_correo = $arreglo[0]->dir_correo;
            $this->dir_estado = $arreglo[0]->dir_estado;
            $this->dir_sed_id = $arreglo[0]->dir_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->dir_nombre != ""){
            $update['dir_nombre'] = $this->dir_nombre;
        }
        if($this->dir_encargado != ""){
            $update['dir_encargado'] = $this->dir_encargado;
        }
        if($this->dir_telefono != ""){
            $update['dir_telefono'] = $this->dir_telefono;
        }
        if($this->dir_correo != ""){
            $update['dir_correo'] = $this->dir_correo;
        }
        if($this->dir_estado >= 0 || $this->dir_estado != ""){
            $update['dir_estado'] = $this->dir_estado;
        }
        if($this->dir_sed_id >= 0 || $this->dir_sed_id != ""){
            $update['dir_sed_id'] = $this->dir_sed_id;
        }
        
        if($this->dir_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->dir_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

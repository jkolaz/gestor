<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fundador_model
 *
 * @author VMC-D02
 */
class Ordenes_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $ord_id;
    public $ord_nombre;
    public $ord_descripcion;
    public $ord_descripcion_2;
    public $ord_imagen;
    public $ord_estado;
    public $ord_sed_id;
    public $ord_tc_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_ordenes';
        self::$_PK = 'ord_id';
    }
    
    public function getAll($where = array()){
        $where['ord_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('ord_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ord_nombre'])){
            $this->ord_nombre = $post['txt_ord_nombre'];
        }
        if(isset($post['txt_ord_descripcion'])){
            $this->ord_descripcion = $post['txt_ord_descripcion'];
        }
        if(isset($post['txt_ord_descripcion_2'])){
            $this->ord_descripcion_2 = $post['txt_ord_descripcion_2'];
        }
        if(isset($post['txt_ord_imagen'])){
            $this->ord_imagen = $post['txt_ord_imagen'];
        }
        if(isset($post['txt_ord_tc_id'])){
            $this->ord_tc_id = $post['txt_ord_tc_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->ord_nombre != ""){
            $insert['ord_nombre'] = $this->ord_nombre;
        }
        if($this->ord_descripcion != ""){
            $insert['ord_descripcion'] = $this->ord_descripcion;
        }
        if($this->ord_descripcion_2 != ""){
            $insert['ord_descripcion_2'] = $this->ord_descripcion_2;
        }
        if($this->ord_imagen != ""){
            $insert['ord_imagen'] = $this->ord_imagen;
        }
        if($this->ord_estado >= 0){
            $insert['ord_estado'] = $this->ord_estado;
        }
        if($this->ord_sed_id >= 0){
            $insert['ord_sed_id'] = $this->ord_sed_id;
        }
        if($this->ord_tc_id >= 0){
            $insert['ord_tc_id'] = $this->ord_tc_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->ord_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ord_id = $arreglo[0]->ord_id;
            $this->ord_nombre = $arreglo[0]->ord_nombre;
            $this->ord_descripcion = $arreglo[0]->ord_descripcion;
            $this->ord_descripcion_2 = $arreglo[0]->ord_descripcion_2;
            $this->ord_imagen = $arreglo[0]->ord_imagen;
            $this->ord_estado = $arreglo[0]->ord_estado;
            $this->ord_sed_id = $arreglo[0]->ord_sed_id;
            $this->ord_tc_id = $arreglo[0]->ord_tc_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->ord_nombre != ""){
            $updat0e['ord_nombre'] = $this->ord_nombre;
        }
        if($this->ord_descripcion != ""){
            $update['ord_descripcion'] = $this->ord_descripcion;
        }
        if($this->ord_descripcion_2 != ""){
            $update['ord_descripcion_2'] = $this->ord_descripcion_2;
        }
        if($this->ord_imagen != ""){
            $update['ord_imagen'] = $this->ord_imagen;
        }
        if($this->ord_estado >= 0 || $this->ord_estado != ""){
            $update['ord_estado'] = $this->ord_estado;
        }
        if($this->ord_sed_id >= 0 || $this->ord_sed_id != ""){
            $update['ord_sed_id'] = $this->ord_sed_id;
        }
        if($this->ord_tc_id >= 0 || $this->ord_tc_id != ""){
            $update['ord_tc_id'] = $this->ord_tc_id;
        }
        
        if($this->ord_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->ord_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

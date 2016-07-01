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
class Vocacional_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $voc_id;
    public $voc_nombre;
    public $voc_descripcion;
    public $voc_descripcion_2;
    public $voc_imagen;
    public $voc_estado;
    public $voc_sed_id;
    public $voc_tc_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_vocacional';
        self::$_PK = 'voc_id';
    }
    
    public function getAll($where = array()){
        $where['voc_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('voc_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_voc_nombre'])){
            $this->voc_nombre = $post['txt_voc_nombre'];
        }
        if(isset($post['txt_voc_descripcion'])){
            $this->voc_descripcion = $post['txt_voc_descripcion'];
        }
        if(isset($post['txt_voc_descripcion_2'])){
            $this->voc_descripcion_2 = $post['txt_voc_descripcion_2'];
        }
        if(isset($post['txt_voc_imagen'])){
            $this->voc_imagen = $post['txt_voc_imagen'];
        }
        if(isset($post['txt_voc_tc_id'])){
            $this->voc_tc_id = $post['txt_voc_tc_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->voc_nombre != ""){
            $insert['voc_nombre'] = $this->voc_nombre;
        }
        if($this->voc_descripcion != ""){
            $insert['voc_descripcion'] = $this->voc_descripcion;
        }
        if($this->voc_descripcion_2 != ""){
            $insert['voc_descripcion_2'] = $this->voc_descripcion_2;
        }
        if($this->voc_imagen != ""){
            $insert['voc_imagen'] = $this->voc_imagen;
        }
        if($this->voc_estado >= 0){
            $insert['voc_estado'] = $this->voc_estado;
        }
        if($this->voc_sed_id >= 0){
            $insert['voc_sed_id'] = $this->voc_sed_id;
        }
        if($this->voc_tc_id >= 0){
            $insert['voc_tc_id'] = $this->voc_tc_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->voc_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->voc_id = $arreglo[0]->voc_id;
            $this->voc_nombre = $arreglo[0]->voc_nombre;
            $this->voc_descripcion = $arreglo[0]->voc_descripcion;
            $this->voc_descripcion_2 = $arreglo[0]->voc_descripcion_2;
            $this->voc_imagen = $arreglo[0]->voc_imagen;
            $this->voc_estado = $arreglo[0]->voc_estado;
            $this->voc_sed_id = $arreglo[0]->voc_sed_id;
            $this->voc_tc_id = $arreglo[0]->voc_tc_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->voc_nombre != ""){
            $update['voc_nombre'] = $this->voc_nombre;
        }
        if($this->voc_descripcion != ""){
            $update['voc_descripcion'] = $this->voc_descripcion;
        }
        if($this->voc_descripcion_2 != ""){
            $update['voc_descripcion_2'] = $this->voc_descripcion_2;
        }
        if($this->voc_imagen != ""){
            $update['voc_imagen'] = $this->voc_imagen;
        }
        if($this->voc_estado >= 0 || $this->voc_estado != ""){
            $update['voc_estado'] = $this->voc_estado;
        }
        if($this->voc_sed_id >= 0 || $this->voc_sed_id != ""){
            $update['voc_sed_id'] = $this->voc_sed_id;
        }
        if($this->voc_tc_id >= 0 || $this->voc_tc_id != ""){
            $update['voc_tc_id'] = $this->voc_tc_id;
        }
        
        if($this->voc_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->voc_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

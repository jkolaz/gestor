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
class Saludsocial_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $ss_id;
    public $ss_nombre;
    public $ss_descripcion;
    public $ss_imagen;
    public $ss_estado;
    public $ss_sed_id;
    public $ss_tc_id;
    public $ss_orden;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_salud_social';
        self::$_PK = 'ss_id';
    }
    
    public function getAll($where = array()){
        $where['ss_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('ss_orden')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ss_nombre'])){
            $this->ss_nombre = $post['txt_ss_nombre'];
        }
        if(isset($post['txt_ss_descripcion'])){
            $this->ss_descripcion = $post['txt_ss_descripcion'];
        }
        if(isset($post['txt_ss_imagen'])){
            $this->ss_imagen = $post['txt_ss_imagen'];
        }
        if(isset($post['txt_ss_tc_id'])){
            $this->ss_tc_id = $post['txt_ss_tc_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->ss_nombre != ""){
            $insert['ss_nombre'] = $this->ss_nombre;
        }
        if($this->ss_descripcion != ""){
            $insert['ss_descripcion'] = $this->ss_descripcion;
        }
        if($this->ss_imagen != ""){
            $insert['ss_imagen'] = $this->ss_imagen;
        }
        if($this->ss_estado >= 0){
            $insert['ss_estado'] = $this->ss_estado;
        }
        if($this->ss_sed_id >= 0){
            $insert['ss_sed_id'] = $this->ss_sed_id;
        }
        if($this->ss_tc_id >= 0){
            $insert['ss_tc_id'] = $this->ss_tc_id;
        }
        if($this->ss_orden >= 0){
            $insert['ss_orden'] = $this->ss_orden;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->ss_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ss_id = $arreglo[0]->ss_id;
            $this->ss_nombre = $arreglo[0]->ss_nombre;
            $this->ss_descripcion = $arreglo[0]->ss_descripcion;
            $this->ss_imagen = $arreglo[0]->ss_imagen;
            $this->ss_estado = $arreglo[0]->ss_estado;
            $this->ss_sed_id = $arreglo[0]->ss_sed_id;
            $this->ss_tc_id = $arreglo[0]->ss_tc_id;
            $this->ss_orden = $arreglo[0]->ss_orden;
        }
    }
    
    public function update(){
        $update = array();
        if($this->ss_nombre != ""){
            $update['ss_nombre'] = $this->ss_nombre;
        }
        if($this->ss_descripcion != ""){
            $update['ss_descripcion'] = $this->ss_descripcion;
        }
        if($this->ss_imagen != ""){
            $update['ss_imagen'] = $this->ss_imagen;
        }
        if($this->ss_estado >= 0 || $this->ss_estado != ""){
            $update['ss_estado'] = $this->ss_estado;
        }
        if($this->ss_sed_id >= 0 || $this->ss_sed_id != ""){
            $update['ss_sed_id'] = $this->ss_sed_id;
        }
        if($this->ss_tc_id >= 0 || $this->ss_tc_id != ""){
            $update['ss_tc_id'] = $this->ss_tc_id;
        }
        if($this->ss_orden >= 0 || $this->ss_orden != ""){
            $update['ss_orden'] = $this->ss_orden;
        }
        
        if($this->ss_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->ss_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function Max($where = array()){
        $max = 0;
        $query = $this->db->where($where)
                ->select_max('ss_orden', 'max')
                ->get(self::$_table);
        if($query->num_rows > 0){
            $row = $query->row(); 
            $max = $row->max;
        }
        return $max;;
    }
}

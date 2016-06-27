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
class Presentacion_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $pre_id;
    public $pre_descripcion;
    public $pre_estado;
    public $pre_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_presentacion';
        self::$_PK = 'pre_id';
    }
    
    public function getAll($where = array()){
        $where['pre_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('pre_fecha_reg', 'desc')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_pre_descripcion'])){
            $this->pre_descripcion = $post['txt_pre_descripcion'];
        }
        if(isset($post['txt_pre_sed_id'])){
            $this->pre_sed_id = $post['txt_pre_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->pre_descripcion != ""){
            $insert['pre_descripcion'] = $this->pre_descripcion;
        }
        if($this->pre_estado >= 0){
            $insert['pre_estado'] = $this->pre_estado;
        }
        if($this->pre_sed_id >= 0 && $this->pre_sed_id != ""){
            $insert['pre_sed_id'] = $this->pre_sed_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->pre_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->pre_id = $arreglo[0]->pre_id;
            $this->pre_descripcion = $arreglo[0]->pre_descripcion;
            $this->pre_estado = $arreglo[0]->pre_estado;
            $this->pre_sed_id = $arreglo[0]->pre_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->pre_descripcion != ""){
            $update['pre_descripcion'] = $this->pre_descripcion;
        }
        if($this->pre_estado >= 0 || $this->pre_estado != ""){
            $update['pre_estado'] = $this->pre_estado;
        }
        if($this->pre_sed_id >= 0 || $this->pre_sed_id != ""){
            $update['pre_sed_id'] = $this->pre_sed_id;
        }
        
        if($this->pre_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->pre_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

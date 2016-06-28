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
class Fundador_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $fun_id;
    public $fun_nombre;
    public $fun_cuerpo;
    public $fun_datos_interes;
    public $fun_imagen;
    public $fun_estado;
    public $fun_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_fundador';
        self::$_PK = 'fun_id';
    }
    
    public function getAll($where = array()){
        $where['fun_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('fun_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_fun_nombre'])){
            $this->fun_nombre = $post['txt_fun_nombre'];
        }
        if(isset($post['txt_fun_cuerpo'])){
            $this->fun_cuerpo = $post['txt_fun_cuerpo'];
        }
        if(isset($post['txt_fun_datos_interes'])){
            $this->fun_datos_interes = $post['txt_fun_datos_interes'];
        }
        if(isset($post['txt_fun_imagen'])){
            $this->fun_imagen = $post['txt_fun_imagen'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->fun_nombre != ""){
            $insert['fun_nombre'] = $this->fun_nombre;
        }
        if($this->fun_cuerpo != ""){
            $insert['fun_cuerpo'] = $this->fun_cuerpo;
        }
        if($this->fun_datos_interes != ""){
            $insert['fun_datos_interes'] = $this->fun_datos_interes;
        }
        if($this->fun_imagen != ""){
            $insert['fun_imagen'] = $this->fun_imagen;
        }
        if($this->fun_estado >= 0){
            $insert['fun_estado'] = $this->fun_estado;
        }
        if($this->fun_sed_id >= 0){
            $insert['fun_sed_id'] = $this->fun_sed_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->fun_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->fun_id = $arreglo[0]->fun_id;
            $this->fun_nombre = $arreglo[0]->fun_nombre;
            $this->fun_cuerpo = $arreglo[0]->fun_cuerpo;
            $this->fun_datos_interes = $arreglo[0]->fun_datos_interes;
            $this->fun_imagen = $arreglo[0]->fun_imagen;
            $this->fun_estado = $arreglo[0]->fun_estado;
            $this->fun_sed_id = $arreglo[0]->fun_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->fun_nombre != ""){
            $update['fun_nombre'] = $this->fun_nombre;
        }
        if($this->fun_cuerpo != ""){
            $update['fun_cuerpo'] = $this->fun_cuerpo;
        }
        if($this->fun_datos_interes != ""){
            $update['fun_datos_interes'] = $this->fun_datos_interes;
        }
        if($this->fun_imagen != ""){
            $update['fun_imagen'] = $this->fun_imagen;
        }
        if($this->fun_estado >= 0 || $this->fun_estado != ""){
            $update['fun_estado'] = $this->fun_estado;
        }
        if($this->fun_sed_id >= 0 || $this->fun_sed_id != ""){
            $update['fun_sed_id'] = $this->fun_sed_id;
        }
        
        if($this->fun_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->fun_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

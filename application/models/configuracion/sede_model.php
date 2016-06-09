<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sede_model
 *
 * @author julio
 */
class Sede_model extends CI_Model{
    //put your code here
    private static $_table = 'gc_sede';
    private static $_PK = 'sed_id';
    public $sed_id;
    public $sed_nombre;
    public $sed_estado;
    public $sed_reg_id;
    public $sed_url;
    public function __construct() {
        parent::__construct(); 
        $this->load->database();
    }
    
    public function getAllSede(){
        $where = array();
        $where['sed_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('sed_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getSedeById($id){
        $where['sed_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->sed_id = $arreglo[0]->sed_id;
            $this->sed_nombre = $arreglo[0]->sed_nombre;
            $this->sed_estado = $arreglo[0]->sed_estado;
            $this->sed_reg_id = $arreglo[0]->sed_reg_id;
            $this->sed_url = $arreglo[0]->sed_url;
        }
    }
    
    public function getValsForm($post){
        if(isset($post['txt_sed_nombre'])){
            $this->sed_nombre = $post['txt_sed_nombre'];
        }
        if(isset($post['txt_sed_reg_id'])){
            $this->sed_reg_id = $post['txt_sed_reg_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->sed_nombre != ""){
            $insert['sed_nombre'] = $this->sed_nombre;
            $insert['sed_url'] = quitarAcentos($this->sed_nombre);
        }
        if($this->sed_reg_id >= 0){
            $insert['sed_reg_id'] = $this->sed_reg_id;
        }
        if($this->sed_reg_id >= 0){
            $insert['sed_reg_id'] = $this->sed_reg_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->sed_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    public function update(){
        $update = array();
        if($this->sed_nombre != ""){
            $update['sed_nombre'] = $this->sed_nombre;
            $update['sed_url'] = quitarAcentos($this->sed_nombre);
        }
        if($this->sed_estado >= 0){
            $update['sed_estado'] = $this->sed_estado;
        }
        if($this->sed_reg_id >= 0){
            $update['sed_reg_id'] = $this->sed_reg_id;
        }
        if($this->sed_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->sed_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function getCountAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
}

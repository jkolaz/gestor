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
class Medico_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $med_id;
    public $med_nombre;
    public $med_estado;
    public $med_se_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_medico';
        self::$_PK = 'med_id';
    }
    
    public function getAll($where = array()){
        $where['med_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('med_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_med_nombre'])){
            $this->med_nombre = $post['txt_med_nombre'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->med_nombre != ""){
            $insert['med_nombre'] = $this->med_nombre;
        }
        if($this->med_estado >= 0){
            $insert['med_estado'] = $this->med_estado;
        }
        if($this->med_se_id >= 0){
            $insert['med_se_id'] = $this->med_se_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->med_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->med_id = $arreglo[0]->med_id;
            $this->med_nombre = $arreglo[0]->med_nombre;
            $this->med_estado = $arreglo[0]->med_estado;
            $this->med_se_id = $arreglo[0]->med_se_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->med_nombre != ""){
            $update['med_nombre'] = $this->med_nombre;
        }
        if($this->med_estado >= 0 || $this->med_estado != ""){
            $update['med_estado'] = $this->med_estado;
        }
        if($this->med_se_id >= 0 || $this->med_se_id != ""){
            $update['med_se_id'] = $this->med_se_id;
        }
        
        if($this->med_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->med_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

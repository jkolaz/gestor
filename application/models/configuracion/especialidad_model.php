<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of especialidad_model
 *
 * @author julio
 */
class Especialidad_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $esp_id;
    public $esp_nombre;
    public $esp_estado = 1;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_especialidad';
        self::$_PK = 'esp_id';
    }
    
    public function getAll($where = array()){
        $where['esp_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('esp_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_esp_nombre'])){
            $this->esp_nombre = $post['txt_esp_nombre'];
        }
        if(isset($post['txt_esp_estado'])){
            $this->esp_estado = $post['txt_esp_estado'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->esp_nombre != ""){
            $insert['esp_nombre'] = $this->esp_nombre;
        }
        if($this->esp_estado >= 0){
            $insert['esp_estado'] = $this->esp_estado;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->esp_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['esp_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->esp_id = $arreglo[0]->esp_id;
            $this->esp_nombre = $arreglo[0]->esp_nombre;
            $this->esp_estado = $arreglo[0]->esp_estado;
        }
    }
    
    public function update(){
        $update = array();
        if($this->esp_nombre != ""){
            $update['esp_nombre'] = $this->esp_nombre;
        }
        if($this->esp_estado >= 0){
            $update['esp_estado'] = $this->esp_estado;
        }
        
        if($this->esp_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->esp_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

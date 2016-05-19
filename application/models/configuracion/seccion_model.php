<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seccion_model
 *
 * @author julio
 */
class Seccion_model extends CI_Controller{
    //put your code here
    private static $_table = 'gc_seccion';
    private static $_PK = 'sec_id';
    public $sec_id;
    public $sec_nombre;
    public $sec_estado;
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAllSeccion(){
        $where = array();
        $where['sec_estado'] = 1;
        
        $query = $this->db->where($where)->order_by('sec_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getSeccionById($id){
        $where['sec_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->sec_id = $arreglo[0]->sec_id;
            $this->sec_nombre = $arreglo[0]->sec_nombre;
            $this->sec_estado = $arreglo[0]->sec_estado;
        }
    }
    
    public function getValsForm($post){
        if(isset($post['txt_sec_nombre'])){
            $this->sec_nombre = $post['txt_sec_nombre'];
        }
    }
    
    public function insert(){
        $insert = array();
        if($this->sec_nombre != ""){
            $insert['sec_nombre'] = $this->sec_nombre;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->sec_nombre != ""){
            $update['sec_nombre'] = $this->sec_nombre;
        }
        if($this->sec_estado != ""){
            $update['sec_estado'] = $this->sec_estado;
        }
        if($this->sec_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->sec_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

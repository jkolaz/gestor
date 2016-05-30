<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sedeespecialidad_model
 *
 * @author julio
 */
class Sedeespecialidad_model extends CI_Controller{
    //put your code here
    private static $_table;
    private static $_PK;
    public $se_id;
    public $se_estado;
    public $se_sed_id;
    public $se_esp_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_sede_especialidad';
        self::$_PK = 'se_id';
    }
    
    public function permiso($sede){
        $sql = "select
                    gc_especialidad.esp_id,
                    gc_especialidad.esp_nombre,
                    if((select count(gc_sede_especialidad.se_id) 
                        from 
                            gc_sede_especialidad 
                        where 
                            gc_sede_especialidad.se_sed_id={$sede} 
                                and gc_sede_especialidad.se_esp_id=gc_especialidad.esp_id 
                                and gc_sede_especialidad.se_estado=1),'checked', '') as 'checked' 
                from
                    gc_especialidad 
                where
                    esp_estado";
        
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
     public function getRow($id = 0, $where = array()){
        if($id > 0){
            $where[self::$_PK] = $id;
        }
        if(count($where) > 0){
            $this->db->where($where);
        }
        $query = $this->db->get(self::$_table, 1);
        
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->se_id = $arreglo[0]->se_id;
            $this->se_estado = $arreglo[0]->se_estado;
            $this->se_esp_id = $arreglo[0]->se_esp_id;
            $this->se_sed_id = $arreglo[0]->se_sed_id;
        }
    }
    
    public function getCountAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
    
    public function getAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function insert(){
        $insert = array();
        if($this->se_sed_id != ""){
            $insert['se_sed_id'] = $this->se_sed_id;
        }
        if($this->se_esp_id != ""){
            $insert['se_esp_id'] = $this->se_esp_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->se_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->se_esp_id != ""){
            $update['se_esp_id'] = $this->se_esp_id;
        }
        if($this->se_sed_id != ""){
            $update['se_sed_id'] = $this->se_sed_id;
        }
        if($this->se_estado != ""){
            $update['se_estado'] = $this->se_estado;
        }
        if($this->se_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->se_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

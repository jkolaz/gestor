<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sedeSeccion_model
 *
 * @author VMC-D02
 */
class SedeSeccion_model extends CI_Model{
    //put your code here
    private static $_table = 'gc_sede_seccion';
    private static $_PK = 'ss_id';
    public $ss_id;
    public $ss_estado;
    public $ss_sed_id;
    public $ss_sec_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getRow($id = 0, $where = array()){
        if($id > 0){
            $where['ss_id'] = $id;
        }
        if(count($where) > 0){
            $this->db->where($where);
        }
        $query = $this->db->get(self::$_table, 1);
        
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ss_id = $arreglo[0]->ss_id;
            $this->ss_sed_id = $arreglo[0]->ss_sed_id;
            $this->ss_sec_id = $arreglo[0]->ss_sec_id;
            $this->ss_estado = $arreglo[0]->ss_estado;
        }
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
    public function getCountAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
    
    public function insert(){
        $insert = array();
        if($this->ss_estado != ""){
            $insert['ss_estado'] = $this->ss_estado;
        }
        if($this->ss_sed_id != ""){
            $insert['ss_sed_id'] = $this->ss_sed_id;
        }
        if($this->ss_sec_id != ""){
            $insert['ss_sec_id'] = $this->ss_sec_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->ss_estado != ""){
            $update['ss_estado'] = $this->ss_estado;
        }
        if($this->ss_sed_id != ""){
            $update['ss_sed_id'] = $this->ss_sed_id;
        }
        if($this->ss_sec_id != ""){
            $update['ss_sec_id'] = $this->ss_sec_id;
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
}

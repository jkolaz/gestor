<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sedetelefono_model
 *
 * @author julio
 */
class Sedetelefono_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $st_id;
    public $st_num;
    public $st_fecha_reg;
    public $st_estado;
    public $st_sed_id;
    
    public function __construct() {
        parent::__construct();
        self::$_table = 'gc_sede_telefono';
        self::$_PK = 'st_id';
    }
    
    public function getValsForm($post){
        if(isset($post['txt_st_num'])){
            $this->st_num = $post['txt_st_num'];
        }
    }
    
    public function getAllCount($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
    
    public function getAll($where = array()){
        $where['st_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('st_num')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->st_id = $arreglo[0]->st_id;
            $this->st_num = $arreglo[0]->st_num;
            $this->st_estado = $arreglo[0]->st_estado;
            $this->st_sed_id = $arreglo[0]->st_sed_id;
        }
    }
    
    public function getRowByCols($where){
        $where['st_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->st_id = $arreglo[0]->st_id;
            $this->st_num = $arreglo[0]->st_num;
            $this->st_estado = $arreglo[0]->st_estado;
            $this->st_sed_id = $arreglo[0]->st_sed_id;
        }
    }
    
    public function insert(){
        if($this->st_estado == ""){
            $this->st_estado = 1;
        }
        $insert = array();
        if($this->st_num != ""){
            $insert['st_num'] = $this->st_num;
        }
        if($this->st_sed_id >= 0){
            $insert['st_sed_id'] = $this->st_sed_id;
        }
        if($this->st_estado >= 0){
            $insert['st_estado'] = $this->st_estado;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->st_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    public function update(){
        $update = array();
        if($this->st_num != ""){
            $update['st_num'] = $this->st_num;
        }
        if($this->st_sed_id >= 0){
            $update['st_sed_id'] = $this->st_sed_id;
        }
        if($this->st_estado >= 0){
            $update['st_estado'] = $this->st_estado;
        }
        if($this->st_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->st_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

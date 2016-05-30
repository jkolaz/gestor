<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of revista_model
 *
 * @author julio
 */
class Revista_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $rev_id;
    public $rev_nombre;
    public $rev_issuu;
    public $rev_estado;
    public $rev_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_revista';
        self::$_PK = 'rev_id';
    }
    
    public function getAll($where = array()){
        $where['rev_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('rev_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_rev_nombre'])){
            $this->rev_nombre = $post['txt_rev_nombre'];
        }
        if(isset($post['txt_rev_issuu'])){
            $this->rev_issuu = $post['txt_rev_issuu'];
        }
        if(isset($post['txt_rev_estado'])){
            $this->rev_estado = $post['txt_rev_estado'];
        }
        if(isset($post['txt_rev_sed_id'])){
            $this->rev_sed_id = $post['txt_rev_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->rev_nombre != ""){
            $insert['rev_nombre'] = $this->rev_nombre;
        }
        if($this->rev_issuu != ""){
            $insert['rev_issuu'] = $this->rev_issuu;
        }
        if($this->rev_estado >= 0){
            $insert['rev_estado'] = $this->rev_estado;
        }
        if($this->rev_sed_id >= 0){
            $insert['rev_sed_id'] = $this->rev_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->rev_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['rev_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->rev_id = $arreglo[0]->rev_id;
            $this->rev_nombre = $arreglo[0]->rev_nombre;
            $this->rev_issuu = $arreglo[0]->rev_issuu;
            $this->rev_estado = $arreglo[0]->rev_estado;
            $this->rev_sed_id = $arreglo[0]->rev_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->rev_nombre != ""){
            $update['rev_nombre'] = $this->rev_nombre;
        }
        if($this->rev_issuu != ""){
            $update['rev_issuu'] = $this->rev_issuu;
        }
        if($this->rev_estado >= 0){
            $update['rev_estado'] = $this->rev_estado;
        }
        if($this->rev_sed_id >= 0){
            $update['rev_sed_id'] = $this->rev_sed_id;
        }
        
        if($this->rev_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->rev_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

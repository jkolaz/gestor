<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipobanner_model
 *
 * @author VMC-D02
 */
class Tipobanner_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $tb_id;
    public $tb_nombre;
    public $tb_estado;
    public $tb_ancho;
    public $tb_alto;
    
    public function __construct() {
        parent::__construct();
        self::$_table = 'gc_tipo_banner';
        self::$_PK = 'tb_id';
    }
    
    public function getAll($where = array()){
        $where['tb_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('tb_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ban_nombre'])){
            $this->tb_nombre = $post['txt_ban_nombre'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->tb_nombre != ""){
            $insert['ban_img'] = $this->ban_img;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->tb_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['tb_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->tb_id = $arreglo[0]->tb_id;
            $this->tb_nombre = $arreglo[0]->tb_nombre;
            $this->tb_estado = $arreglo[0]->tb_estado;
            $this->tb_ancho = $arreglo[0]->tb_ancho;
            $this->tb_alto = $arreglo[0]->tb_alto;
        }
    }
    
    public function update(){
        $update = array();
        if($this->tb_nombre != ""){
            $update['tb_nombre'] = $this->tb_nombre;
        }
        if($this->tb_estado >= 0 && $this->tb_estado != ""){
            $update['tb_estado'] = $this->tb_estado;
        }
        
        if($this->bie_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->tb_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

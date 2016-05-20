<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipoAdmin_model
 *
 * @author julio
 */
class tipoadmin_model extends CI_Model{
    //put your code here
    
    private static $_table;
    private static $_PK = 'ta_id';
    public $ta_id;
    public $ta_nombre;
    public $ta_estado;
    public function __construct() {
        parent::__construct();
        self::$_table = 'gc_tipo_admin';        
    }
    
    public function getAllTipoAdmin(){
        $where = array();
        $where['ta_estado'] = 1;
        $query = $this->db->where($where)->order_by('ta_nombre')
                            ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getTAById($id){
        $where['ta_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ta_id = $arreglo[0]->ta_id;
            $this->ta_nombre = $arreglo[0]->ta_nombre;
            $this->ta_estado = $arreglo[0]->ta_estado;
        }
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ta_nombre'])){
            $this->ta_nombre = $post['txt_ta_nombre'];
        }
    }
    
    public function insert(){
        $insert = array();
        if($this->ta_nombre != ""){
            $insert['ta_nombre'] = $this->ta_nombre;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->ta_nombre != ""){
            $update['ta_nombre'] = $this->ta_nombre;
        }
        if($this->ta_estado != ""){
            $update['ta_estado'] = $this->ta_estado;
        }
        if($this->ta_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->ta_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

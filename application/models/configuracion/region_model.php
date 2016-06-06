<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of region_model
 *
 * @author julio
 */
class Region_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $reg_id;
    public $reg_nombre;
    public $reg_estado;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_region';
        self::$_PK = 'reg_id';
    }
    
    public function getAll(){
        $where = array();
        $where['reg_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('reg_nombre')->get(self::$_table);
        
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
            $this->reg_id = $arreglo[0]->reg_id;
            $this->reg_nombre = $arreglo[0]->reg_nombre;
            $this->reg_estado = $arreglo[0]->reg_estado;
        }
    }
}

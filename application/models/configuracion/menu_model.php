<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu_model
 *
 * @author VMC-D02
 */
class Menu_model extends CI_Controller{
    //put your code here
    private static $_table;
    private static $_PK = 'men_id';
    public $men_id;
    public $men_nombre;
    public $men_ruta;
    public $men_padre;
    public $men_estado;
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_menu';
    }
    
    public function getAll($where = array()){
        $where['men_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('men_nombre')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_men_nombre'])){
            $this->men_nombre = $post['txt_men_nombre'];
        }
        if(isset($post['txt_men_padre'])){
            $this->men_padre = $post['txt_men_padre'];
        }
        if(isset($post['txt_men_estado'])){
            $this->men_estado = $post['txt_men_estado'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->men_nombre != ""){
            $insert['men_nombre'] = $this->men_nombre;
        }
        if($this->men_ruta != ""){
            $insert['men_ruta'] = $this->men_ruta;
        }
        if($this->men_padre >= 0){
            $insert['men_padre'] = $this->men_padre;
        }
        
        if($this->men_padre > 0 && $this->men_ruta == ""){
            return FALSE;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->sed_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where['men_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->men_id = $arreglo[0]->men_id;
            $this->men_nombre = $arreglo[0]->men_nombre;
            $this->men_ruta = $arreglo[0]->men_ruta;
            $this->men_padre = $arreglo[0]->men_padre;
            $this->men_estado = $arreglo[0]->men_estado;
        }
    }
    
    public function padre_exists($id){
        $where['men_id'] = $id;
        $where['men_estado'] = 1;
        $where['men_padre'] = 0;
        $query = $this->db->where($where)->from(self::$_table)->count_all_results();
        return $query;
    }
    
    public function update(){
        $update = array();
        if($this->men_nombre != ""){
            $update['men_nombre'] = $this->men_nombre;
        }
        if($this->men_ruta != ""){
            $update['men_ruta'] = $this->men_ruta;
        }
        if($this->men_estado >= 0 || $this->men_estado != ""){
            $update['men_estado'] = $this->men_estado;
        }
        if($this->men_padre >= 0 || $this->men_padre != ""){
            $update['men_padre'] = $this->men_padre;
        }
        
        if($this->men_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->men_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

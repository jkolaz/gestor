<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bienvenida_model
 *
 * @author julio
 */
class Bienvenida_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $bie_id;
    public $bie_titulo;
    public $bie_contenido;
    public $bie_estado;
    public $bie_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_bienvenida';
        self::$_PK = 'bie_id';
    }
    
    public function getAll($where = array()){
        $where['bie_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('bie_titulo')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_bie_titulo'])){
            $this->bie_titulo = $post['txt_bie_titulo'];
        }
        if(isset($post['txt_bie_contenido'])){
            $this->bie_contenido = $post['txt_bie_contenido'];
        }
        if(isset($post['txt_bie_estado'])){
            $this->bie_estado = $post['txt_bie_estado'];
        }
        if(isset($post['txt_bie_sed_id'])){
            $this->bie_sed_id = $post['txt_bie_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->bie_titulo != ""){
            $insert['bie_titulo'] = $this->bie_titulo;
        }
        if($this->bie_contenido != ""){
            $insert['bie_contenido'] = $this->bie_contenido;
        }
        if($this->bie_estado >= 0){
            $insert['bie_estado'] = $this->bie_estado;
        }
        if($this->bie_sed_id >= 0){
            $insert['bie_sed_id'] = $this->bie_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->bie_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['bie_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->bie_id = $arreglo[0]->bie_id;
            $this->bie_titulo = $arreglo[0]->bie_titulo;
            $this->bie_contenido = $arreglo[0]->bie_contenido;
            $this->bie_estado = $arreglo[0]->bie_estado;
            $this->bie_sed_id = $arreglo[0]->bie_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->bie_titulo != ""){
            $update['bie_titulo'] = $this->bie_titulo;
        }
        if($this->bie_contenido != ""){
            $update['bie_contenido'] = $this->bie_contenido;
        }
        if($this->bie_estado >= 0){
            $update['bie_estado'] = $this->bie_estado;
        }
        if($this->bie_sed_id >= 0){
            $update['bie_sed_id'] = $this->bie_sed_id;
        }
        
        if($this->bie_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->bie_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

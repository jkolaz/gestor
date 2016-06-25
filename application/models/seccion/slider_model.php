<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of servicio_model
 *
 * @author Usuario
 */
class Slider_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $sli_id;
    public $sli_imagen;
    public $sli_estado;
    public $sli_sed_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_slider';
        self::$_PK = 'sli_id';
    }
    
    public function getAll($where = array()){
        $where['sli_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('sli_fecha_reg', 'desc')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_sli_imagen'])){
            $this->sli_imagen = $post['txt_sli_imagen'];
        }
        if(isset($post['txt_sliss_sed_id'])){
            $this->sli_sed_id = $post['txt_sli_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->sli_imagen != ""){
            $insert['sli_imagen'] = $this->sli_imagen;
        }
        if($this->sli_estado >= 0 && $this->sli_estado != ""){
            $insert['sli_estado'] = $this->sli_estado;
        }
        if($this->sli_sed_id >= 0 && $this->sli_sed_id != ""){
            $insert['sli_sed_id'] = $this->sli_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->sli_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->sli_id = $arreglo[0]->sli_id;
            $this->sli_imagen = $arreglo[0]->sli_imagen;
            $this->sli_estado = $arreglo[0]->sli_estado;
            $this->sli_sed_id = $arreglo[0]->sli_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->sli_imagen != ""){
            $update['sli_imagen'] = $this->sli_imagen;
        }
        if($this->sli_estado >= 0 || $this->sli_estado != ""){
            $update['sli_estado'] = $this->sli_estado;
        }
        if($this->sli_sed_id >= 0 || $this->sli_sed_id != ""){
            $update['sli_sed_id'] = $this->sli_sed_id;
        }
        
        if($this->sli_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->sli_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

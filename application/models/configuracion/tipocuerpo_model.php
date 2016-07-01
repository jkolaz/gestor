<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipocuerpo_model
 *
 * @author VMC-D02
 */
class Tipocuerpo_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $tc_id;
    public $tc_descripcion;
    public $tc_estado;
    public $tc_seccion;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_tipo_cuerpo';
        self::$_PK = 'tc_id';
    }
    
    public function getAll($where = array()){
        $where['tc_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('tc_descripcion')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_tc_descripcion'])){
            $this->tc_descripcion = $post['txt_tc_descripcion'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->tc_descripcion != ""){
            $insert['tc_descripcion'] = $this->tc_descripcion;
        }
        if($this->tc_estado >= 0){
            $insert['tc_estado'] = $this->tc_estado;
        }
        if($this->tc_seccion >= 0){
            $insert['tc_seccion'] = $this->tc_seccion;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->tc_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->tc_id = $arreglo[0]->tc_id;
            $this->tc_descripcion = $arreglo[0]->tc_descripcion;
            $this->tc_estado = $arreglo[0]->tc_estado;
            $this->tc_seccion = $arreglo[0]->tc_seccion;
        }
    }
    
    public function update(){
        $update = array();
        if($this->tc_descripcion != ""){
            $update['tc_descripcion'] = $this->tc_descripcion;
        }
        if($this->tc_estado >= 0 || $this->tc_estado != ""){
            $update['tc_estado'] = $this->tc_estado;
        }
        if($this->tc_seccion >= 0 || $this->tc_seccion != ""){
            $update['tc_seccion'] = $this->tc_seccion;
        }
        
        if($this->tc_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->tc_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function getCombo($seccion, $seleccionado = "",$where = array()){
        $arreglo = array();
        
        $where['tc_estado <='] = 1;
        $where['tc_seccion'] = $seccion;
        
        $query = $this->db->where($where)->order_by('tc_descripcion')->get(self::$_table);
        
        if($query->num_rows > 0){
            $arreglo = $query->result();
            foreach($query->result() as $index=>$value){
                $selected = '';
                if($seleccionado == $value->tc_id){
                    $selected = 'selected="selected"';
                }
                $arreglo[$index]->selected = $selected;
            }
        }
        return $arreglo;
    }
}

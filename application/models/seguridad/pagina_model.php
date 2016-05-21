<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pagina_model
 *
 * @author julio
 */
class Pagina_model extends CI_Model{
    //put your code here
    private static $_table = 'gc_pagina';
    private static $_PK = 'pag_id';
    public $pag_id;
    public $pag_nombre;
    public $pag_url;
    public $pag_icon;
    public $pag_estado;
    public $pag_mod_id;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAll($where = array()){
        $query = $this->db->where($where)->order_by('pag_nombre')
                            ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getRow($id){
        $where['pag_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->pag_id = $arreglo[0]->pag_id;
            $this->pag_nombre = $arreglo[0]->pag_nombre;
            $this->pag_url = $arreglo[0]->pag_url;
            $this->pag_icon = $arreglo[0]->pag_icon;
            $this->pag_estado = $arreglo[0]->pag_estado;
            $this->pag_mod_id = $arreglo[0]->pag_mod_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->pag_nombre != ""){
            $update['pag_nombre'] = $this->pag_nombre;
        }
        if($this->pag_url != ""){
            $update['pag_url'] = $this->pag_url;
        }
        if($this->pag_icon != ""){
            $update['pag_icon'] = $this->pag_icon;
        }
        if($this->pag_estado >= 0){
            $update['pag_estado'] = $this->pag_estado;
        }
        if($this->pag_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->pag_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_pag_nombre'])){
            $this->pag_nombre = $post['txt_pag_nombre'];
        }
        if(isset($post['txt_pag_url'])){
            $this->pag_url = $post['txt_pag_url'];
        }
        if(isset($post['txt_pag_icon'])){
            $this->pag_icon = $post['txt_pag_icon'];
        }
        if(isset($post['txt_pag_estado'])){
            $this->pag_estado = $post['txt_pag_estado'];
        }
        if(isset($post['txt_pag_mod_id'])){
            $this->pag_mod_id = $post['txt_pag_mod_id'];
        }
    }
    
    public function insert(){
        $insert = array();
        if($this->pag_nombre != ""){
            $insert['pag_nombre'] = $this->pag_nombre;
        }
        if($this->pag_url != ""){
            $insert['pag_url'] = $this->pag_url;
        }
        if($this->pag_icon != ""){
            $insert['pag_icon'] = $this->pag_icon;
        }
        if($this->pag_mod_id != ""){
            $insert['pag_mod_id'] = $this->pag_mod_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->pag_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
}

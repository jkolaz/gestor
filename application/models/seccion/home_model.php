<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home_model
 *
 * @author VMC-D02
 */
class Home_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $hom_id;
    public $hom_titulo;
    public $hom_visible;
    public $hom_imagen;
    public $hom_cod_video;
    public $hom_url;
    public $hom_estado;
    public $hom_sed_id;
    
    public function __construct() {
        parent::__construct();
        self::$_table = 'gc_home';
        self::$_PK = 'hom_id';
    }
    
    public function getAll($where = array()){
        $where['hom_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('hom_titulo')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_hom_titulo'])){
            $this->hom_titulo = $post['txt_hom_titulo'];
        }
        if(isset($post['txt_hom_visible'])){
            $this->hom_visible = $post['txt_hom_visible'];
        }
        if(isset($post['txt_hom_imagen'])){
            $this->hom_imagen = $post['txt_hom_imagen'];
        }
        if(isset($post['txt_hom_cod_video'])){
            $this->hom_cod_video = $post['txt_hom_cod_video'];
        }
        if(isset($post['txt_hom_url'])){
            $this->hom_url = $post['txt_hom_url'];
        }
        if(isset($post['txt_hom_sed_id'])){
            $this->hom_sed_id = $post['txt_hom_sed_id'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->hom_titulo != ""){
            $insert['hom_titulo'] = $this->hom_titulo;
        }
        if($this->hom_visible >= 0){
            if($this->hom_visible == ''){
                $this->hom_visible = 0;
            }
            $insert['hom_visible'] = $this->hom_visible;
        }
        if($this->hom_imagen != ""){
            $insert['hom_imagen'] = $this->hom_imagen;
        }
        if($this->hom_cod_video != ""){
            $insert['hom_cod_video'] = $this->hom_cod_video;
        }
        if($this->hom_url != ""){
            $insert['hom_url'] = $this->hom_url;
        }
        if($this->hom_estado >= 0){
            $insert['hom_estado'] = $this->hom_estado;
        }
        if($this->hom_sed_id >= 0){
            $insert['hom_sed_id'] = $this->hom_sed_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->hom_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['hom_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->hom_id = $arreglo[0]->hom_id;
            $this->hom_titulo = $arreglo[0]->hom_titulo;
            $this->hom_visible = $arreglo[0]->hom_visible;
            $this->hom_imagen = $arreglo[0]->hom_imagen;
            $this->hom_cod_video = $arreglo[0]->hom_cod_video;
            $this->hom_url = $arreglo[0]->hom_url;
            $this->hom_estado = $arreglo[0]->hom_estado;
            $this->hom_sed_id = $arreglo[0]->hom_sed_id;
        }
    }
    
    public function update(){
        $update = array();
        if($this->hom_titulo != ""){
            $update['hom_titulo'] = $this->hom_titulo;
        }
        if($this->hom_visible >= 0){
            $update['hom_visible'] = $this->hom_visible;
        }
        if($this->hom_imagen != ""){
            $update['hom_imagen'] = $this->hom_imagen;
        }
        if($this->hom_cod_video != ""){
            $update['hom_cod_video'] = $this->hom_cod_video;
        }
        if($this->hom_url != ""){
            $update['hom_url'] = $this->hom_url;
        }
        if($this->hom_estado >= 0){
            $update['hom_estado'] = $this->hom_estado;
        }
        if($this->hom_sed_id >= 0){
            $update['hom_sed_id'] = $this->hom_sed_id;
        }
        
        if($this->hom_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->hom_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of banner_model
 *
 * @author VMC-D02
 */
class Banner_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $ban_id;
    public $ban_img;
    public $ban_url;
    public $ban_tb_id;
    public $ban_estado;
    public $ban_sed_id;
    public $ban_view;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_banner';
        self::$_PK = 'ban_id';
    }
    
    public function getAll($where = array()){
        $where['ban_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('ban_id')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_ban_img'])){
            $this->ban_img = $post['txt_ban_img'];
        }
        if(isset($post['txt_ban_url'])){
            $this->ban_url = $post['txt_ban_url'];
        }
        if(isset($post['txt_ban_tb_id'])){
            $this->ban_tb_id = $post['txt_ban_tb_id'];
        }
        if(isset($post['txt_ban_sed_id'])){
            $this->ban_sed_id = $post['txt_ban_sed_id'];
        }
        if(isset($post['txt_ban_view'])){
            $this->ban_view = $post['txt_ban_view'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->ban_img != ""){
            $insert['ban_img'] = $this->ban_img;
        }
        if($this->ban_url != ""){
            $insert['ban_url'] = $this->ban_url;
        }
        if($this->ban_tb_id >= 0 && $this->ban_tb_id != ""){
            $insert['ban_tb_id'] = $this->ban_tb_id;
        }
        if($this->ban_estado >= 0 && $this->ban_estado != ""){
            $insert['ban_estado'] = $this->ban_estado;
        }
        if($this->ban_sed_id >= 0 && $this->ban_sed_id != ""){
            $insert['ban_sed_id'] = $this->ban_sed_id;
        }
        if($this->ban_view >= 0 && $this->ban_view != ""){
            $insert['ban_view'] = $this->ban_view;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->ban_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where[self::$_PK] = $id;
        $where['ban_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->ban_id = $arreglo[0]->ban_id;
            $this->ban_img = $arreglo[0]->ban_img;
            $this->ban_url = $arreglo[0]->ban_url;
            $this->ban_tb_id = $arreglo[0]->ban_tb_id;
            $this->ban_estado = $arreglo[0]->ban_estado;
            $this->ban_sed_id = $arreglo[0]->ban_sed_id;
            $this->ban_view = $arreglo[0]->ban_view;
        }
    }
    
    public function update(){
        $update = array();
        if($this->ban_img != ""){
            $update['ban_img'] = $this->ban_img;
        }
        if($this->ban_url != ""){
            $update['ban_url'] = $this->ban_url;
        }
        if($this->ban_tb_id >= 0 && $this->ban_tb_id != ""){
            $update['ban_tb_id'] = $this->ban_tb_id;
        }
        if($this->ban_estado >= 0 || $this->ban_estado != ""){
            $update['ban_estado'] = $this->ban_estado;
        }
        if($this->ban_sed_id >= 0 || $this->ban_sed_id != ""){
            $update['ban_sed_id'] = $this->ban_sed_id;
        }
        if($this->ban_view >= 0 || $this->ban_view != ""){
            $update['ban_view'] = $this->ban_view;
        }
        
        if($this->ban_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->ban_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

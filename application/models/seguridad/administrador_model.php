<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrador_model
 *
 * @author julio
 */
class Administrador_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK = 'adm_id';
    private static $_table1 = 'gc_tipo_admin';
    private static $_table2 = 'gc_sede';
    public $adm_id;
    public $adm_nombre;
    public $adm_correo;
    public $adm_password;
    public $adm_nick;
    public $adm_apellidos;
    public $adm_fecha_reg;
    public $adm_estado;
    public $adm_ta_id;
    public $adm_sed_id;
    
    public function __construct() {
        $this->load->database();
        self::$_table = 'gc_administrador';
    }
    
    public function validateUsuario($user, $clave){
        $where                  = array();
        $where['adm_nick']    = $user;
        $where['adm_password']  = md5($clave);
        $where['adm_estado']      = 1;
        
        $query = $this->db->where($where)
                ->join(self::$_table1, 'adm_ta_id=ta_id')
                ->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    public function getTipoAdmin(){
        $data = array();
        $query = $this->db->get(self::$_table1);
        if($query->num_rows > 0){
            foreach($query->result() as $id=>$value){
                $data[$id] = $value;
                $administradores = $this->getAdminByTipo($value->ta_id);
                $data[$id]->Administradores = $administradores;
            }
        }
        return $data;
    }
    
    public function getAdminByTipo($tipo){
        $return = array();
        $where = array();
        $where['adm_ta_id'] = $tipo;
        $query = $this->db->where($where)
                ->join(self::$_table2, 'sed_id=adm_sed_id', 'left')
                ->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            foreach ($arreglo as $id=>$valor){
                $icon_estado = 'fa-ban';
                if($valor->adm_estado == 1){
                    $icon_estado = 'fa-check';
                }
                $arreglo[$id]->icon_estado = $icon_estado;
            }
            return $query->result();
        }
        return $return;
    }
    
    public function getAdminById($id){
        $where = array();
        $where['adm_id'] = $id;
        $query = $this->db->where($where)
                ->get(self::$_table);
        if($query->num_rows > 0){
            $result = $query->result();
            return $result[0];
        }
        return NULL;
    }
    
    public function getRow($id){
        $where['adm_id'] = $id;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->adm_id = $arreglo[0]->adm_id;
            $this->adm_nombre = $arreglo[0]->adm_nombre;
            $this->adm_apellidos = $arreglo[0]->adm_apellidos;
            $this->adm_correo = $arreglo[0]->adm_correo;
            $this->adm_nick = $arreglo[0]->adm_correo;
            $this->adm_estado = $arreglo[0]->adm_estado;
            $this->adm_ta_id = $arreglo[0]->adm_ta_id;
            $this->adm_sed_id = $arreglo[0]->adm_sed_id;
        }
    }
    
    public function getValsForm($post){
        if(isset($post['txt_adm_nombre'])){
            $this->adm_nombre = $post['txt_adm_nombre'];
        }
        if(isset($post['txt_adm_apellidos'])){
            $this->adm_apellidos = $post['txt_adm_apellidos'];
        }
        if(isset($post['txt_adm_correo'])){
            $this->adm_correo = $post['txt_adm_correo'];
        }
        if(isset($post['txt_adm_nick'])){
            $this->adm_nick = $post['txt_adm_nick'];
        }
        if(isset($post['txt_adm_estado'])){
            $this->adm_estado = $post['txt_adm_estado'];
        }
        if(isset($post['txt_adm_ta_id'])){
            $this->adm_ta_id = $post['txt_adm_ta_id'];
        }
        if(isset($post['txt_adm_sed_id'])){
            $this->adm_sed_id = $post['txt_adm_sed_id'];
        }
        if(isset($post['txt_adm_password'])){
            $this->adm_password = md5($post['txt_adm_password']);
        }
    }
    
    public function insert(){
        $insert = array();
        if($this->adm_nombre != ""){
            $insert['adm_nombre'] = $this->adm_nombre;
        }
        if($this->adm_apellidos != ""){
            $insert['adm_apellidos'] = $this->adm_apellidos;
        }
        if($this->adm_correo != ""){
            $insert['adm_correo'] = $this->adm_correo;
        }
        if($this->adm_nick != ""){
            $insert['adm_nick'] = $this->adm_nick;
        }
        if($this->adm_password != ""){
            $insert['adm_password'] = $this->adm_password;
        }
        if($this->adm_estado > 0){
            $insert['adm_estado'] = $this->adm_estado;
        }
        if($this->adm_ta_id > 0){
            $insert['adm_ta_id'] = $this->adm_ta_id;
        }
        if($this->adm_sed_id > 0){
            $insert['adm_sed_id'] = $this->adm_sed_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->adm_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->adm_nombre != ""){
            $update['adm_nombre'] = $this->adm_nombre;
        }
        if($this->adm_apellidos != ""){
            $update['adm_apellidos'] = $this->adm_apellidos;
        }
        if($this->adm_correo != ""){
            $update['adm_correo'] = $this->adm_correo;
        }
        if($this->adm_nick != ""){
            $update['adm_nick'] = $this->adm_nick;
        }
        if($this->adm_password != ""){
            $update['adm_password'] = $this->adm_password;
        }
        if($this->adm_estado >= 0){
            $update['adm_estado'] = $this->adm_estado;
        }
        if($this->adm_ta_id >= 0){
            $update['adm_ta_id'] = $this->adm_ta_id;
        }
        if($this->adm_sed_id >= 0){
            $update['adm_sed_id'] = $this->adm_sed_id;
        }
        
        if($this->adm_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->adm_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function getCountAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
}

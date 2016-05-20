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
    private static $_table1 = 'gc_tipo_admin';
    private static $_table2 = 'gc_sede';
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
        $where = array();
        $where['adm_ta_id'] = $tipo;
        $query = $this->db->where($where)
                ->join(self::$_table2, 'sed_id=adm_sed_id', 'left')
                ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
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
}

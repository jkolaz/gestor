<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipoAdmin_model
 *
 * @author julio
 */
class tipoAdmin_model extends CI_Model{
    //put your code here
    
    private static $_table;
    public function __construct() {
        parent::__construct();
        self::$_table = 'gc_tipo_admin';        
    }
    
    public function getAllTipoAdmin(){
        $query = $this->db->order_by('ta_nombre')
                            ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
}

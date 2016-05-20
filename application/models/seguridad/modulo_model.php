<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modulo_model
 *
 * @author VMC-D02
 */
class Modulo_model extends CI_Model{
    //put your code here
    private static $_table = 'gc_modulo';
    private static $_PK = 'mod_id';
    public $mod_id;
    public $mod_nombre;
    public $mod_url;
    public $mod_icon;
    public $mod_estado;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getAll(){
        $where = array();
        $where['mod_estado'] = 1;
        $query = $this->db->where($where)->order_by('mod_nombre')
                            ->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
}

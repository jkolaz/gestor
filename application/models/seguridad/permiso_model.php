<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of permiso_model
 *
 * @author julio
 */
class Permiso_model extends CI_Model{
    //put your code here
    private static $_table = 'gc_permiso';
    private static $_PK = 'per_id';
    public $per_id;
    public $per_estado;
    public $per_crear;
    public $per_modificar;
    public $per_eliminar;
    public $per_pag_id;
    public $per_ta_id;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getPermisosByUser($id){
        $aResult = NULL;
        $sql = "select 
                    gc_pagina.pag_id,
                    gc_pagina.pag_nombre,
                    gc_modulo.mod_id,
                    gc_modulo.mod_nombre
                from
                    gc_administrador
                        inner join
                    gc_tipo_admin ON gc_administrador.adm_ta_id = gc_tipo_admin.ta_id
                        inner join
                    gc_permiso ON gc_tipo_admin.ta_id = gc_permiso.per_ta_id
                        inner join
                    gc_pagina ON gc_permiso.per_pag_id = gc_pagina.pag_id
                        inner join
                    gc_modulo ON gc_pagina.pag_mod_id = gc_modulo.mod_id
                where
                    gc_administrador.adm_id = {$id}
                        and gc_administrador.adm_estado = 1
                        and gc_tipo_admin.ta_estado = 1
                        and gc_permiso.per_estado = 1
                        and gc_pagina.pag_estado = 1
                        and gc_modulo.mod_estado = 1";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            $result = $query->result();
            $aModulo = array();
            foreach ($result as $value){
                $aModulo[] = $value->mod_id;
            }
            if(count($aModulo)>0){
                $aModulo = array_unique($aModulo);
                $sModulo = implode(', ', $aModulo);
                $objModulo = $this->getModulo($sModulo);
                if($objModulo){
                    foreach ($objModulo as $id=>$valor){
                        foreach ($result as $val){
                            if($valor->mod_id == $val->mod_id){
                                $std = new stdClass();
                                $std->pag_id = $val->pag_id;
                                $std->pag_nombre = $val->pag_nombre;
                                $objModulo[$id]->mod_paginas[] = $std;
                            }
                        }
                    }
                    $aResult = $objModulo;
                }
            }
        }
        return $aResult;
    }
    
    public function getModulo($ids){
        $sql = "select 
                    mod_id,
                    mod_nombre
                from
                    gc_modulo
                where
                    mod_id in ({$ids})";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
}

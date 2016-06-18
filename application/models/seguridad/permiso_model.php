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
    private static $_table;
    private static $_PK;
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
        self::$_table = 'gc_permiso';
        self::$_PK = 'per_id';
    }
    
    public function getPermisosByUser($id, $sede=0){
        $aResult = NULL;
        $sql = "select 
                    gc_pagina.pag_id,
                    gc_pagina.pag_nombre,
                    gc_pagina.pag_url,
                    gc_pagina.pag_icon,
                    gc_modulo.mod_id,
                    gc_modulo.mod_nombre,
                    gc_modulo.mod_url
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
                        and gc_modulo.mod_estado = 1
                order by gc_pagina.pag_nombre";
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
                $objModulo = $this->getModulo($sModulo, $sede);
                if($objModulo){
                    foreach ($objModulo as $id=>$valor){
                        foreach ($result as $val){
                            if($valor->mod_id == $val->mod_id){
                                $std = new stdClass();
                                $std->pag_id = $val->pag_id;
                                $std->pag_nombre = $val->pag_nombre;
                                $std->pag_url = $val->pag_url;
                                $std->pag_icon = $val->pag_icon;
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
    
    public function getModulo($ids, $sede = 0){
        $sql = "select 
                    mod_id,
                    mod_nombre,
                    mod_url,
                    mod_icon,
                    mod_is_need_sede
                from
                    gc_modulo
                where
                    mod_id in ({$ids}) and mod_is_need_sede = {$sede}";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getAllPagesAndModule($ta){
        $sql = "select 
                    gc_pagina.pag_id,
                    gc_pagina.pag_nombre,
                    gc_pagina.pag_url,
                    gc_pagina.pag_icon,
                    gc_modulo.mod_id,
                    gc_modulo.mod_nombre,
                    gc_modulo.mod_icon,
                    gc_modulo.mod_url,
                    if (((select count(gc_permiso.per_id) from gc_permiso where gc_permiso.per_pag_id=gc_pagina.pag_id and gc_permiso.per_ta_id={$ta} and gc_permiso.per_estado=1) >0), 'checked', '') as checked
                from
                    gc_pagina
                        inner join
                    gc_modulo ON gc_pagina.pag_mod_id = gc_modulo.mod_id
                where
                    gc_pagina.pag_estado = 1
                        and gc_modulo.mod_estado = 1
                order by gc_modulo.mod_nombre, gc_pagina.pag_nombre";
        
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
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
    
    public function getRow($id = 0, $where = array()){
        if($id > 0){
            $where['per_id'] = $id;
        }
        if(count($where) > 0){
            $this->db->where($where);
        }
        $query = $this->db->get(self::$_table, 1);
        
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->per_id = $arreglo[0]->per_id;
            $this->per_pag_id = $arreglo[0]->per_pag_id;
            $this->per_ta_id = $arreglo[0]->per_ta_id;
            $this->per_estado = $arreglo[0]->per_estado;
        }
    }
    
    public function insert(){
        $insert = array();
        if($this->per_estado >= 0){
            $insert['per_estado'] = $this->per_estado;
        }
        if($this->per_pag_id != ""){
            $insert['per_pag_id'] = $this->per_pag_id;
        }
        if($this->per_ta_id != ""){
            $insert['per_ta_id'] = $this->per_ta_id;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->per_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->per_estado >= 0){
            $update['per_estado'] = $this->per_estado;
        }
        if($this->per_pag_id != ""){
            $update['per_pag_id'] = $this->per_pag_id;
        }
        if($this->per_ta_id != ""){
            $update['per_ta_id'] = $this->per_ta_id;
        }
        if($this->per_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->per_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

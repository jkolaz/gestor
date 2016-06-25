<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuweb_model
 *
 * @author VMC-D02
 */
class Menuweb_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $mw_id;
    public $mw_men_id;
    public $mw_sed_id;
    public $mw_estado;
    public $mw_imagen;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_menu_web';
        self::$_PK = 'mw_id';
    }
    
    public function getRow($id = 0, $where = array()){
        if($id > 0){
            $where['mw_id'] = $id;
        }
        if(count($where) > 0){
            $this->db->where($where);
        }
        $query = $this->db->get(self::$_table, 1);
        
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->mw_id = $arreglo[0]->mw_id;
            $this->mw_sed_id = $arreglo[0]->mw_sed_id;
            $this->mw_men_id = $arreglo[0]->mw_men_id;
            $this->mw_estado = $arreglo[0]->mw_estado;
            $this->mw_imagen = $arreglo[0]->mw_imagen;
        }
    }
    
    public function getCountAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->from(self::$_table)->count_all_results();
        return $query;
    }
    
    public function getAll($where = array()){
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $query = $this->db->get(self::$_table);
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function insert(){
        $insert = array();
        if($this->mw_estado != ""){
            $insert['mw_estado'] = $this->mw_estado;
        }
        if($this->mw_men_id != ""){
            $insert['mw_men_id'] = $this->mw_men_id;
        }
        if($this->mw_sed_id != ""){
            $insert['mw_sed_id'] = $this->mw_sed_id;
        }
        if($this->mw_imagen != ""){
            $insert['mw_imagen'] = $this->mw_imagen;
        }
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->mw_id = $this->db->insert_id();
            return TRUE;
        }
        return NULL;
    }
    
    public function update(){
        $update = array();
        if($this->mw_estado != ""){
            $update['mw_estado'] = $this->mw_estado;
        }
        if($this->mw_men_id != ""){
            $update['mw_men_id'] = $this->mw_men_id;
        }
        if($this->mw_sed_id != ""){
            $update['mw_sed_id'] = $this->mw_sed_id;
        }
        if($this->mw_imagen != ""){
            $update['mw_imagen'] = $this->mw_imagen;
        }
        if($this->mw_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->mw_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
    
    public function getPermiso($sede, $padre){
        $sql = "SELECT 
                    gc_menu.men_id,
                    gc_menu.men_nombre,
                    gc_menu.men_ruta,
                    if(((select count(gc_menu_web.mw_id) from gc_menu_web where gc_menu_web.mw_men_id=gc_menu.men_id and gc_menu_web.mw_sed_id={$sede} and gc_menu_web.mw_estado=1) >0), 'checked', '') as 'checked',
                    (select gc_menu_web.mw_imagen from gc_menu_web where gc_menu_web.mw_men_id=gc_menu.men_id and gc_menu_web.mw_sed_id={$sede}) as imagen,
                    (select gc_menu_web.mw_id from gc_menu_web where gc_menu_web.mw_men_id=gc_menu.men_id and gc_menu_web.mw_sed_id={$sede}) as id_permiso
                FROM gc_menu
                where 
                    gc_menu.men_estado = 1
                    and gc_menu.men_padre = {$padre}
                order by gc_menu.men_nombre";
        $query = $this->db->query($sql);
        if ($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getUrlPermitidas($sede,$permitidos = array(), $value = ""){
        $arreglo = array();
        $aPadre = array();
        $where['mw_estado'] = 1;
        $where['men_estado'] = 1;
        $where['mw_sed_id'] = $sede;
        if(count($permitidos) > 0){
            $this->db->where_in('men_padre', $permitidos);
        }
        $firstQuery = $this->db->where($where)
                        ->join('gc_menu', 'gc_menu.men_id=gc_menu_web.mw_men_id')
                        ->get(self::$_table);
        if($firstQuery->num_rows > 0){
            foreach ($firstQuery->result() as $menu){
                $aPadre[] = $menu->men_padre;
            }
        }
        $aPadre = array_unique($aPadre);
        if(count($aPadre) > 0){
            $where2['men_estado'] = 1;
            $secondQuery = $this->db->where($where2)
                                ->where_in('men_id', $aPadre)
                                ->get('gc_menu');
            if($secondQuery->num_rows > 0){
                foreach ($secondQuery->result() as $id=>$padre){
                    $arreglo[$id] = $padre;
                    foreach ($firstQuery->result() as $hijo){
                        $selected = '';
                        if($hijo->men_ruta == $value){
                            $selected = 'selected="selected"';
                        }
                        $hijo->selected = $selected;
                        if($padre->men_id == $hijo->men_padre){
                            $arreglo[$id]->sub_menu[] = $hijo;
                        }
                    }
                }
            }
        }
        return $arreglo;
    }
    
    public function getImageByMenu($menu, $sede){
        $archivo = '';
        $where['mw_men_id'] = $menu;
        $where['mw_sed_id'] = $sede;
        $query = $this->db->where($where)->get(self::$_table, 1);
        if($query->num_rows > 0){
            $result = $query->result();
            $archivo = $result[0]->mw_imagen;
        }
        
        return $archivo;
    }
}

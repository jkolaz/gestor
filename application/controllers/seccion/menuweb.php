<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuweb
 *
 * @author VMC-D02
 */
class Menuweb extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/menuweb_model', 'menuweb');
        $this->load->model('configuracion/menu_model', 'menu');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    public function index($sede = 0){
        if($sede == 0){
            $sede = $this->session->userdata('sede');
        }
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['men_padre'] = 0;
            $objMenu = $this->menu->getAll($where);
            if($objMenu){
                foreach ($objMenu as $id=>$valor){
                    $objSubMenu = $this->menuweb->getPermiso($sede, $valor->men_id);
                    $objMenu[$id]->men_submenu = $objSubMenu;
                }
            }
            $this->smartyci->assign("listado", 'Menú - '.$this->sede->sed_nombre);
            $this->smartyci->assign("form", 1);
            $this->smartyci->assign('objMenu', $objMenu);
            $this->smartyci->assign('nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('id', $this->sede->sed_id);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('configuracion/sede/index');
        }
    }
    
    public function nuevo(){
        $sede = $this->input->post('sede');
        $menu = $this->input->post('menu');
        $estado = $this->input->post('estado');
        $this->sede->getSedeById($sede);
        $this->menu->getRow($menu);
        $respuesta = 0;
        $where = array();
        $where['mw_sed_id'] = $sede;
        $where['mw_men_id'] = $menu;
        $cant = $this->menuweb->getCountAll($where);
        if($cant > 0){
            $this->menuweb->getRow(0, $where);
            if($this->menuweb->mw_id > 0){
                $this->menuweb->mw_estado = $estado;
                $this->menuweb->update();
                $this->writeLog("Modificó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
                $respuesta = 1;
            }
        }else{
            $this->menuweb->mw_men_id = $menu;
            $this->menuweb->mw_sed_id = $sede;
            $this->menuweb->mw_estado = $estado;
            $this->menuweb->insert();
            $this->writeLog("Agregó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
            $respuesta = 1;
        }
        echo json_encode(array('respuesta'=>$respuesta));
    }
}

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
        $this->load->model('configuracion/menuweb_model', 'menuweb');
        $this->load->model('configuracion/menu_model', 'menu');
    }
    public function index($sede){
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
//            imprimir($objMenu);exit;
            $this->smartyci->assign("listado", 'Menú - '.$this->sede->sed_nombre);
            $this->smartyci->assign("form", 1);
            $this->smartyci->assign('objMenu', $objMenu);
            $this->smartyci->assign('nombre', $this->sede->sed_nombre);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('configuracion/sede/index');
        }
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of principal
 *
 * @author julio
 */
class Principal extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/menu_model', 'menu');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        if($sede > 0){
            $objeto = $this->menu->getMenuPermiso($sede);
            $this->smartyci->assign('objMenu', $objeto);
            $this->smartyci->show_page('seguridad/principal_menu.tpl', uniqid());
        }else{
            $this->smartyci->show_page(NULL,  uniqid());
        }
    }
}

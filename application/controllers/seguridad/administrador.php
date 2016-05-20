<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrador
 *
 * @author julio
 */
class Administrador extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('seguridad/administrador_model', 'adm');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_PANEL);
        }
        $objTipoAdmin = $this->adm->getTipoAdmin();
        $this->smartyci->assign('objTipoAdmin', $objTipoAdmin);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
}

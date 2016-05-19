<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seccion
 *
 * @author julio
 */
class Seccion extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->smartyci->assign('listado', 'Sedes');
        //$this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_PANEL);
        }
        $this->smartyci->show_page(NULL,  uniqid());
    }
}

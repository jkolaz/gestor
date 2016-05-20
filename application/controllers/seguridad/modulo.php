<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modulo
 *
 * @author VMC-D02
 */
class Modulo extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->smartyci->assign('listado', 'Módulos del sistema');
        $this->load->model('seguridad/modulo_model', 'modulo');
    }
    
    public function index(){
        $objModulo = $this->mosulo->getAll();
        $this->smartyci->assign('modulo', $objModulo);
        $this->smartyci->show_page(NULL);
    }
}

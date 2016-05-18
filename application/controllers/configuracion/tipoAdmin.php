<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tipoAdmin
 *
 * @author julio
 */
class TipoAdmin extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/tipoAdmin_model', 'TA');
    }
    public function index(){
        $obTA = $this->TA->getAllTipoAdmin();
        $this->smartyci->assign('objTA', $obTA);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function nuevo(){
        
    }
    
    public function editar($id){
        if(isset($_POST['txt_action']) && $_POST['txt_action'] == 'editar'){
            imprimir($_POST);
            exit;
        }
        $this->smartyci->assign('ID', $id);
        $this->smartyci->show_page(NULL,  uniqid());
    }
}

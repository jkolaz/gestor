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
        $this->load->model('seguridad/tipoadmin_model', 'TA');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    public function index(){
        $obTA = $this->TA->getAllTipoAdmin();
        $this->smartyci->assign('objTA', $obTA);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function nuevo(){
        
    }
    
    public function editar($id){
        $this->TA->getTAById($id);
        if(isset($_POST['txt_action']) && $_POST['txt_action'] == 'editar'){
            $this->TA->getValsForm($_POST);
            $this->TA->update();
            $this->writeLog("Editó el tipo de administrador {$this->TA->ta_nombre}(id::{$this->TA->ta_id})");
            redirect('seguridad/tipoAdmin/index');
        }
        $this->smartyci->assign('ID', $id);
        $this->smartyci->assign('TA', $this->TA);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function eliminar($id){
        $this->TA->getTAById($id);
        $this->TA->ta_estado = 2;
        $this->TA->update();
        $this->writeLog("Eliminó el tipo de administrador {$this->TA->ta_nombre}(id::{$this->TA->ta_id})");
        redirect('seguridad/tipoAdmin/index');
    }
}

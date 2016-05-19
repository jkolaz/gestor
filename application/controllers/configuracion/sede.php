<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sede
 *
 * @author julio
 */
class Sede extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->smartyci->assign('listado', 'Sedes');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_PANEL);
        }
        $objSede = $this->sede->getAllSede();
        $this->smartyci->assign('objSede', $objSede);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function editar($id){
        $this->sede->getSedeById($id);
        if(isset($_POST['txt_action']) && $_POST['txt_action'] == 'editar'){
            $this->sede->getValsForm($_POST);
            $this->sede->update();
            $this->writeLog("Editó la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id})");
            redirect('configuracion/sede/index');
        }else{
            $this->smartyci->assign('sede', $this->sede);
            $this->smartyci->assign('ID', $id);
            $this->smartyci->show_page(NULL,  uniqid());
        }
    }
    public function eliminar($id){
        $this->sede->getSedeById($id);
        $this->sede->sed_estado = 2;
        $this->sede->update();
        $this->writeLog("Eliminó la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id})");
        redirect('configuracion/sede/index');
    }
}

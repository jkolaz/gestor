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
        $this->load->model('configuracion/seccion_model', 'seccion');
        $this->smartyci->assign('listado', 'Secciones');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_PANEL);
        }
        $objSeccion = $this->seccion->getAllSeccion();
        $this->smartyci->assign('objSeccion', $objSeccion);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function editar($id){
        $this->seccion->getSeccionById($id);
        if(isset($_POST['txt_action']) && $_POST['txt_action'] == 'editar'){
            $this->seccion->getValsForm($_POST);
            $this->seccion->update();
            $this->writeLog("Editó la seccion {$this->seccion->sec_nombre}(id::{$this->seccion->sec_id})");
            redirect('configuracion/seccion/index');
        }else{
            $this->smartyci->assign('seccion', $this->seccion);
            $this->smartyci->assign('ID', $id);
            $this->smartyci->show_page(NULL,  uniqid());
        }
    }
    
    public function eliminar($id){
        $this->seccion->getSeccionById($id);
        $this->seccion->sec_estado = 2;
        $this->seccion->update();
        $this->writeLog("Eliminó la seccion {$this->seccion->sec_nombre}(id::{$this->seccion->sec_id})");
        redirect('configuracion/seccion/index');
    }
}

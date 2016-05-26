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
        $this->load->model('seguridad/tipoadmin_model', 'ta');
        $this->load->model('configuracion/sede_model', 'sede');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_PANEL);
        }
        $objTipoAdmin = $this->adm->getTipoAdmin();
        $this->smartyci->assign('objTipoAdmin', $objTipoAdmin);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function nuevo($ta){
        $this->ta->getTAById($ta);
        if($this->ta->ta_id > 0){
            $action = $this->input->post('txt_action');
            if($action){
                $this->adm->getValsForm($this->input->post());
                $this->adm->insert();
                $this->writeLog("Registró el administrador {$this->adm->adm_nombre}(id::{$this->adm->adm_id})");
                redirect('seguridad/administrador/index');
            }else{
                $objSede = $this->sede->getAllSede();
                $this->smartyci->assign('form', 1);
                $this->smartyci->assign('ta_nombre', $this->ta->ta_nombre);
                $this->smartyci->assign('ta', $this->ta->ta_id);
                $this->smartyci->assign('sede', $objSede);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }else{
            redirect($this->_carpeta.'/'.$this->_class.'/index');
        }
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->adm->getRow($id);
            if($this->adm->adm_id > 0){
                if($this->adm->adm_estado == 1){
                    $this->adm->adm_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->adm->adm_estado = 1;
                    $icon = 'fa-check';
                }
                $this->adm->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    
}

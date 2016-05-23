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
        if($obTA){
            foreach ($obTA as $id=>$value){
                $icon_estado = 'fa-ban';
                if($value->ta_estado == 1){
                    $icon_estado = 'fa-check';
                }
                $obTA[$id]->icon_estado = $icon_estado;
            }
        }
        $this->smartyci->assign('objTA', $obTA);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function nuevo(){
        $action = $this->input->post('txt_action');
        if(isset($action) && $action == 'nuevo'){
            $this->TA->getValsForm($this->input->post());
            $this->TA->insert();
            $this->writeLog("Registró el tipo de administrador {$this->TA->ta_nombre}(id::{$this->TA->ta_id})");
            redirect('seguridad/tipoAdmin/index');
        }
        $this->smartyci->show_page(NULL, uniqid());
    }
    
    public function editar($id){
        $this->TA->getTAById($id);
        $action = $this->input->post('txt_action');
        if(isset($action) && $action == 'editar'){
            $this->TA->getValsForm($this->input->post());
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
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->TA->getTAById($id);
            if($this->TA->ta_id > 0){
                if($this->TA->ta_estado == 1){
                    $this->TA->ta_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->TA->ta_estado = 1;
                    $icon = 'fa-check';
                }
                $this->TA->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

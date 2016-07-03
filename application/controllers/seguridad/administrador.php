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
                $where['adm_nick'] = $this->adm->adm_nick;
                if($this->adm->getCountAll($where) > 0){
                    $this->session->set_userdata('message_id', 3);
                    $this->session->set_userdata('message', 'WRM2');
                    redirect('seguridad/administrador/nuevo/'.$ta);
                }
                if($this->adm->insert()){
                    $this->writeLog("Registró el administrador {$this->adm->adm_nombre}(id::{$this->adm->adm_id})");
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    redirect('seguridad/administrador/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seguridad/administrador/nuevo/'.$ta);
                }
            }else{
                $objSede = $this->sede->getAllSede();
                $this->smartyci->assign('form', 1);
                $this->smartyci->assign('ta_nombre', $this->ta->ta_nombre);
                $this->smartyci->assign('ta', $this->ta->ta_id);
                $this->smartyci->assign('objSede', $objSede);
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
    
    public function editar($id = 0){
        $rol = $this->session->userdata('idRol');
        if($rol == 1){
            $this->adm->getRow($id);
            if($this->adm->adm_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == "editar"){
                    $this->adm->getValsForm($this->input->post());
                    if($this->adm->update()){
                        $this->writeLog("Editó el administrador {$this->adm->adm_nombre}(id::{$this->adm->adm_id})");
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        redirect('seguridad/administrador/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seguridad/administrador/editar/'.$id);
                    }
                }else{
                    $objSede = $this->sede->getAllSede();
                    if($objSede){
                        foreach($objSede as $id=>$value){
                            $selected = '';
                            if($value->sed_id == $this->adm->adm_sed_id){
                                $selected = 'selected="selected"';
                            }
                            $objSede[$id]->selected = $selected;
                        }
                    }
                    $this->smartyci->assign('objSede', $objSede);
                    $this->smartyci->assign('stdAdm', $this->adm);
                    $this->smartyci->assign('listado', 'Editar Administrador');
                    $this->smartyci->assign('details', 'Administradores');
                    $this->smartyci->assign('url_back', 'seguridad/administrador/index');
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                $this->session->set_userdata('message_id', 2);
                $this->session->set_userdata('message', 'ERR2');
                redirect('seguridad/administrador/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
    
}

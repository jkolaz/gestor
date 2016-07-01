<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fundador
 *
 * @author VMC-D02
 */
class Saludsocial extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/saludsocial_model', 'salud_social');
        $this->load->model('configuracion/tipocuerpo_model', 'tipo_cuerpo');
        $this->smartyci->assign('listado', 'Salud y Social');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['ss_sed_id'] = $sede;
            $obj = $this->salud_social->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $presentacion = '';
                    if($value->ss_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $this->tipo_cuerpo->getRow($value->ss_tc_id);
                    if($this->tipo_cuerpo->tc_id > 0){
                        $presentacion = $this->tipo_cuerpo->tc_descripcion;
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                    $obj[$id]->presentacion = $presentacion;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objSS', $obj);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
    
    public function nuevo(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $action = $this->input->post('txt_action');
            if(isset($action) && $action == 'nuevo'){
                $max = $this->salud_social->max();
                $this->salud_social->getValsForm($this->input->post());
                $this->salud_social->ss_sed_id = $sede;
                $this->salud_social->ss_estado = 0;
                $this->salud_social->ss_imagen = guardar_archivo('txt_ss_imagen', $_FILES, 'ss_');
                $this->salud_social->ss_orden = $max+1;
                if($this->salud_social->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró Salud y Social {$this->salud_social->ss_nombre} (id::{$this->salud_social->ss_id})");
                    redirect('seccion/saludsocial/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/saludsocial/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Salud y Social');
                $this->smartyci->assign('url_back', 'seccion/saludsocial/index');
                
                $objTC = $this->tipo_cuerpo->getCombo(1);
                $this->smartyci->assign('objTC', $objTC);
                $this->smartyci->assign('form', 1);
                $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->salud_social->getRow($id);
            if($this->salud_social->ss_id > 0){
                if($this->salud_social->ss_estado == 1){
                    $this->salud_social->ss_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->salud_social->ss_estado = 1;
                    $icon = 'fa-check';
                }
                $this->salud_social->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->salud_social->getRow($id);
            if($this->salud_social->ss_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->salud_social->getValsForm($this->input->post());
                    $this->salud_social->ss_imagen = guardar_archivo('txt_ss_imagen', $_FILES, 'ss_', $this->salud_social->ss_imagen);
                    if($this->salud_social->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó Salud y Social {$this->salud_social->ss_nombre}(id::{$this->salud_social->ss_id})");
                        redirect('seccion/saludsocial/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/saludsocial/editar/'.$id);
                    }
                }else{
                    $objTC = $this->tipo_cuerpo->getCombo(1, $this->salud_social->ss_tc_id);
                    $this->smartyci->assign('objTC', $objTC);
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdSS', $this->salud_social);
                    $this->smartyci->assign('details', 'Salud y Social');
                    $this->smartyci->assign('url_back', 'seccion/saludsocial/index');
                    $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/saludsocial/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

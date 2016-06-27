<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of centro
 *
 * @author Usuario
 */
class Presentacion extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/presentacion_model', 'presentacion');
        $this->smartyci->assign('listado', 'Presentación');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['pre_sed_id'] = $sede;
            $obj = $this->presentacion->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->pre_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objPresentacion', $obj);
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
                $this->presentacion->getValsForm($this->input->post());
                $this->presentacion->pre_sed_id = $sede;
                $this->presentacion->pre_estado = 0;
                if($this->presentacion->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró Presentación (id::{$this->presentacion->pre_id})");
                    redirect('seccion/presentacion/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/presentacion/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Presentación');
                $this->smartyci->assign('url_back', 'seccion/presentacion/index');
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
            $this->presentacion->getRow($id);
            if($this->presentacion->pre_id > 0){
                if($this->presentacion->pre_estado == 1){
                    $this->presentacion->pre_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->presentacion->pre_estado = 1;
                    $icon = 'fa-check';
                }
                $this->presentacion->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->presentacion->getRow($id);
            if($this->presentacion->pre_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->presentacion->getValsForm($this->input->post());
                    if($this->presentacion->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó presentación (id::{$this->presentacion->pre_id})");
                        redirect('seccion/presentacion/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/presentacion/editar/'.$id);
                    }
                }else{
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdPresentacion', $this->presentacion);
                    $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/presentacion/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

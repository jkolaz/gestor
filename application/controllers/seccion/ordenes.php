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
class Ordenes extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/ordenes_model', 'ordenes');
        $this->load->model('configuracion/tipocuerpo_model', 'tipo_cuerpo');
        $this->smartyci->assign('listado', 'Ordenes Hospitalarias');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['ord_sed_id'] = $sede;
            $obj = $this->ordenes->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $presentacion = '';
                    if($value->ord_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $this->tipo_cuerpo->getRow($value->ord_tc_id);
                    if($this->tipo_cuerpo->tc_id > 0){
                        $presentacion = $this->tipo_cuerpo->tc_descripcion;
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                    $obj[$id]->presentacion = $presentacion;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objOrdenes', $obj);
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
                $this->ordenes->getValsForm($this->input->post());
                $this->ordenes->ord_sed_id = $sede;
                $this->ordenes->ord_estado = 0;
                $this->ordenes->ord_imagen = guardar_archivo('txt_ord_imagen', $_FILES, 'ordenes_');
                if($this->ordenes->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró ordén hospitalaria {$this->ordenes->ord_nombre} (id::{$this->ordenes->ord_id})");
                    redirect('seccion/ordenes/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/ordenes/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Ordenes Hospitalarias');
                $this->smartyci->assign('url_back', 'seccion/ordenes/index');
                
                $objTC = $this->tipo_cuerpo->getCombo();
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
            $this->ordenes->getRow($id);
            if($this->ordenes->ord_id > 0){
                if($this->ordenes->ord_estado == 1){
                    $this->ordenes->ord_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->ordenes->ord_estado = 1;
                    $icon = 'fa-check';
                }
                $this->ordenes->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->ordenes->getRow($id);
            if($this->ordenes->ord_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->ordenes->getValsForm($this->input->post());
                    $this->ordenes->ord_imagen = guardar_archivo('txt_ord_imagen', $_FILES, 'ordenes_', $this->ordenes->ord_imagen);
                    if($this->ordenes->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó ordén hospitalaria {$this->ordenes->ord_nombre}(id::{$this->ordenes->ord_id})");
                        redirect('seccion/ordenes/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/ordenes/editar/'.$id);
                    }
                }else{
                    $objTC = $this->tipo_cuerpo->getCombo($this->ordenes->ord_tc_id);
                    $this->smartyci->assign('objTC', $objTC);
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdOrdenes', $this->ordenes);
                    $this->smartyci->assign('details', 'Ordenes Hospitalarias');
                    $this->smartyci->assign('url_back', 'seccion/ordenes/index');
                    $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/ordenes/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

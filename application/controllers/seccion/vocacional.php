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
class Vocacional extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/vocacional_model', 'vocacional');
        $this->load->model('configuracion/tipocuerpo_model', 'tipo_cuerpo');
        $this->smartyci->assign('listado', 'Salud y Social');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['voc_sed_id'] = $sede;
            $obj = $this->vocacional->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $presentacion = '';
                    if($value->voc_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $this->tipo_cuerpo->getRow($value->voc_tc_id);
                    if($this->tipo_cuerpo->tc_id > 0){
                        $presentacion = $this->tipo_cuerpo->tc_descripcion;
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                    $obj[$id]->presentacion = $presentacion;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objVocacional', $obj);
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
                $this->vocacional->getValsForm($this->input->post());
                $this->vocacional->voc_sed_id = $sede;
                $this->vocacional->voc_estado = 0;
                $this->vocacional->voc_imagen = guardar_archivo('txt_voc_imagen', $_FILES, 'vocacional_');
                if($this->vocacional->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró Vocacional {$this->vocacional->voc_nombre} (id::{$this->vocacional->voc_id})");
                    redirect('seccion/vocacional/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/vocacional/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Vocacional');
                $this->smartyci->assign('url_back', 'seccion/vocacional/index');
                
                $objTC = $this->tipo_cuerpo->getCombo(2);
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
            $this->vocacional->getRow($id);
            if($this->vocacional->voc_id > 0){
                if($this->vocacional->voc_estado == 1){
                    $this->vocacional->voc_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->vocacional->voc_estado = 1;
                    $icon = 'fa-check';
                }
                $this->vocacional->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->vocacional->getRow($id);
            if($this->vocacional->voc_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->vocacional->getValsForm($this->input->post());
                    $this->vocacional->voc_imagen = guardar_archivo('txt_voc_imagen', $_FILES, 'vocacional_', $this->vocacional->voc_imagen);
                    if($this->vocacional->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó Vocacional {$this->vocacional->voc_nombre}(id::{$this->vocacional->voc_id})");
                        redirect('seccion/vocacional/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/vocacional/editar/'.$id);
                    }
                }else{
                    $objTC = $this->tipo_cuerpo->getCombo(2, $this->vocacional->voc_tc_id);
                    $this->smartyci->assign('objTC', $objTC);
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdVocacional', $this->vocacional);
                    $this->smartyci->assign('details', 'Vocacional');
                    $this->smartyci->assign('url_back', 'seccion/vocacional/index');
                    $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/vocacional/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

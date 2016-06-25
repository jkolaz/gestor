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
class Slider extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/slider_model', 'slider');
        $this->smartyci->assign('listado', 'Slider');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['sli_sed_id'] = $sede;
            $obj = $this->slider->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->sli_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objSlider', $obj);
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
                $this->slider->sli_sed_id = $sede;
                if(isset($_FILES["txt_sli_imagen"]["name"]) && $_FILES["txt_sli_imagen"]["name"] != ""){
                    if ((($_FILES["txt_sli_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_sli_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_sli_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_sli_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_sli_imagen"]["name"]);
                                $destination = uniqid('slider_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_sli_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->slider->sli_imagen = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/slider/nuevo');
                    }
                }
                if($this->slider->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registro Slider {$this->slider->sli_imagen} (id::{$this->slider->sli_id})");
                    redirect('seccion/slider/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/slider/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Slider');
                $this->smartyci->assign('url_back', 'seccion/slider/index');
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
            $this->slider->getRow($id);
            if($this->slider->sli_id > 0){
                if($this->slider->sli_estado == 1){
                    $this->slider->sli_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->slider->sli_estado = 1;
                    $icon = 'fa-check';
                }
                $this->slider->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->slider->getRow($id);
            if($this->slider->sli_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    if(isset($_FILES["txt_sli_imagen"]["name"]) && $_FILES["txt_sli_imagen"]["name"] != ""){
                        if ((($_FILES["txt_sli_imagen"]["type"] == "image/png")
                            || ($_FILES["txt_sli_imagen"]["type"] == "image/jpeg")
                            || ($_FILES["txt_sli_imagen"]["type"] == "image/jpg"))) {
                                if(!is_array($_FILES["txt_sli_imagen"]["name"])){
                                    $extension = pathinfo($_FILES["txt_sli_imagen"]["name"]);
                                    $destination = uniqid('slider_').'.'.$extension['extension'];
                                    if(move_uploaded_file($_FILES['txt_sli_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                        unlink(PATH_GALLERY.$this->convocatoria->sli_imagen);
                                        $this->slider->sli_imagen = $destination;
                                    }
                                }else{
                                    $this->session->set_userdata('message_id', 2);
                                    $this->session->set_userdata('message', 'ERR4');
                                }
                        }else{
                            $this->session->set_userdata('message_id', 3);
                            $this->session->set_userdata('message', 'ERR3');
                            redirect('seccion/slider/editar/'.$id);
                        }
                    }
                    if($this->slider->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó slider {$this->slider->sli_imagen} (id::{$this->slider->sli_id})");
                        redirect('seccion/slider/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/slider/editar/'.$id);
                    }
                }else{
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdSlider', $this->slider);
                    $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/slider/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

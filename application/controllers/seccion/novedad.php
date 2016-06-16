<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of novedad
 *
 * @author julio
 */
class Novedad extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('seccion/novedad_model', 'novedad');
        $this->load->model('configuracion/sede_model', 'sede');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Novedades');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['nov_sed_id'] = $this->sede->sed_id;
            $objNovedad = $this->novedad->getAll($where);
            if($objNovedad){
                foreach ($objNovedad as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $icon_destacado = 'fa-star-o';
                    if($value->nov_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    if($value->nov_destacada == 1){
                        $icon_destacado = 'fa-star';
                    }
                    $objNovedad[$id]->icon_destacado = $icon_destacado;
                    $objNovedad[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('objNovedad', $objNovedad);
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
                $this->novedad->getValsForm($this->input->post());
                $this->novedad->nov_sed_id = $this->sede->sed_id;
                $this->novedad->nov_estado = 0;
                $this->novedad->nov_destacada = 0;
                if(isset($_FILES["txt_nov_imagen"]["name"]) && $_FILES["txt_nov_imagen"]["name"] != ""){
                    if ((($_FILES["txt_nov_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_nov_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_nov_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_nov_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_nov_imagen"]["name"]);
                                $destination = uniqid('novedad_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_nov_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->novedad->nov_imagen = $destination;
                                }
                            }
                        }
                }
                if($this->novedad->insert()){
                    $this->writeLog("Registro novedad (id::{$this->novedad->nov_id})");
                    redirect('seccion/novedad/index');
                }else{
                    redirect('seccion/novedad/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Novedades');
                $this->smartyci->assign('url_back', 'seccion/novedad/index');
                $this->smartyci->assign('form', 1);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
    
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->novedad->getRow($id);
            if($this->novedad->nov_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->novedad->getValsForm($this->input->post());
                    if(isset($_FILES["txt_nov_imagen"]["name"]) && $_FILES["txt_nov_imagen"]["name"] != ""){
                        if ((($_FILES["txt_nov_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_nov_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_nov_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_nov_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_nov_imagen"]["name"]);
                                $destination = uniqid('novedad_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_nov_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->novedad->nov_imagen = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                        }else{
                            $this->session->set_userdata('message_id', 3);
                            $this->session->set_userdata('message', 'ERR3');
                        }
                    }
                    $this->novedad->update();
                    $this->writeLog("Editó novedad (id::{$this->novedad->nov_id})");
                    redirect('seccion/novedad/index');
                }else{
                    $this->smartyci->assign('details', 'Novedades');
                    $this->smartyci->assign('url_back', 'seccion/novedad/index');
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $this->novedad->nov_id);
                    $this->smartyci->assign('stdNovedad', $this->novedad);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/novedad/index');
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
            $this->novedad->getRow($id);
            if($this->novedad->nov_id > 0){
                if($this->novedad->nov_estado == 1){
                    $this->novedad->nov_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->novedad->nov_estado = 1;
                    $icon = 'fa-check';
                }
                $this->novedad->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function changeDestacado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->novedad->getRow($id);
            if($this->novedad->nov_id > 0){
                if($this->novedad->nov_destacada == 1){
                    $this->novedad->nov_destacada = 0;
                    $icon = 'fa-star-o';
                }else{
                    $this->novedad->nov_destacada = 1;
                    $icon = 'fa-star';
                }
                $this->novedad->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

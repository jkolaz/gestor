<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of evento
 *
 * @author julio
 */
class Evento extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('seccion/evento_model', 'evento');
        $this->load->model('configuracion/sede_model', 'sede');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Eventos');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['eve_sed_id'] = $this->sede->sed_id;
            $objEvento = $this->evento->getAll($where);
            if($objEvento){
                foreach ($objEvento as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->eve_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $objEvento[$id]->icon_estado = $icon_estado;
                    $objEvento[$id]->eve_fecha = date('Y-m-d', strtotime($value->eve_fecha));
                }
            }
            $this->smartyci->assign('objEvento', $objEvento);
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
                $this->evento->getValsForm($this->input->post());
                $this->evento->eve_sed_id = $this->sede->sed_id;
                $this->evento->eve_estado = 0;
                $destination = 'evento_'.$_FILES['txt_eve_imagen']['name'];
                if(move_uploaded_file($_FILES['txt_eve_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                    $this->evento->nov_imagen = $destination;
                }
                if($this->evento->insert()){
                    $this->writeLog("Registro evento (id::{$this->eve->eve_id})");
                    redirect('seccion/evento/index');
                }else{
                    redirect('seccion/evento/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Eventos');
                $this->smartyci->assign('url_back', 'seccion/evento/index');
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
            $this->evento->getRow($id);
            if($this->evento->eve_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->evento->getValsForm($this->input->post());
                    $this->evento->update();
                    $this->writeLog("Editó evento (id::{$this->evento->eve_id})");
                    redirect('seccion/evento/index');
                }else{
                    $this->evento->eve_fecha = date('Y-m-d', strtotime($this->evento->eve_fecha));
                    $this->smartyci->assign('details', 'Eventos');
                    $this->smartyci->assign('url_back', 'seccion/evento/index');
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $this->evento->eve_id);
                    $this->smartyci->assign('stdEvento', $this->evento);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/evento/index');
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
            $this->evento->getRow($id);
            if($this->evento->eve_id > 0){
                if($this->evento->eve_estado == 1){
                    $this->evento->eve_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->evento->eve_estado = 1;
                    $icon = 'fa-check';
                }
                $this->evento->update();
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

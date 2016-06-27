<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of especialidad
 *
 * @author julio
 */
class Especialidad extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/especialidad_model', 'especialidad');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Especialidades');
    }
    public function index(){
        $objEspecialidad = $this->especialidad->getAll();
        if($objEspecialidad){
            foreach ($objEspecialidad as $id=>$value){
                $icon_estado = 'fa-ban';
                if($value->esp_estado == 1){
                    $icon_estado = 'fa-check';
                }
                $objEspecialidad[$id]->icon_estado = $icon_estado;
            }
        }
        $this->smartyci->assign('objEspecialidad', $objEspecialidad);
        $this->smartyci->show_page(NULL, uniqid());
    }
    
    public function nuevo(){
        $action = $this->input->post('txt_action');
        if(isset($action) && $action == 'nuevo'){
            $this->especialidad->getValsForm($this->input->post());
            if($this->especialidad->insert()){
                $this->writeLog("Registró de especialidad {$this->especialidad->esp_nombre} (id::{$this->especialidad->esp_id})");
                redirect('configuracion/especialidad/index');
            }else{
                redirect('configuracion/especialidad/nuevo');
            }
        }else{
            $this->smartyci->assign('details', 'Especialidades');
            $this->smartyci->assign('url_back', 'configuracion/especialidad/index');
            $this->smartyci->assign('form', 1);
            $this->smartyci->show_page(NULL, uniqid());
        }
    }
    
    public function editar($id){
        $this->especialidad->getRow($id);
        if($this->especialidad->esp_id > 0){
            $action = $this->input->post('txt_action');
            if(isset($action) && $action == 'editar'){
                $this->especialidad->getValsForm($this->input->post());
                $this->especialidad->update();
                $this->writeLog("Editó especialidad {$this->especialidad->esp_nombre} (id::{$this->especialidad->esp_id})");
                redirect('configuracion/especialidad/index');
            }else{
                $this->smartyci->assign('details', 'Especialidades');
                $this->smartyci->assign('url_back', 'seccion/especialidad/index');
                $this->smartyci->assign('form', 1);
                $this->smartyci->assign('id', $this->especialidad->esp_id);
                $this->smartyci->assign('stdEspecialidad', $this->especialidad);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }else{
            redirect('configuracion/especialidad/index');
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
    
    public function eliminar($id){
        $this->especialidad->getRow($id);
        if($this->especialidad->esp_id > 0){
            $this->especialidad->esp_estado = 2;
            if($this->especialidad->update()){
                $this->writeLog("Eliminó especialidad {$this->especialidad->esp_nombre} (id::{$this->especialidad->esp_id})");
            }
        }
        redirect('configuracion/especialidad/index');
    }
}

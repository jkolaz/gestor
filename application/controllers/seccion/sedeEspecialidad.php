<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sedeEspecialidad
 *
 * @author julio
 */
class SedeEspecialidad extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('configuracion/especialidad_model', 'especialidad');
        $this->load->model('seccion/sedeespecialidad_model', 'se');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        
    }
    
    public function permiso($sede){
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->smartyci->assign("form", 1);
            $objSE = $this->se->permiso($sede);
            $this->smartyci->assign('listado', 'Selección de especialidades - '.$this->sede->sed_nombre);
            $this->smartyci->assign('details', 'Sedes');
            $this->smartyci->assign('url_back', 'configuracion/sede/index');
            $this->smartyci->assign('objSE', $objSE);
            $this->smartyci->assign('id', $this->sede->sed_id);
            $this->smartyci->assign('sede', $this->sede->sed_nombre);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('configuracion/sede/index');
        }
    }
    
    public function nuevo(){
        $sede = $this->input->post('sede');
        $esp = $this->input->post('esp');
        $estado = $this->input->post('estado');
        $this->sede->getSedeById($sede);
        $this->especialidad->getRow($esp);
        $respuesta = 0;
        $where = array();
        $where['se_sed_id'] = $sede;
        $where['se_esp_id'] = $esp;
        $cant = $this->se->getCountAll($where);
        if($cant > 0){
            $this->se->getRow(0, $where);
            if($this->se->se_id > 0){
                $this->se->se_estado = $estado;
                $this->se->update();
                $this->writeLog("Modificó especialidad a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Especialidad {$this->menu->esp_nombre}(id::{$this->especialidad->esp_id})");
                $respuesta = 1;
            }
        }else{
            $this->se->se_esp_id = $esp;
            $this->se->se_sed_id = $sede;
            $this->se->se_estado = $estado;
            $this->se->insert();
            $this->writeLog("Agregó especialidad a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Especialidad {$this->especialidad->esp_nombre}(id::{$this->especialidad->esp_id})");
            $respuesta = 1;
        }
        echo json_encode(array('respuesta'=>$respuesta));
    }
}

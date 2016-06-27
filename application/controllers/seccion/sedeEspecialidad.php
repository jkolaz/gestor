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
        $this->load->model('seccion/medico_model', 'medico');
        $this->load->model('seccion/sedeespecialidad_model', 'se');
        
        
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $objeto = $this->se->getEspecialidadBySede($sede);
            $this->smartyci->assign('objEspecialidades', $objeto);
            $this->smartyci->assign('listado', 'Especialidades');
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect(URL_NO_PERMISO);
        }
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
                $this->writeLog("Modificó especialidad a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Especialidad {$this->especialidad->esp_nombre}(id::{$this->especialidad->esp_id})");
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
    
    public function configuracion($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $objEspecialidad = $this->se->getEspecialidadBySede($sede, $id);
            if($objEspecialidad){
                $where['med_se_id'] = $id;
                $obj = $this->medico->getAll($where);
                if($obj){
                    foreach($obj as $index=>$value){
                        $icon_estado = 'fa-ban';
                        if($value->med_estado == 1){
                            $icon_estado = 'fa-check';
                        }
                        $obj[$index]->icon_estado = $icon_estado;
                    }
                }
                $this->smartyci->assign('objMedico', $obj);
                $this->smartyci->assign('listado', $objEspecialidad[0]->esp_nombre);
                $this->smartyci->assign('details', 'Especialidades');
                $this->smartyci->assign('url_back', 'seccion/sedeEspecialidad/index');
                $this->smartyci->assign('especialidad_nombre', $objEspecialidad[0]->esp_nombre);
                $this->smartyci->assign('id', $id);
                $this->smartyci->show_page(NULL, uniqid());
            }else{
                redirect(URL_NO_PERMISO);
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
    
    public function medicoNuevo($se){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $objEspecialidad = $this->se->getEspecialidadBySede($sede, $se);
            if($objEspecialidad){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'nuevo'){
                    $this->medico->getValsForm($this->input->post());
                    $this->medico->med_se_id = $se;
                    $this->medico->med_estado = 0;
                    if($this->medico->insert()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Registró médico {$this->medico->med_nombre} (id::{$this->medico->med_id})");
                        redirect('seccion/sedeEspecialidad/configuracion/'.$se);
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/sedeEspecialidad/medicoNuevo/'.$se);
                    }
                }else{
                    $this->smartyci->assign('listado', 'Especialidades');
                    $this->smartyci->assign('details', $objEspecialidad[0]->esp_nombre);
                    $this->smartyci->assign('url_back', 'seccion/sedeEspecialidad/configuracion/'.$se);
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('se', $se);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect(URL_NO_PERMISO);
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
            $this->medico->getRow($id);
            if($this->medico->med_id > 0){
                if($this->medico->med_estado == 1){
                    $this->medico->med_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->medico->med_estado = 1;
                    $icon = 'fa-check';
                }
                $this->medico->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

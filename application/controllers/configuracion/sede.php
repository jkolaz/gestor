<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sede
 *
 * @author julio
 */
class Sede extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/region_model', 'region');
        $this->load->model('configuracion/sedeseccion_model', 'sede_seccion');
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('configuracion/sedetelefono_model', 'sede_telefono');
        $this->load->model('configuracion/seccion_model', 'seccion');        
        $this->smartyci->assign('listado', 'Sedes');
        $this->smartyci->assign('details', 'Sedes'); 
        $this->smartyci->assign('url_back', $this->_carpeta.'/'.$this->_class.'/index');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        if($this->_rol != 1){
            redirect(URL_NO_PERMISO);
        }
        $objSede = $this->sede->getAllSede();
        if($objSede){
            foreach ($objSede as $id=>$value){
                $icon_estado = 'fa-ban';
                if($value->sed_estado == 1){
                    $icon_estado = 'fa-check';
                }
                $objSede[$id]->icon_estado = $icon_estado;
            }
        }
        $this->smartyci->assign('objSede', $objSede);
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
    public function editar($id){
        $this->sede->getSedeById($id);
        if($this->sede->sed_id > 0){
            $where['st_sed_id'] = $id;
            $obST = $this->sede_telefono->getAll($where);
            if(isset($_POST['txt_action']) && $_POST['txt_action'] == 'editar'){
                $this->sede->getValsForm($_POST);
                if($this->sede->update()){
                    $where['st_sed_id'] = $this->sede->sed_id;
                    if($this->sede_telefono->getAllCount($where) > 0){
                        $this->sede_telefono->getRowByCols($where);
                        $this->sede_telefono->getValsForm($this->input->post());
                        $this->sede_telefono->update();
                    }else{
                        $this->sede_telefono->getValsForm($this->input->post());
                        $this->sede_telefono->st_sed_id = $this->sede->sed_id;
                        $this->sede_telefono->insert();
                    }
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Editó la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id})");
                    redirect('configuracion/sede/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('configuracion/sede/editar/'.$id);
                }
            }else{
                $objRegion = $this->region->getAll();
                if($objRegion){
                    foreach ($objRegion as $index=>$value){
                        $selected = '';
                        if($value->reg_id == $this->sede->sed_reg_id){
                            $selected = 'selected="selected"';
                        }
                        $objRegion[$index]->selected = $selected;
                    }
                }
                $this->smartyci->assign('objRegion', $objRegion);
                $this->smartyci->assign('sede', $this->sede);
                $this->smartyci->assign('sedeTelefono', $obST);
                $this->smartyci->assign('ID', $id);
                $this->smartyci->show_page(NULL,  uniqid());
            }
        }else{
            redirect('configuracion/sede/index');
        }
    }
    public function eliminar($id){
        $this->sede->getSedeById($id);
        $this->sede->sed_estado = 2;
        $this->sede->update();
        $this->writeLog("Eliminó la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id})");
        redirect('configuracion/sede/index');
    }
    
    public function seccionWeb($id){
        $this->sede->getSedeById($id);
        if($this->sede->sed_id > 0){
            $this->smartyci->assign("form", 1);
            $where['sec_estado'] = 1;
            $objSeccion = $this->seccion->getAllSeccion($where);
            $this->smartyci->assign('id', $this->sede->sed_id);
            $this->smartyci->assign('nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objSeccion', $objSeccion);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('configuracion/sede/index');
        }
    }
    
    public function agregarSeccion(){
        $sede = $this->input->post('sede');
        $seccion = $this->input->post('seccion');
        $estado = $this->input->post('estado');
        $this->sede->getSedeById($sede);
        $this->seccion->getSeccionById($seccion);
        $respuesta = 0;
        $where = array();
        $where['ss_sed_id'] = $sede;
        $where['ss_sec_id'] = $seccion;
        $cant = $this->sede_seccion->getCountAll($where);
        if($cant > 0){
            $this->sede_seccion->getRow(0, $where);
            if($this->sede_seccion->ss_id > 0){
                $this->sede_seccion->ss_estado = $estado;
                $this->sede_seccion->update();
                $this->writeLog("Modificó secciones a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Seccion web {$this->seccion->sec_nombre}(id::{$this->seccion->sec_id})");
                $respuesta = 1;
            }
        }else{
            $this->sede_seccion->ss_sec_id = $seccion;
            $this->sede_seccion->ss_sed_id = $sede;
            $this->sede_seccion->ss_estado = $estado;
            $this->sede_seccion->insert();
            $this->writeLog("Agregó accesos a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Seccion web {$this->seccion->sec_nombre}(id::{$this->seccion->sec_id})");
            $respuesta = 1;
        }
        echo json_encode(array('respuesta'=>$respuesta));
    }
    
    public function nuevo(){
        $action = $this->input->post('txt_action');
        if(isset($action) && $action == 'nuevo'){
            $this->sede->getValsForm($this->input->post());
            $where['sed_nombre'] = $this->sede->sed_nombre;
            if($this->sede->getCountAll($where) > 0){
                $this->session->set_userdata('message_id', 3);
                $this->session->set_userdata('message', 'WRM1');
                redirect('configuracion/sede/nuevo');
            }
            if($this->sede->insert()){
                $this->sede_telefono->getValsForm($this->input->post());
                $this->sede_telefono->st_sed_id = $this->sede->sed_id;
                $this->sede_telefono->insert();
                $this->writeLog("Registro la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id})");
                $this->session->set_userdata('message_id', 1);
                $this->session->set_userdata('message', 'MSG1');
                redirect('configuracion/sede/index');
            }else{
                $this->session->set_userdata('message_id', 2);
                $this->session->set_userdata('message', 'ERR1');
                redirect('configuracion/sede/index');
            }
            
        }else{
            $objRegion = $this->region->getAll();
            $this->smartyci->assign('objRegion', $objRegion);
            $this->smartyci->assign('sede', $this->sede);
            $this->smartyci->show_page(NULL,  uniqid());
        }
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->sede->getSedeById($id);
            if($this->sede->sed_id > 0){
                if($this->sede->sed_estado == 1){
                    $this->sede->sed_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->sede->sed_estado = 1;
                    $icon = 'fa-check';
                }
                $this->sede->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

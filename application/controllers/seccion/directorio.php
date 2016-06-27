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
class Directorio extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/directorio_model', 'directorio');
        $this->smartyci->assign('listado', 'Directorio');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['dir_sed_id'] = $sede;
            $obj = $this->directorio->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->dir_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objDirectorio', $obj);
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
                $this->directorio->getValsForm($this->input->post());
                $this->directorio->dir_sed_id = $sede;
                $this->directorio->dir_estado = 0;
                if($this->directorio->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró Directorio (id::{$this->directorio->dir_id})");
                    redirect('seccion/directorio/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/directorio/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Directorio');
                $this->smartyci->assign('url_back', 'seccion/directorio/index');
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
            $this->directorio->getRow($id);
            if($this->directorio->dir_id > 0){
                if($this->directorio->dir_estado == 1){
                    $this->directorio->dir_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->directorio->dir_estado = 1;
                    $icon = 'fa-check';
                }
                $this->directorio->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->directorio->getRow($id);
            if($this->directorio->dir_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->directorio->getValsForm($this->input->post());
                    if($this->directorio->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó directorio (id::{$this->directorio->dir_id})");
                        redirect('seccion/directorio/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/directorio/editar/'.$id);
                    }
                }else{
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdDirectorio', $this->directorio);
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

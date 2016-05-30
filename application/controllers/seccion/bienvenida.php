<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bienbenido
 *
 * @author julio
 */
class Bienvenida extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/bienvenida_model', 'bienvenida');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Bienvenidas');
    }
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['bie_sed_id'] = $this->sede->sed_id;
            $objBienvenida = $this->bienvenida->getAll($where);
            if($objBienvenida){
                foreach ($objBienvenida as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->bie_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $objBienvenida[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('objBienvenida', $objBienvenida);
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
                $this->bienvenida->getValsForm($this->input->post());
                $this->bienvenida->bie_sed_id = $this->sede->sed_id;
                $this->bienvenida->bie_estado = 0;
                if($this->bienvenida->insert()){
                    $this->writeLog("Registró bienvenida (id::{$this->bienvenida->bie_id})");
                    redirect('seccion/bienvenida/index');
                }else{
                    redirect('seccion/bienvenida/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Bienvenidas');
                $this->smartyci->assign('url_back', 'seccion/bienvenida/index');
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
            $this->bienvenida->getRow($id);
            if($this->bienvenida->bie_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->bienvenida->getValsForm($this->input->post());
                    $this->bienvenida->update();
                    $this->writeLog("Editó bienvenida (id::{$this->bienvenida->bie_id})");
                    redirect('seccion/bienvenida/index');
                }else{
                    $this->smartyci->assign('details', 'Bienvenidas');
                    $this->smartyci->assign('url_back', 'seccion/bienvenida/index');
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $this->bienvenida->bie_id);
                    $this->smartyci->assign('stdBienvenida', $this->bienvenida);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/bienvenida/index');
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
            $this->bienvenida->getRow($id);
            if($this->bienvenida->bie_id > 0){
                if($this->bienvenida->bie_estado == 1){
                    $this->bienvenida->bie_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->bienvenida->bie_estado = 1;
                    $icon = 'fa-check';
                }
                $this->bienvenida->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

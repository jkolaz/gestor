<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of revista
 *
 * @author julio
 */
class Revista extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/revista_model', 'revista');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Revistas');
    }
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['rev_sed_id'] = $this->sede->sed_id;
            $objRevista = $this->revista->getAll($where);
            if($objRevista){
                foreach ($objRevista as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->rev_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $objRevista[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('objRevista', $objRevista);
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
                $this->revista->getValsForm($this->input->post());
                $this->revista->rev_sed_id = $this->sede->sed_id;
                $this->revista->rev_estado = 0;
                if($this->revista->insert()){
                    $this->writeLog("Registro revista (id::{$this->revista->rev_id})");
                    redirect('seccion/revista/index');
                }else{
                    redirect('seccion/revista/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Revistas');
                $this->smartyci->assign('url_back', 'seccion/revista/index');
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
            $this->revista->getRow($id);
            if($this->revista->rev_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->revista->getValsForm($this->input->post());
                    $this->revista->update();
                    $this->writeLog("Editó revita (id::{$this->revista->rev_id})");
                    redirect('seccion/revista/index');
                }else{
                    $this->smartyci->assign('details', 'Revistas');
                    $this->smartyci->assign('url_back', 'seccion/revista/index');
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $this->revista->rev_id);
                    $this->smartyci->assign('stdRevista', $this->revista);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/revista/index');
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
            $this->revista->getRow($id);
            if($this->revista->rev_id > 0){
                if($this->revista->rev_estado == 1){
                    $this->revista->rev_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->revista->rev_estado = 1;
                    $icon = 'fa-check';
                }
                $this->revista->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

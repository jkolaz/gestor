<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author VMC-D02
 */
class Home extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/home_model', 'home');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('listado', 'Home');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['hom_sed_id'] = $this->sede->sed_id;
            $objHome = $this->home->getAll($where);
            if($objHome){
                foreach ($objHome as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $icon_visible = 'fa-eye-slash';
                    if($value->hom_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    if($value->hom_visible == 1){
                        $icon_visible = 'fa-eye';
                    }
                    $objHome[$id]->icon_estado = $icon_estado;
                    $objHome[$id]->icon_visible = $icon_visible;
                }
            }
            $this->smartyci->assign('objHome', $objHome);
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
                $this->home->getValsForm($this->input->post());
                $this->home->hom_sed_id = $this->sede->sed_id;
                $this->home->hom_estado = 0;
                //imprimir($this->home);exit;
                if ((($_FILES["txt_hom_imagen"]["type"] == "image/png") || ($_FILES["txt_hom_imagen"]["type"] == "image/jpeg") || ($_FILES["txt_hom_imagen"]["type"] == "image/jpg"))) {   
                    $extension = pathinfo($_FILES["txt_hom_imagen"]["name"]);
                    $destination = uniqid('home_').'.'.$extension['extension'];
                    if(move_uploaded_file($_FILES['txt_hom_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                        $this->home->hom_imagen = $destination;
                    }
                }
                if($this->home->insert()){
                    $this->writeLog("Registro home (id::{$this->home->hom_id})");
                    redirect('seccion/home/index');
                }else{
                    redirect('seccion/home/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Home');
                $this->smartyci->assign('url_back', 'seccion/home/index');
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
            $this->home->getRow($id);
            if($this->home->hom_id > 0){
                if($this->home->hom_estado == 1){
                    $this->home->hom_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->home->hom_estado = 1;
                    $icon = 'fa-check';
                }
                $this->home->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function changeVisible(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->home->getRow($id);
            if($this->home->hom_id > 0){
                if($this->home->hom_visible == 1){
                    $this->home->hom_visible = 0;
                    $icon = 'fa-eye-slash';
                }else{
                    $this->home->hom_visible = 1;
                    $icon = 'fa-eye';
                }
                $this->home->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fundador
 *
 * @author VMC-D02
 */
class Fundador extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/fundador_model', 'fundador');
        $this->smartyci->assign('listado', 'Fundador');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['fun_sed_id'] = $sede;
            $obj = $this->fundador->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->fun_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('sede_nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('objFundador', $obj);
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
                $this->fundador->getValsForm($this->input->post());
                $this->fundador->fun_sed_id = $sede;
                $this->fundador->fun_estado = 0;
                
                if(isset($_FILES["txt_fun_imagen"]["name"]) && $_FILES["txt_fun_imagen"]["name"] != ""){
                    if ((($_FILES["txt_fun_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_fun_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_fun_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_fun_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_fun_imagen"]["name"]);
                                $destination = uniqid('fundador_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_fun_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    if($this->fundador->fun_imagen !=""){
                                        unlink(PATH_GALLERY.$this->fundador->fun_imagen);
                                    }
                                    $this->fundador->fun_imagen = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/fundador/nuevo/');
                    }
                }
                
                if($this->fundador->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registró fundador {$this->fundador->fun_nombre} (id::{$this->fundador->fun_id})");
                    redirect('seccion/fundador/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/fundador/nuevo');
                }
            }else{
                $this->smartyci->assign('details', 'Fundador');
                $this->smartyci->assign('url_back', 'seccion/fundador/index');
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
            $this->fundador->getRow($id);
            if($this->fundador->fun_id > 0){
                if($this->fundador->fun_estado == 1){
                    $this->fundador->fun_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->fundador->fun_estado = 1;
                    $icon = 'fa-check';
                }
                $this->fundador->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->fundador->getRow($id);
            if($this->fundador->fun_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->fundador->getValsForm($this->input->post());
                    $this->fundador->fun_imagen = guardar_archivo('txt_fun_imagen', $_FILES, 'fundador_', $this->fundador->fun_imagen);
                    if($this->fundador->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó Fundador {$this->fundador->fun_nombre}(id::{$this->fundador->fun_id})");
                        redirect('seccion/fundador/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/fundador/editar/'.$id);
                    }
                }else{
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdFundador', $this->fundador);
                    $this->smartyci->assign('details', 'Fundador');
                    $this->smartyci->assign('url_back', 'seccion/fundador/index');
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

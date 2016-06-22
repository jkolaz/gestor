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
class Servicio extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/servicio_model', 'servicio');
        $this->smartyci->assign('listado', 'Servicios');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $obj = $this->servicio->getAll();
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->ser_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('objServicio', $obj);
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
                $this->servicio->getValsForm($this->input->post());
                $this->servicio->ser_sed_id = $sede;
                $this->servicio->ser_url = quitarAcentos($this->input->post('txt_ser_nombre'));
                if(isset($_FILES["txt_ser_imagen"]["name"]) && $_FILES["txt_ser_imagen"]["name"] != ""){
                    if ((($_FILES["txt_ser_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_ser_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_ser_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_ser_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_ser_imagen"]["name"]);
                                $destination = uniqid('servicio_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_ser_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->servicio->ser_imagen = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/servicio/nuevo/');
                    }
                }
                if($this->servicio->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registro Servicio {$this->servicio->ser_nombre} (id::{$this->servicio->ser_id})");
                    redirect('seccion/servicio/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/servicio/nuevo/');
                }
            }else{
                $this->smartyci->assign('details', 'Servicios');
                $this->smartyci->assign('url_back', 'seccion/servicio/index');
                $this->smartyci->assign('form', 1);
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
            $this->servicio->getRow($id);
            if($this->servicio->ser_id > 0){
                if($this->servicio->ser_estado == 1){
                    $this->servicio->ser_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->servicio->ser_estado = 1;
                    $icon = 'fa-check';
                }
                $this->servicio->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

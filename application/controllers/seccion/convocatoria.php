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
class Convocatoria extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/convocatoria_model', 'convocatoria');
        $this->load->model('seccion/menuweb_model', 'menuweb');
        $this->smartyci->assign('listado', 'Convocatorias');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['con_sed_id'] = $sede;
            $obj = $this->convocatoria->getAll($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->con_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('objConvocatoria', $obj);
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
                $this->convocatoria->getValsForm($this->input->post());
                $this->convocatoria->con_sed_id = $sede;
                if(isset($_FILES["txt_con_imagen"]["name"]) && $_FILES["txt_con_imagen"]["name"] != ""){
                    if ((($_FILES["txt_con_imagen"]["type"] == "image/png")
                        || ($_FILES["txt_con_imagen"]["type"] == "image/jpeg")
                        || ($_FILES["txt_con_imagen"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_con_imagen"]["name"])){
                                $extension = pathinfo($_FILES["txt_con_imagen"]["name"]);
                                $destination = uniqid('convocatoria_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_con_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->convocatoria->con_imagen = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/convocatoria/nuevo');
                    }
                }
                if($this->convocatoria->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registro Convocatoria {$this->convocatoria->con_nombre} (id::{$this->convocatoria->con_id})");
                    redirect('seccion/convocatoria/index');
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/convocatoria/nuevo');
                }
            }else{
                $objMenu = $this->menuweb->getUrlPermitidas($sede, array(7, 30), '');
                $this->smartyci->assign('objMenu', $objMenu);
                $this->smartyci->assign('details', 'Convocatorias');
                $this->smartyci->assign('url_back', 'seccion/convocatoria/index');
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
            $this->convocatoria->getRow($id);
            if($this->convocatoria->con_id > 0){
                if($this->convocatoria->con_estado == 1){
                    $this->convocatoria->con_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->convocatoria->con_estado = 1;
                    $icon = 'fa-check';
                }
                $this->convocatoria->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    public function editar($id){
        $sede = $this->session->userdata('sede');
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->convocatoria->getRow($id);
            if($this->convocatoria->con_id > 0){
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'editar'){
                    $this->convocatoria->getValsForm($this->input->post());
                    if(isset($_FILES["txt_con_imagen"]["name"]) && $_FILES["txt_con_imagen"]["name"] != ""){
                        if ((($_FILES["txt_con_imagen"]["type"] == "image/png")
                            || ($_FILES["txt_con_imagen"]["type"] == "image/jpeg")
                            || ($_FILES["txt_con_imagen"]["type"] == "image/jpg"))) {
                                if(!is_array($_FILES["txt_con_imagen"]["name"])){
                                    $extension = pathinfo($_FILES["txt_con_imagen"]["name"]);
                                    $destination = uniqid('servicio_').'.'.$extension['extension'];
                                    if(move_uploaded_file($_FILES['txt_con_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                        if($this->convocatoria->con_imagen != ""){
                                            unlink(PATH_GALLERY.$this->convocatoria->con_imagen);
                                        }
                                        $this->convocatoria->con_imagen = $destination;
                                    }
                                }else{
                                    $this->session->set_userdata('message_id', 2);
                                    $this->session->set_userdata('message', 'ERR4');
                                }
                        }else{
                            $this->session->set_userdata('message_id', 3);
                            $this->session->set_userdata('message', 'ERR3');
                            redirect('seccion/convocatoria/editar/'.$id);
                        }
                    }
                    if($this->convocatoria->update()){
                        $this->session->set_userdata('message_id', 1);
                        $this->session->set_userdata('message', 'MSG1');
                        $this->writeLog("Editó convocatoria {$this->convocatoria->con_nombre} (id::{$this->convocatoria->con_id})");
                        redirect('seccion/convocatoria/index');
                    }else{
                        $this->session->set_userdata('message_id', 2);
                        $this->session->set_userdata('message', 'ERR1');
                        redirect('seccion/convocatoria/editar/'.$id);
                    }
                }else{
                    $objMenu = $this->menuweb->getUrlPermitidas($sede, array(7, 30), $this->convocatoria->con_url);
                    $this->smartyci->assign('objMenu', $objMenu);
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('id', $id);
                    $this->smartyci->assign('stdConvocatoria', $this->convocatoria);
                    $this->smartyci->show_page(NULL, uniqid());
                }
            }else{
                redirect('seccion/servicio/index');
            }
        }else{
            redirect(URL_NO_PERMISO);
        }
    }
}

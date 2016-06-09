<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of banner
 *
 * @author VMC-D02
 */
class Banner extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/tipobanner_model', 'tipo_banner');
        $this->load->model('seccion/banner_model', 'banner');
        $this->smartyci->assign('listado', 'Banner');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $obj = $this->tipo_banner->getAll();
        $this->smartyci->assign('objBanner', $obj);
        $this->smartyci->show_page(NULL, uniqid());
    }
    
    public function listar($tb){
        $this->tipo_banner->getRow($tb);
        if($this->tipo_banner->tb_id > 0){
            $sede = $this->session->userdata('sede');
            $where['ban_tb_id'] = $this->tipo_banner->tb_id;
            $where['ban_sed_id'] = 0;
            $obj = $this->banner->getall($where);
            if($obj){
                foreach ($obj as $id=>$value){
                    $icon_estado = 'fa-ban';
                    $icon_visible = 'fa-eye-slash';
                    if($value->ban_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $obj[$id]->icon_estado = $icon_estado;
                }
            }
            $this->smartyci->assign('id', $this->tipo_banner->tb_id);
            $this->smartyci->assign('tipo', $this->tipo_banner->tb_nombre);
            $this->smartyci->assign('objBanner', $obj);
            $this->smartyci->assign('details', 'Banners');
            $this->smartyci->assign('url_back', 'seccion/banner/index');
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            $this->session->set_userdata('message_id', 2);
            $this->session->set_userdata('message', 'ERR2');
            redirect('seccion/banner/index');
        }
    }
    
    public function nuevo($tb){
        $this->tipo_banner->getRow($tb);
        if($this->tipo_banner->tb_id > 0){
            $action = $this->input->post('txt_action');
            if(isset($action) && $action == 'nuevo'){
                $sede = $this->session->userdata('sede');
                $this->banner->getValsForm($this->input->post());
                $this->banner->ban_tb_id = $tb;
                $this->banner->ban_sed_id = 0;
                if(isset($_FILES["txt_ban_img"]["name"]) && $_FILES["txt_ban_img"]["name"] != ""){
                    if ((($_FILES["txt_ban_img"]["type"] == "image/png")
                        || ($_FILES["txt_ban_img"]["type"] == "image/jpeg")
                        || ($_FILES["txt_ban_img"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_ban_img"]["name"])){
                                $extension = pathinfo($_FILES["txt_ban_img"]["name"]);
                                $destination = uniqid('banner_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_ban_img']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->banner->ban_img = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/banner/nuevo/'.$tb);
                    }
                }
                if($this->banner->insert()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Registro banner {$this->banner->ban_img} (id::{$this->banner->ban_id})");
                    redirect('seccion/banner/listar/'.$tb);
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/banner/nuevo/'.$tb);
                }
            }else{
                $this->smartyci->assign('form', 1);
                $this->smartyci->assign('tipo_id', $this->tipo_banner->tb_id);
                $this->smartyci->assign('tipo', $this->tipo_banner->tb_nombre);
                $this->smartyci->assign('details', 'Banners - '.$this->tipo_banner->tb_nombre);
                $this->smartyci->assign('url_back', 'seccion/banner/listar/'.$tb);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }else{
            $this->session->set_userdata('message_id', 2);
            $this->session->set_userdata('message', 'ERR2');
            redirect('seccion/banner/index');
        }
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->banner->getRow($id);
            if($this->banner->ban_id > 0){
                if($this->banner->ban_estado == 1){
                    $this->banner->ban_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->banner->ban_estado = 1;
                    $icon = 'fa-check';
                }
                $this->banner->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    
    public function editar($id){
        $this->banner->getRow($id);
        if($this->banner->ban_id > 0){
            $action = $this->input->post('txt_action');
            if(isset($action) && $action == 'editar'){
                $this->banner->getValsForm($this->input->post());
                if(isset($_FILES["txt_ban_img"]["name"]) && $_FILES["txt_ban_img"]["name"] != ""){
                    if ((($_FILES["txt_ban_img"]["type"] == "image/png")
                        || ($_FILES["txt_ban_img"]["type"] == "image/jpeg")
                        || ($_FILES["txt_ban_img"]["type"] == "image/jpg"))) {
                            if(!is_array($_FILES["txt_ban_img"]["name"])){
                                $extension = pathinfo($_FILES["txt_ban_img"]["name"]);
                                $destination = uniqid('banner_').'.'.$extension['extension'];
                                if(move_uploaded_file($_FILES['txt_ban_img']['tmp_name'], PATH_GALLERY.$destination)){
                                    $this->banner->ban_img = $destination;
                                }
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR4');
                            }
                    }else{
                        $this->session->set_userdata('message_id', 3);
                        $this->session->set_userdata('message', 'ERR3');
                        redirect('seccion/banner/editar/'.$id);
                    }
                }
                if($this->banner->update()){
                    $this->session->set_userdata('message_id', 1);
                    $this->session->set_userdata('message', 'MSG1');
                    $this->writeLog("Editó banner {$this->banner->ban_img} (id::{$this->banner->ban_id})");
                    redirect('seccion/banner/listar/'.$this->banner->ban_tb_id);
                }else{
                    $this->session->set_userdata('message_id', 2);
                    $this->session->set_userdata('message', 'ERR1');
                    redirect('seccion/banner/editar/'.$id);
                }
            }else{
                $this->smartyci->assign('form', 1);
                $this->tipo_banner->getRow($this->banner->ban_tb_id);
                $this->smartyci->assign('id', $id);
                $this->smartyci->assign('tipo', $this->tipo_banner->tb_nombre);
                $this->smartyci->assign('stdBanner', $this->banner);
                $this->smartyci->show_page(NULL, uniqid());
            }
        }  else {
            $this->session->set_userdata('message_id', 2);
            $this->session->set_userdata('message', 'ERR2');
            redirect('seccion/banner/index');
        }
    }
}

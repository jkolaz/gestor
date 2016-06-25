<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menuweb
 *
 * @author VMC-D02
 */
class Menuweb extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('configuracion/sede_model', 'sede');
        $this->load->model('seccion/menuweb_model', 'menuweb');
        $this->load->model('configuracion/menu_model', 'menu');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    public function index($sede = 0){
        if($sede == 0){
            $sede = $this->session->userdata('sede');
        }
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $where['men_padre'] = 0;
            $objMenu = $this->menu->getAll($where);
            if($objMenu){
                foreach ($objMenu as $id=>$valor){
                    $objSubMenu = $this->menuweb->getPermiso($sede, $valor->men_id);
                    $objMenu[$id]->men_submenu = $objSubMenu;
                        $objMenu[$id]->imagen = $this->menuweb->getImageByMenu($valor->men_id, $sede);
                }
            }
            $this->smartyci->assign("listado", 'Menú - '.$this->sede->sed_nombre);
            $this->smartyci->assign("form", 1);
            $this->smartyci->assign('objMenu', $objMenu);
            $this->smartyci->assign('nombre', $this->sede->sed_nombre);
            $this->smartyci->assign('nombre_url', $this->sede->sed_url);
            $this->smartyci->assign('id', $this->sede->sed_id);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('configuracion/sede/index');
        }
    }
    
    public function nuevo(){
        $sede = $this->input->post('sede');
        $menu = $this->input->post('menu');
        $estado = $this->input->post('estado');
        $this->sede->getSedeById($sede);
        $this->menu->getRow($menu);
        $respuesta = 0;
        $where = array();
        $where['mw_sed_id'] = $sede;
        $where['mw_men_id'] = $menu;
        $cant = $this->menuweb->getCountAll($where);
        if($cant > 0){
            $this->menuweb->getRow(0, $where);
            if($this->menuweb->mw_id > 0){
                $this->menuweb->mw_estado = $estado;
                $this->menuweb->update();
                $this->writeLog("Modificó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
                $respuesta = 1;
            }
        }else{
            $this->menuweb->mw_men_id = $menu;
            $this->menuweb->mw_sed_id = $sede;
            $this->menuweb->mw_estado = $estado;
            $this->menuweb->insert();
            $this->writeLog("Agregó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
            $respuesta = 1;
        }
        echo json_encode(array('respuesta'=>$respuesta));
    }
    
    public function configuracion($sede, $menu){
        $this->sede->getSedeById($sede);
        if($this->sede->sed_id > 0){
            $this->menu->getRow($menu);
            if($this->menu->men_id > 0){
                $where['mw_sed_id'] = $sede;
                $where['mw_men_id'] = $menu;
                $cant = $this->menuweb->getCountAll($where);
                $action = $this->input->post('txt_action');
                if(isset($action) && $action == 'configurar'){
                    if($cant > 0){
                        $this->menuweb->getRow(0, $where);
                        if($this->menuweb->mw_id > 0){
                            
                            if(isset($_FILES["txt_mw_imagen"]["name"]) && $_FILES["txt_mw_imagen"]["name"] != ""){
                                if ((($_FILES["txt_mw_imagen"]["type"] == "image/png")
                                    || ($_FILES["txt_mw_imagen"]["type"] == "image/jpeg")
                                    || ($_FILES["txt_mw_imagen"]["type"] == "image/jpg"))) {
                                        if(!is_array($_FILES["txt_mw_imagen"]["name"])){
                                            $extension = pathinfo($_FILES["txt_mw_imagen"]["name"]);
                                            $destination = uniqid('menuweb_').'.'.$extension['extension'];
                                            if(move_uploaded_file($_FILES['txt_mw_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                                if($this->menuweb->mw_imagen !=""){
                                                    unlink(PATH_GALLERY.$this->menuweb->mw_imagen);
                                                }
                                                $this->menuweb->mw_imagen = $destination;
                                            }
                                        }else{
                                            $this->session->set_userdata('message_id', 2);
                                            $this->session->set_userdata('message', 'ERR4');
                                        }
                                }else{
                                    $this->session->set_userdata('message_id', 3);
                                    $this->session->set_userdata('message', 'ERR3');
                                    redirect('seccion/menuweb/configurar/'.$sede.'/'.$menu);
                                }
                            }
                            
                            if($this->menuweb->update()){
                                $this->session->set_userdata('message_id', 1);
                                $this->session->set_userdata('message', 'MSG1');
                                $this->writeLog("Modificó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
                                redirect('seccion/menuweb/index');
                            }else{
                                $this->session->set_userdata('message_id', 2);
                                $this->session->set_userdata('message', 'ERR1');
                                redirect('seccion/menuweb/configurar/'.$sede.'/'.$menu);
                            }
                        }else{
                            redirect('seccion/menuweb/index');
                        }
                    }else{
                        $this->menuweb->mw_men_id = $menu;
                        $this->menuweb->mw_sed_id = $sede;
                        $this->menuweb->mw_estado = 1;
                        
                        if(isset($_FILES["txt_mw_imagen"]["name"]) && $_FILES["txt_mw_imagen"]["name"] != ""){
                            if ((($_FILES["txt_mw_imagen"]["type"] == "image/png")
                                || ($_FILES["txt_mw_imagen"]["type"] == "image/jpeg")
                                || ($_FILES["txt_mw_imagen"]["type"] == "image/jpg"))) {
                                    if(!is_array($_FILES["txt_mw_imagen"]["name"])){
                                        $extension = pathinfo($_FILES["txt_mw_imagen"]["name"]);
                                        $destination = uniqid('menuweb_').'.'.$extension['extension'];
                                        if(move_uploaded_file($_FILES['txt_mw_imagen']['tmp_name'], PATH_GALLERY.$destination)){
                                            $this->menuweb->mw_imagen = $destination;
                                        }
                                    }else{
                                        $this->session->set_userdata('message_id', 2);
                                        $this->session->set_userdata('message', 'ERR4');
                                    }
                            }else{
                                $this->session->set_userdata('message_id', 3);
                                $this->session->set_userdata('message', 'ERR3');
                                redirect('seccion/menuweb/configurar/'.$sede.'/'.$menu);
                            }
                        }
                        
                        if($this->menuweb->insert()){
                            $this->session->set_userdata('message_id', 1);
                            $this->session->set_userdata('message', 'MSG1');
                            $this->writeLog("Agregó menú a la sede {$this->sede->sed_nombre}(id::{$this->sede->sed_id}) - Menú web {$this->menu->men_nombre}(id::{$this->menu->men_id})");
                            redirect('seccion/menuweb/index');
                        }else{
                            $this->session->set_userdata('message_id', 2);
                            $this->session->set_userdata('message', 'ERR1');
                            redirect('seccion/menuweb/configurar/'.$sede.'/'.$menu);
                        }
                    }
                }else{
                    $this->smartyci->assign('listado', 'Configuración menú - '.$this->sede->sed_nombre);
                    $this->smartyci->assign('details', 'menu');
                    $this->smartyci->assign('url_back', 'seccion/menuweb/index');
                    $this->smartyci->assign('form', 1);
                    $this->smartyci->assign('sede_id', $sede);
                    $this->smartyci->assign('menu_id', $menu);
                    $this->smartyci->assign('menu_nombre', $this->menu->men_nombre);
                    if($cant > 0){
                        $this->menuweb->getRow(0, $where);
                        if($this->menuweb->mw_id > 0){
                            $this->smartyci->assign('stdMenuWeb', $this->menuweb);
                            $this->smartyci->show_page('seccion/menuweb_editar.tpl', uniqid());
                        }else{
                            redirect('seccion/menuweb/index');
                        }
                    }else{
                        $this->smartyci->show_page('seccion/menuweb_nuevo.tpl', uniqid());
                    }
                }
            }else{
                redirect('seccion/menuweb/index');
            }
        }else{
            redirect('seccion/menuweb/index');
        }
    }
}

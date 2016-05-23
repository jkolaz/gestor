<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of permiso}
 *
 * @author julio
 */
class Permiso extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('seguridad/tipoadmin_model', 'ta');
        $this->load->model('seguridad/pagina_model', 'pagina');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
        $this->smartyci->assign('details', 'Tipo de administradores'); 
        $this->smartyci->assign('url_back', 'seguridad/tipoAdmin/index');
    }
    
    public function index($ta){
        $this->smartyci->assign("form", 1);
        $this->ta->getTAById($ta);
        $obPM = $this->permiso_model->getAllPagesAndModule($ta);
        $this->smartyci->assign('obPM', $obPM);
        $this->smartyci->assign('nombre', $this->ta->ta_nombre);
        $this->smartyci->assign('id', $this->ta->ta_id);
        $this->smartyci->show_page(NULL, uniqid());
    }
    
    public function nuevo(){
        $pagina = $this->input->post('pagina');
        $ta = $this->input->post('ta');
        $estado = $this->input->post('estado');
        $respuesta = 0;
        $this->pagina->getRow($pagina);
        $this->ta->getTAById($ta);
        $where = array();
        $where['per_pag_id'] = $pagina;
        $where['per_ta_id'] = $ta;
        $cant = $this->permiso_model->getCountAll($where);
        if($cant > 0){
            $this->permiso_model->getRow(0, $where);
            if($this->permiso_model->per_id > 0){
                $this->permiso_model->per_pag_id = $pagina;
                $this->permiso_model->per_ta_id = $ta;
                $this->permiso_model->per_estado = $estado;
                $this->permiso_model->update();
                $this->writeLog("Modificó permisos del tipo de administrador {$this->ta->ta_nombre}(id::{$this->ta->ta_id}) - Permiso {$this->pagina->pag_nombre}(id::{$this->pagina->pag_id})");
                $respuesta = 1;
            }
        }else{
            $this->permiso_model->per_pag_id = $pagina;
            $this->permiso_model->per_ta_id = $ta;
            $this->permiso_model->per_estado = $estado;
            $this->permiso_model->insert();
            $this->writeLog("Agregó permisos al tipo de administrador {$this->ta->ta_nombre}(id::{$this->ta->ta_id}) - Seccion web {$this->pagina->pag_nombre}(id::{$this->pagina->pag_id})");
            $respuesta = 1;
        }
        echo json_encode(array('respuesta'=>$respuesta));
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pagina
 *
 * @author julio
 */
class Pagina extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('seguridad/modulo_model', 'modulo');
        $this->load->model('seguridad/pagina_model', 'pagina');
        $this->smartyci->assign('listado', 'Páginas');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index($modulo){
        $this->modulo->getRow($modulo);
        if($this->modulo->men_id > 0){
            $where['pag_mod_id'] = $this->modulo->mod_id;
            $objPagina = $this->pagina->getAll($where);
            if($objPagina){
                foreach ($objPagina as $id=>$value){
                    $icon_estado = 'fa-ban';
                    if($value->pag_estado == 1){
                        $icon_estado = 'fa-check';
                    }
                    $objPagina[$id]->icon_estado = $icon_estado;
                }
            }

            $this->smartyci->assign('modulo_id', $this->modulo->mod_id);
            $this->smartyci->assign('modulo', $this->modulo->mod_nombre);
            $this->smartyci->assign('folder', $this->modulo->mod_url.'/');
            $this->smartyci->assign('pagina', $objPagina);
            $this->smartyci->show_page(NULL, uniqid());
        }else{
            redirect('seguridad/modulo/index');
        }
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->pagina->getRow($id);
            if($this->pagina->pag_id > 0){
                if($this->pagina->pag_estado == 1){
                    $this->pagina->pag_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->pagina->pag_estado = 1;
                    $icon = 'fa-check';
                }
                $this->pagina->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
    
    public function editar($id){
        $this->pagina->getRow($id);
        $action = $this->input->post('txt_action');
        if(isset($action) && $action=='editar'){
            $this->pagina->getValsForm($this->input->post());
            $this->pagina->update();
            $this->writeLog("Editó la pagina {$this->pagina->pag_nombre}(id::{$this->pagina->pag_id})");
            redirect('seguridad/pagina/index/'.$this->pagina->pag_mod_id);
        }else{
            $this->smartyci->assign('ID', $id);
            $this->smartyci->assign('pagina', $this->pagina);
            $this->smartyci->show_page(NULL, uniqid());
        }
    }
    public function nuevo($modulo){
        $action = $this->input->post('txt_action');
        if(isset($action) && $action=='nuevo'){
            $this->pagina->getValsForm($this->input->post());
            if($this->pagina->insert() ){
                $this->writeLog("Registró la pagina {$this->pagina->pag_nombre}(id::{$this->pagina->pag_id})");
            }
            redirect('seguridad/pagina/index/'.$modulo);
        }else{
            $this->smartyci->assign('modulo', $modulo);
            $this->smartyci->show_page(NULL,  uniqid());
        }
    }
}

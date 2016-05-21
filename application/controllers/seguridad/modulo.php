<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modulo
 *
 * @author VMC-D02
 */
class Modulo extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->smartyci->assign('listado', 'Módulos del sistema');
        $this->load->model('seguridad/modulo_model', 'modulo');
        $this->smartyci->assign('js_script', $this->_carpeta.'/'.$this->_class.'.js');
    }
    
    public function index(){
        $objModulo = $this->modulo->getAll();
        if($objModulo){
            foreach ($objModulo as $id=>$value){
                $icon_estado = 'fa-ban';
                if($value->mod_estado == 1){
                    $icon_estado = 'fa-check';
                }
                $objModulo[$id]->icon_estado = $icon_estado;
            }
        }
        $this->smartyci->assign('modulo', $objModulo);
        $this->smartyci->show_page(NULL, uniqid());
    }
    
    public function changeEstado(){
        $result = 0;
        $id = $this->input->post('id');
        $icon = $this->input->post('icon');
        if($id>0){
            $this->modulo->getRow($id);
            if($this->modulo->mod_id > 0){
                if($this->modulo->mod_estado == 1){
                    $this->modulo->mod_estado = 0;
                    $icon = 'fa-ban';
                }else{
                    $this->modulo->mod_estado = 1;
                    $icon = 'fa-check';
                }
                $this->modulo->update();
                $result = 1;
            }
        }
        echo json_encode(array('respuesta'=>$result, 'icon'=>$icon));
    }
}

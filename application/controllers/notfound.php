<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of 404
 *
 * @author julio
 */
class Notfound extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $usuario = $this->session->userdata('user');
        if(isset($usuario) && $usuario > 0){
            $this->smartyci->assign('listado', '404');
            $this->smartyci->assign('details', '404');
            $this->smartyci->show_page('notfound_index.tpl', uniqid());
        }else{
            $this->smartyci->maintpl = 'mainClear';
            $this->smartyci->show_page('notfound_index_without.tpl', uniqid());
        }
    }
}

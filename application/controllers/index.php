<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author julio
 */
class Index extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index($error = 0){
        $this->login($error);
    }
    public function login($error = 0){
        $this->smartyci->maintpl = "mainClear";
        $this->smartyci->assign('error', $error);
        
        $this->smartyci->show_page(NULL,  uniqid());
    }
    
}

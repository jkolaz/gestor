<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seguridad
 *
 * @author julio
 */
class Seguridad extends CI_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('seguridad/administrador_model', 'adm');
    }
    
    public function ingresar_sistema(){
        $user    = $this->input->post('username', TRUE);
        $password   = $this->input->post('pwd', TRUE);
        $objAdm = $this->adm->validateUsuario($user, $password);
        $input = array();
        $input['user'] = $user;
        $input['password'] = $password;
        $permitir = FALSE;
        if($objAdm){
            
            if(is_array($objAdm) && $user == $objAdm[0]->adm_nick && md5($password) == $objAdm[0]->adm_password){
                $this->setMessage('OK001');
                $this->writeLog("Inició session", $objAdm[0]->adm_id);
                $arreglo = array();
                $permitir = TRUE;
                
                $arreglo['user'] = $objAdm[0]->adm_id;
                $arreglo['usuario'] = $objAdm[0]->adm_nombre.' '.$objAdm[0]->adm_apellidos;
                $arreglo['user'] = $objAdm[0]->adm_nick;
                $arreglo['correo'] = $objAdm[0]->adm_correo;
                $arreglo['idRol'] = $objAdm[0]->ta_id;
                $arreglo['rol'] = $objAdm[0]->ta_nombre;
                $this->session->set_userdata($arreglo);
                if($permitir == TRUE){
                    redirect(URL_PANEL);
                }else{
                    redirect(URL_NO_LOGIN);
                }
            }else{
                $this->setMessage('ERR001');
                $this->session->set_userdata($input); 
                redirect(URL_NO_LOGIN);
            }
        }else{
            $this->session->set_userdata($input); 
            redirect(URL_NO_LOGIN);
        }
    }
    
    public function logout(){
        $usuario = $this->session->userdata('usuario');
        $this->writeLog("Cerró session");
        $arreglo = array();
        $arreglo['user'] = '';
        $arreglo['usuario'] = '';
        $arreglo['correo'] = '';
        $arreglo['correo'] = '';
        $arreglo['idRol'] = '';
        $arreglo['rol'] = '';
        $this->session->unset_userdata($arreglo);
        redirect();
    }
}

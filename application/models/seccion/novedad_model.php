<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of novedad_model
 *
 * @author julio
 */
class Novedad_model extends CI_Model{
    //put your code here
    private static $_table;
    private static $_PK;
    public $nov_id;
    public $nov_titulo;
    public $nov_subtitulo;
    public $nov_youtube;
    public $nov_issuu;
    public $nov_destacada;
    public $nov_imagen;
    public $nov_contenido;
    public $nov_estado;
    public $nov_sed_id;
    public $nov_listado;
    public $nov_contactenos;
    public $nov_fecha_publicacion;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        self::$_table = 'gc_novedad';
        self::$_PK = 'nov_id';
    }
    
    public function getAll($where = array()){
        $where['nov_estado <='] = 1;
        
        $query = $this->db->where($where)->order_by('nov_fecha_publicacion', 'desc')->get(self::$_table);
        
        if($query->num_rows > 0){
            return $query->result();
        }
        return NULL;
    }
    
    public function getValsForm($post){
        if(isset($post['txt_nov_titulo'])){
            $this->nov_titulo = $post['txt_nov_titulo'];
        }
        if(isset($post['txt_nov_subtitulo'])){
            $this->nov_subtitulo = $post['txt_nov_subtitulo'];
        }
        if(isset($post['txt_nov_listado'])){
            $this->nov_listado = $post['txt_nov_listado'];
        }
        if(isset($post['txt_nov_contactenos'])){
            $this->nov_contactenos = $post['txt_nov_contactenos'];
        }
        if(isset($post['txt_nov_youtube'])){
            $this->nov_youtube = $post['txt_nov_youtube'];
        }
        if(isset($post['txt_nov_issuu'])){
            $this->nov_issuu = $post['txt_nov_issuu'];
        }
        if(isset($post['txt_nov_destacada'])){
            $this->nov_destacada = $post['txt_nov_destacada'];
        }
        if(isset($post['txt_nov_imagen'])){
            $this->nov_imagen = $post['txt_nov_imagen'];
        }
        if(isset($post['txt_nov_contenido'])){
            $this->nov_contenido = $post['txt_nov_contenido'];
        }
        if(isset($post['txt_nov_estado'])){
            $this->nov_estado = $post['txt_nov_estado'];
        }
        if(isset($post['txt_nov_sed_id'])){
            $this->nov_sed_id = $post['txt_nov_sed_id'];
        }
        if(isset($post['txt_nov_fecha_publicacion'])){
            $this->nov_fecha_publicacion = $post['txt_nov_fecha_publicacion'];
        }
    }
    public function insert(){
        $insert = array();
        if($this->nov_titulo != ""){
            $insert['nov_titulo'] = $this->nov_titulo;
        }
        if($this->nov_subtitulo != ""){
            $insert['nov_subtitulo'] = $this->nov_subtitulo;
        }
        if($this->nov_listado != ""){
            $insert['nov_listado'] = $this->nov_listado;
        }
        if($this->nov_contactenos != ""){
            $insert['nov_contactenos'] = $this->nov_contactenos;
        }
        if($this->nov_youtube != ""){
            $insert['nov_youtube'] = $this->nov_youtube;
        }
        if($this->nov_issuu != ""){
            $insert['nov_issuu'] = $this->nov_issuu;
        }
        if($this->nov_destacada >= 0){
            $insert['nov_destacada'] = $this->nov_destacada;
        }
        if($this->nov_imagen != ""){
            $insert['nov_imagen'] = $this->nov_imagen;
        }
        if($this->nov_fecha_publicacion != ""){
            $insert['nov_fecha_publicacion'] = $this->nov_fecha_publicacion;
        }
        if($this->nov_contenido != ""){
            $insert['nov_contenido'] = $this->nov_contenido;
        }
        if($this->nov_estado >= 0){
            $insert['nov_estado'] = $this->nov_estado;
        }
        if($this->nov_sed_id >= 0){
            $insert['nov_sed_id'] = $this->nov_sed_id;
        }
        
        if(count($insert)>0){
            $this->db->insert(self::$_table, $insert);
            $this->nov_id = $this->db->insert_id();
            return TRUE;
        }
        return FALSE;
    }
    
    public function getRow($id){
        $where['nov_id'] = $id;
        $where['nov_estado <='] = 1;
        $query = $this->db->where($where)->get(self::$_table);
        if($query->num_rows > 0){
            $arreglo = $query->result();
            $this->nov_id = $arreglo[0]->nov_id;
            $this->nov_titulo = $arreglo[0]->nov_titulo;
            $this->nov_subtitulo = $arreglo[0]->nov_subtitulo;
            $this->nov_listado = $arreglo[0]->nov_listado;
            $this->nov_contactenos = $arreglo[0]->nov_contactenos;
            $this->nov_youtube = $arreglo[0]->nov_youtube;
            $this->nov_issuu = $arreglo[0]->nov_issuu;
            $this->nov_destacada = $arreglo[0]->nov_destacada;
            $this->nov_imagen = $arreglo[0]->nov_imagen;
            $this->nov_contenido = $arreglo[0]->nov_contenido;
            $this->nov_estado = $arreglo[0]->nov_estado;
            $this->nov_sed_id = $arreglo[0]->nov_sed_id;
            $this->nov_fecha_publicacion = $arreglo[0]->nov_fecha_publicacion;
        }
    }
    public function update(){
        $update = array();
        if($this->nov_titulo != ""){
            $update['nov_titulo'] = $this->nov_titulo;
        }
        if($this->nov_subtitulo != ""){
            $update['nov_subtitulo'] = $this->nov_subtitulo;
        }
        if($this->nov_listado != ""){
            $update['nov_listado'] = $this->nov_listado;
        }
        if($this->nov_contactenos != ""){
            $update['nov_contactenos'] = $this->nov_contactenos;
        }
        if($this->nov_fecha_publicacion != ""){
            $update['nov_fecha_publicacion'] = $this->nov_fecha_publicacion;
        }
        if($this->nov_youtube != ""){
            $update['nov_youtube'] = $this->nov_youtube;
        }
        if($this->nov_issuu != ""){
            $update['nov_issuu'] = $this->nov_issuu;
        }
        if($this->nov_destacada >= 0){
            $update['nov_destacada'] = $this->nov_destacada;
        }
        if($this->nov_imagen != ""){
            $update['nov_imagen'] = $this->nov_imagen;
        }
        if($this->nov_contenido != ""){
            $update['nov_contenido'] = $this->nov_contenido;
        }
        if($this->nov_estado >= 0){
            $update['nov_estado'] = $this->nov_estado;
        }
        if($this->nov_sed_id >= 0){
            $update['nov_sed_id'] = $this->nov_sed_id;
        }
        
        if($this->nov_id > 0){
            if(count($update)>0){
                $this->db->where(self::$_PK,  $this->nov_id)->update(self::$_table, $update);
                return TRUE;
            }
            return NULL;
        }
        return NULL;
    }
}

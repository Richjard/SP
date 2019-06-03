<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Principal extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
 public function index() {  
     if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/principal';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='APP PATRIMONIO'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu',);
          $this->load->view('includes/template',$datos);
     }else{
         redirect(base_url(), 'refresh');
         
       }
 }
}
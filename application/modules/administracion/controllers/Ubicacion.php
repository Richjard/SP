<?php


class Ubicacion extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct(); 
 }
public function index() { //escogjer ubicacion hay q epasularlo verificacion_bienes
    if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/ubicacion';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='ESCOGER UBICACION'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/ubicacion','assets/administracion/menu','assets/administracion/jquery.mask');
          $this->load->view('includes/template',$datos);
    }else{
      redirect(base_url(), 'refresh');

    }
   
 }
 public function all() {  
          $datos['app_url']      =base_url();
          $this->load->view('administracion/ubicacion',$datos);
   
 }
}
<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Interfaz extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/model_all', 'ma');
        // $this->load->model('index_model');
    }

    public function index()
    {

      if($this->session->userdata('logged_in')==TRUE){
        $datos['contenido'] = 'cajero/cajero';
        $datos['app_url'] = base_url();
        $datos['titulo'] = 'CARLNET PLAY';
        $datos['JS_PROPIO_VIEW'] = array(
            'assets/administracion/datasource',
            'assets/administracion/js_configuracion'
        );

        $this->load->view('includes_cajero/template', $datos);
        
      }else{
         redirect(base_url(), 'refresh');
         
       }
    }

}
/*
*end modules/login/controllers/index.php
*/
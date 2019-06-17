<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');


class User{
    private $usuario; // numero de la tarjeta
    private $pass; // pin de la tarjeta
    public function __construct($usuario,$pass)
    {
        $this->usuario=$usuario;
        $this->pass=$pass;
         $this->CI =& get_instance();
    }
    //metodos
    public function login($return_all_data=false)
    {        
        /*if( empty($data['password']) ) {
            return $this->error = 'Data password is emptty';
        }*/
        //$data['password'] = $this->crypt( $data['password'] );
        $check= $this->CI->db->get_where("usuarios", array('usuario' => $this->usuario,'clave' => $this->pass));       
        if( $check->num_rows() == 0 ) {
            return false;            
        }
        $Q = $check->row();
        $check->free_result();
      //  print_r($Q);
        /*if($Q->status == 0) {
            //if banned
            return false;
        }*/
        $this->CI->session->set_userdata(array(
            'Usuario' => $Q->nombres.", ".$Q->apellidos,
            'idusuario' => $Q->idusuarios,
            //'status' => $Q->status,
            'logged_in' => true
        ));
        if($return_all_data) {
            return $Q;
        } else {
            return true;
        }
    }
    public function log_out(){
        $this->CI->session->unset_userdata('logged_in');
    }
    public function get_pin(){
        return $this->pin_tarjeta;
    }
}

class Login extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/model_all', 'ma'); 
    }

    public function index()//index es igual que decir main
    {
 if($this->session->userdata('logged_in')==FALSE){
        // if($this->session->userdata('logged')==TRUE){
        //$datos['contenido'] = 'login/login';
        $datos['app_url'] = base_url();
        $datos['titulo'] = 'APP PATRIMONIO';
        $datos['CSS'] = array(
            'assets/login/main'
        );
        $datos['JS_PROPIO_VIEW']    =array();

        $this->load->view('login/login', $datos);
        /*
         * }else{
         *
         * redirect(base_url('login/autenteficacion'), 'refresh');
         * }
         */
    } else {
         redirect(base_url('administracion/principal'));
    }
    }
    //mentods getter
    public function validate(){
            $parameters = $this->input->post();              
           $user= $parameters['usuario'];
           $pass= $parameters['pass'];           
           $user_login = new User($user,$pass);
           $return="not";           
           if($user_login->login()==true){
               $return="yes";
           }
          
           header("Content-type: application/json");
          echo  json_encode($return); 

          // echo $user_login->get_pin();           
           /*if($user_login->login()==true){
               redirect(base_url('administracion/principal'));
           }else{
               redirect(base_url());
           }*/
    }
    public  function salir(){
          $user_login = new User(0,0);
          $user_login->log_out();
         redirect(base_url());
    }
    /* public function get_pin(){
        return $this->pin;
    }*/
   /* public function get__num_tarjeta(){
        return $this->num_tarjeta;
    }*/
    
    //metodos setter
    
   /* public  function set_pit($pin){
        $this->pin=$pin;
    }*/
            
}
class Coche {
    public $color;

    public function __construct($color)
    {
        $this->color = $color;
    }
}


/*
*end modules/login/controllers/index.php
*/
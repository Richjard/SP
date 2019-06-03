<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
include ("crud.php");
class Cuentas{
   /* private $num_cuenta; // numero de la tarjeta
    private $saldo; // pin de la tarjeta*/
   // private $datos['titulo'];
   // private  $cuentas_all=array();
    public static $limite=300;
    private $register_cuentas;//array tipo result
    private $register_cuentas_row=array();//array para un solo elemento
    private  $tabla='cuentas';
    private  $tabla_='cuenta';
    private $saldo;
    public function __construct($id_cliente="",$id_cuenta="")
    {
        /*$this->num_cuenta=$num_cuenta;
        $this->saldo=$saldo;*/
         if($id_cliente<>""){
         $params = array(
          'tabla' =>$this->tabla,
          'filtro'=>'idUSUARIO_BANCO='.$id_cliente.''
        );
        $getResult = new Crud($params);     
        $this->register_cuentas=$getResult->getRegisterResult();
         }
        //row
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        if($id_cuenta<>""){
            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"NRO_CUENTA='".$id_cuenta."'"              
          );
          $getRow = new Crud($params);    
          $cuenta_row=$getRow->getRegisterRow();
          if($cuenta_row){
              $this->register_cuentas_row=$cuenta_row;
              $this->saldo=$this->register_cuentas_row->SALDO; 
          }
          
           
        }
         
    }
    //mentodos
    public function get_user_cuentas(){
        return $this->register_cuentas;
       
    }
    public function get_user_cuenta_row(){
        return $this->register_cuentas_row;
       
    }   
    public function get_saldo(){
        return $this->saldo;
        
    }
    public function set_saldo($monto,$op){
        if($op==1){
            $saldo_actual= $this->get_saldo()-$monto;
        }
        if($op==2){
            $saldo_actual= $this->get_saldo()+$monto;
        }
        if($op==3){
            $saldo_actual= $this->get_saldo()-$monto;
        }
       
        $params = array(
          'tabla' => $this->tabla_,
          "filtro"=>"NRO_CUENTA='".$this->get_user_cuenta_row()->NRO_CUENTA."'",
          'campos_values_update'=>"SALDO=$saldo_actual"
        );
        $update_register = new Crud($params);     
        $update_register->update();
    }
}

class Cuenta extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/model_all', 'ma');
        // $this->load->model('index_model');
    }

    public function ver_cuentas($op)
    {

      if($this->session->userdata('logged_in')==TRUE){
        $datos['contenido'] = 'cajero/cuenta';
        $datos['app_url'] = base_url();
        $datos['titulo'] = 'CARLNET PLAY';
        $datos['JS_PROPIO_VIEW'] = array(
            'assets/administracion/datasource',
            'assets/administracion/js_configuracion'
        );
       
        $datos['op'] = $op;
       
        $cuentas_user = new Cuentas($this->session->userdata("id_cliente"));
        
        $datos["cuentas"]=$cuentas_user->get_user_cuentas();
        $this->load->view('includes_cajero/template', $datos);
        
      }else{
         redirect(base_url(), 'refresh');
         
       }
    }
    public function operaciones($op,$cuenta){        
        if($this->session->userdata('logged_in')==TRUE){
        $datos['contenido'] = 'cajero/cuenta_form';
        $datos['app_url'] = base_url();
        $datos['titulo'] = 'CAJERO';
        $datos['JS_PROPIO_VIEW'] = array(
            'assets/administracion/datasource',
            'assets/administracion/js_configuracion'
        );       
          switch($op) {
            case 1:
                $datos['operacion']="RETIRO" ;
                break;
            case 2:
                $datos['operacion'] ="INGRESO";
                break;
            case 3:
                $datos['operacion'] ="TRANSFERENCIA";
                break;   
        }
        $user_cuenta = new Cuentas($this->session->userdata("id_cliente"),$cuenta);
        $datos["nro_cuenta"]=$user_cuenta->get_user_cuenta_row()->NRO_CUENTA;
        $datos["tipo_cuenta"]=$user_cuenta->get_user_cuenta_row()->DSC;   
        $datos["op"]=$op;
        $datos["cuenta"]=$cuenta;
        $this->load->view('includes_cajero/template', $datos);        
      }else{
         redirect(base_url(), 'refresh');
         
       }
    }

    public function consulta_cuenta($cuenta){
        $cuenta_= new Cuentas("",$cuenta);
        $row=$cuenta_->get_user_cuenta_row();
        
        $to1tal=1;
        header("Content-type: application/json");
        echo  "{\"data\":" .json_encode($row). ",\"total\":".$to1tal."}";
    }
    
    
    
}
/*
*end modules/login/controllers/index.php
*/
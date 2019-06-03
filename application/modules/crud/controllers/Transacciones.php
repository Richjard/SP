<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');
include ("cuenta.php"); 
class Transacciones_{
   /* private $num_cuenta; // numero de la tarjeta
    private $saldo; // pin de la tarjeta*/
   // private $datos['titulo'];
   // private  $cuentas_all=array();
    public static $limite = 300;
    private $register_transaccion;//array tipo result
    private $register_transaccion_row;//array para un solo elemento
    private $transaccions_sum_dia;//OBTENEMOS SUM TOTAL DE TRANSACCCION
    private  $tabla='v_transaccion';//vistas
    private  $tabla_="transaccion";//tabla
    private $num_cuenta;
    private $id_cliente;
    public function __construct($id_cliente,$id_cuenta="")
    {        
        $this->id_cliente=$id_cliente;
        $this->num_cuenta=$id_cuenta;
        /*$this->num_cuenta=$num_cuenta;
        $this->saldo=$saldo;*/
        $ci_t =& get_instance();
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
         $params = array(
          'tabla' =>$this->tabla   
        );
        $ci_t->load->library('Crud', $params, 'crud');
        $this->register_cuentas=$ci_t->crud->getRegisterResult();        
        //row
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        $params = array(
          'tabla' => $this->tabla,
          "filtro"=>"NRO_CUENTA=".$id_cuenta.""              
        );
        $ci_t->load->library('Crud', $params, 'crud');
        $this->register_transaccion_row=$ci_t->crud->getRegisterRow();
        
      
        
    }
    //mentodos
    public function get_user_transacciones(){
        return $this->register_cuentas;
       
    }
    public function get_user_transaccion_row(){
        return $this->register_cuentas_row;
       
    }
    public  function get_suma_trans($tipo_trans,$fecha){
       echo "aa";
        $params = array(
            'tabla' => $this->tabla,
            'filtro'=> 'idTIPO_TRANSACCION='.$tipo_trans.' AND FECHA="'.$fecha.'" AND NRO_CUENTA="'.$this->num_cuenta.'" AND idUSUARIO_BANCO='.$this->id_cliente
            
        );
        $query_sum_trans=new Crud($params);
        if($query_sum_trans->getRegisterRow()){
                return $query_sum_trans->getRegisterRow()->sum;
              
        }else{
            return 0;
        }
        
    }
    
    public function set_retirar_dinero($monto,$op){
       
           $hoy = date("Y-m-d");           
           switch($this->transaccion_condicion($monto,$op)) {
            case 1:
                $params = array(
                'tabla' => $this->tabla_ ,
                "filtro"=>"NRO_CUENTA=".$this->num_cuenta."",
                'campos' => "NRO_CUENTA,idUSUARIO_BANCO,idTIPO_TRANSACCION,CANTIDAD,FECHA",
                "values"=>"".$this->num_cuenta.",".$this->id_cliente.",1,".$monto.",'".$hoy."'"
                    
                    );
                $transaccion_retirar_dinero= new Crud($params);
                
                //enviamos monto a cuenta para recalcular el saldo
                //
                $cuenta = new Cuentas($this->id_cliente, $this->num_cuenta);
                $cuenta->set_saldo($monto,$op);
                //$ci->crud->insert($params_);
              
                return "OPERACION EXITOSA. [ NRO OP:".$transaccion_retirar_dinero->insert()." ]";
                break;
            case 2:
                return "SOBRE PASA EL LIMITE DE RETIRO POR DIA QUE ES s/300";
                break;
            case 3:
                return "NO HAY SALDO SUFICIENTE";
                break;   
        }
    }
        public function set_ingresar_dinero($monto,$op){
            //ingresar el monto en la base de datos
            $hoy = date("Y-m-d"); 
            $params= array(
                "tabla"=>$this->tabla_,
                "filtro"=>"NRO_CUENTA=$this->num_cuenta AND idUSUARIO_BANCO=$this->id_cliente",
                'campos' => "NRO_CUENTA,idUSUARIO_BANCO,idTIPO_TRANSACCION,CANTIDAD,FECHA",
                "values"=>"".$this->num_cuenta.",".$this->id_cliente.",2,".$monto.",'".$hoy."'"
                
            );
            $transaccion_ingreso_dinero = new Crud($params);
            $n_op = $transaccion_ingreso_dinero->insert();
            if($n_op<>false ){
                $cuenta_ = new Cuentas($this->id_cliente,$this->num_cuenta);
                $cuenta_->set_saldo($monto, $op);
                return "SE HA INGRESADO SATISFACTORIAMENTE EL MONTO DE s/.".$monto."<br> NRO OPERACION :".$n_op;
            }else{
                    return false;
                }
        }
        
      
        public function set_transaccion_dinero($monto,$op,$cuentaDestino,$id_usuario2){
            //ingresar el monto en la base de datos
            $hoy = date("Y-m-d"); 
            $params= array(
                "tabla"=>$this->tabla_,
                "filtro"=>"NRO_CUENTA=$this->num_cuenta AND idUSUARIO_BANCO=$this->id_cliente",
                'campos' => "NRO_CUENTA,idUSUARIO_BANCO,idTIPO_TRANSACCION,CANTIDAD,FECHA,NRO_CUENTA_TRAFERENCIA,idUSUARIO_BANCO2_TRAFERENCIA",
                "values"=>"".$this->num_cuenta.",".$this->id_cliente.",3,".$monto.",'".$hoy."',".$cuentaDestino.",".$id_usuario2.""
                
            );
            $transaccion_ingreso_dinero = new Crud($params);
            $n_op = $transaccion_ingreso_dinero->insert();
            if($n_op<>false ){
                $cuenta_ = new Cuentas($this->id_cliente,$this->num_cuenta);
                $cuenta_->set_saldo($monto, $op);
                $cuenta_trans = new Cuentas($id_usuario2,$cuentaDestino);
                $cuenta_trans->set_saldo($monto,2);//le esta ingresando ala cuenta que se transfiere
                return "SE HA TRANSFERIDO SATISFACTORIAMENTE EL MONTO DE s/.".$monto."<br> NRO OPERACION :".$n_op;
            }else{
                    return false;
                }
        }
    
    
    private function transaccion_condicion($monto,$op){
        //consultamos las operaciones del dia
        //$x=1;//
       $cuenta = new Cuentas($this->id_cliente, $this->num_cuenta);
       if($cuenta->get_saldo()>=$monto){
          // return false;
           //$sum_transacccion_ new 
           $hoy = date("Y-m-d");
      //     print_r($this->get_suma_trans($op,$hoy));
          $sum=$this->get_suma_trans($op,$hoy);            
           if($sum<>""){        
                $sub_total=$sum+$monto;
                if($sub_total <= self::$limite ){              
                    return 1;//TRANSACCION AUTORIZADA
                }else{                        
                     return 2;//SUPERA EL LIMITE DIARIO
                }
            }else{
                return 1;//TRANSACCION AUTORIZADA
            }
       }else{
          return 3;//"NO HAY SALDO"
           
       }           
    }
}

class Transacciones extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('administracion/model_all', 'ma');
        // $this->load->model('index_model');
    }
    
    public function transaccion($op){ 
       $parameters = $this->input->post();              
       $monto= $parameters['monto'];
       $cuenta= $parameters['cuenta'];
       if($monto==""){
           $monto=0;
           
           redirect(base_url('cajero/cuenta/operaciones/'.$op.'/'. $cuenta), 'refresh');
       } 
       if($op==1){//retIRTO DE DINERO
           $transaccion_ = new Transacciones_($this->session->userdata("id_cliente"),$cuenta);
           $msg=$transaccion_->set_retirar_dinero($monto,$op);
       }
       if($op==2){//INGRESAR DINERO
           $transaccion_ = new Transacciones_($this->session->userdata("id_cliente"),$cuenta);
           $msg=$transaccion_->set_ingresar_dinero($monto,$op);
       }
       if($op==3){//INGRESAR DINERO
           $id_usuario2= $parameters['id_usuario2'];
           $cuentaDestino= $parameters['cuentaDestino'];
                     
           $transaccion_ = new Transacciones_($this->session->userdata("id_cliente"),$cuenta);
           $msg=$transaccion_->set_transaccion_dinero($monto,$op,$cuentaDestino,$id_usuario2);
       }
       
        $data = array('op'=>$op,'cuenta'=>$cuenta,'msg'=>$msg);
        // i store data to flashdata
        $this->session->set_flashdata($data);
        // after storing i redirect it to the controller
       // redirect('transacciones/exito_transaccion');
      
        redirect(base_url('cajero/transacciones/exito_transaccion/'), 'refresh');
       //$this->exito_transaccion($op,$monto,);
     
      // 
        
      
       /*if($transaccion_->set_retirar_dinero($monto)==true){
           $this->exito_transaccion($op,$monto);
             // redirect(base_url('cajero/transacciones/exito_transaccion/'.$op.'/'.$monto), 'refresh');
          
       }else{
          // redirect(base_url('cajero/transacciones/error_transaccion/'.$op.'/'.$monto), 'refresh');
            $this->error_transaccion($op,$monto);
       }*/
      
  }  
  public function exito_transaccion(){      
        if($this->session->userdata('logged_in')==TRUE ){           
        //$dato_=$this->session->flashdata();
        $op=$this->session->flashdata("op"); 
        $monto=$this->session->flashdata('monto'); 
        $msg=$this->session->flashdata('msg'); 
        if($op==""){
            redirect(base_url(), 'refresh');
        
        }else{
                   $datos['contenido'] = 'cajero/exito_transaccion';
        
        $datos['app_url'] = base_url();
        $datos['titulo'] = 'CAJERO';
        $datos['JS_PROPIO_VIEW'] = array(
            'assets/administracion/datasource',
            'assets/administracion/js_configuracion'
        );       
          switch($op) {
            case 1:
                $datos['operacion']="RETIRO" ;
                $datos['msg_']="INGRESE EL MONTO A RETIRAR" ;
                break;
            case 2:
                $datos['operacion'] ="INGRESO";
                $datos['msg_']="INGRESE EL MONTO A INGRESAR" ;
                break;
            case 3:
                $datos['operacion'] ="TRANSFERENCIA";
                $datos['msg_']="INGRESE EL MONTO A TRANSFERIR" ;
                break;   
        }
       // $user_cuenta = new Cuentas($this->session->userdata("id_cliente"),$cuenta);
       // $datos["nro_cuenta"]=$user_cuenta->get_user_cuenta_row()->NRO_CUENTA;
       // $datos["tipo_cuenta"]=$user_cuenta->get_user_cuenta_row()->DSC;   
        $datos["op"]=$op;
        $datos["monto"]=$monto;
        $datos["msg"]=$msg;
       // $datos["cuenta"]=$cuenta;
        $this->load->view('includes_cajero/template', $datos);  
       // redirect(base_url('cajero/transacciones/exito_transaccion/'.$op.'/'.$transaccion_->set_retirar_dinero($monto)), 'refresh');
     
            }
    
      }else{
         redirect(base_url(), 'refresh');
         
       }
  }

      
 
}    

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
include_once ("Bienes.php");



class Veb{   //clase verificacion existencial d ebienes  ---CLASE INTERNET

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='verificacion_existencial_bien'; //tabla 
   // private $vista='v_bienes';  //vista
    private $idformato_registro_bien = "";
    private $idanio = ""; 
    private $estado = "";   
    private $reg_total="";
    private $idusuario="";
    
    public function __construct($id="",$anio="",$estado,$param=array(),$idusuario="")
    {      
       $this->idanio=$anio;
       $this->idusuario=$idusuario; 
       $this->idformato_registro_bien=$id; 
       $this->estado=$estado; 
         if(isset($param['skip'])){
          if(isset($param['filtro'])){
             $params = array(
                'tabla' =>$this->vista,    
                'skip' =>$param['skip'],
                'top'=>$param['top'],
                'filtro'=>$param['filtro'],
                'order'=>$param['order']
              ); 
             $params_total = array(
                'tabla' =>$this->tabla,
                'filtro'=>$param['filtro']
              );
             // print_r($params);
          }else{
            $params = array(
                'tabla' =>$this->vista,    
                'skip' =>$param['skip'],
                'top'=>$param['top'],
                'order'=>$param['order']
              );  
            $params_total = array(
                'tabla' =>$this->vista,  
              );
          }
        
        $getResult = new Crud($params);     
        $this->registros=$getResult->getRegisterResult();
        
        
        $getTotal = new Crud($params);     
        $this->reg_total=$getTotal->getTotal();
         }
              
            
        //row
        //
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        if($this->idformato_registro_bien<>""){   
          $this->verificar_si_esta_registrado_en_la_tabla();         
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idformato_registro_bien='".$this->idformato_registro_bien."' and idanio='".$this->idanio."'"              
          );
          $getRow = new Crud($params);    
          $_row=$getRow->getRegisterRow();
          if($getRow){
              $this->registro_row=$_row;
          }  
        }  
        
       
         
    }
    //mentodos
    public function get_registros(){
        return $this->registros;
       
    }   
    public function get_registro_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function get_estado(){
      return $this->registro_row->estado;
    }
    public function verificar_bien(){  
        $params = array(
            'tabla' => $this->tabla,
            'filtro'=>' idformato_registro_bien='.$this->idformato_registro_bien.' and idanio='.$this->idanio,
            'campos_values_update'=>
               "estado='".$this->estado."', idusuarios='".$this->idusuario
               ."'"
          );
        $update_register = new Crud($params);     
        $update_register->update();
       
    } 
    private function verificar_si_esta_registrado_en_la_tabla(){
       //verificamos si existe en la tabla
            $params = array(
                'tabla' => $this->tabla,
                "filtro"=>" idformato_registro_bien=$this->idformato_registro_bien and idanio=$this->idanio" ,
              );
            $existe_registro = new Crud($params);    
            if(!$existe_registro->getRegisterRow()){  //si no existe lo creamos
               $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "idformato_registro_bien,idanio,estado,idusuarios",
                "values"=>'"'.$this->idformato_registro_bien.'","'
                          .$this->idanio.'","F","'
                          .$this->idusuario.' "'                                      
               );
              $insert = new Crud($params);
              $id_new = $insert->insert();  
            }  
    }
    
}


class Verificacion_de_bienes extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct(); 
 }
public function index() { //escogjer ubicacion hay q epasularlo verificacion_bienes
    if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/verificacion_de_bienes';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='VERIFICACION DE BIENES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/verificacion_bienes','assets/administracion/menu','assets/administracion/jquery.mask');
          $this->load->view('includes/template',$datos);
    }else{
      redirect(base_url(), 'refresh');

    }
   
 }

 /*public function mostrar_grilla_bienes($id_oficina=""){
  $this->load->view("grilla_operaciones");
 }*/

  public function grilla_operaciones($id_oficina="") {          
          $datos['contenido']    ='administracion/grilla_operaciones_verificacion_de_bienes';         
          $datos['app_url']      =base_url();
          $datos['id_oficina']      =$id_oficina;
          $datos['titulo']       ='VERIFICACION EXISTENCIAL DE BIENES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/grilla_operaciones_verificacion_bienes');
          
          $this->load->view('includes/template',$datos);
   
 }

 public function grilla_operaciones_all($id_oficina="") {                 
          $datos['app_url']      =base_url();   
           $datos['id_oficina']      =$id_oficina;
          $this->load->view('administracion/grilla_operaciones_verificacion_de_bienes',$datos); 
 }

 public function verificar_por_codigo(){

 }
 public function verificar_todos($idOficina=""){
  $data = $this->input->post('data'); 
  $this->marcar_desmarcar($idOficina,2019,"T",$data);

  
 }
 public function desverificar_todos($idOficina=""){
    $data = $this->input->post('data'); 
  $this->marcar_desmarcar($idOficina,2019,"F",$data);
 }

 private function marcar_desmarcar($idOficina,$anio,$estado,$data){//verificar
    //verificamos todos
    //obtenemos todos los bienes de la oficina   
     /*$param=array();
     $data = new Bien("",$param,$this->session->userdata('idusuario'));
     $registros=$data->get_registros_filtro_por_oficina($idOficina);*/
     if($data){
        foreach ($data as $d) {
           $param=array();
           $data = new Veb($d["idformato_registro_bien"],$anio,$estado,$param,$this->session->userdata('idusuario'));
           $verificacion=$data->verificar_bien();
        }
     }
 }
/*public function all($id_oficina="") {   
          $datos['app_url']      =base_url();
          $this->load->view('administracion/plan_contables_all',$datos);
   
 }*/
 
}
/*
*end modules/login/controllers/index.php
*/
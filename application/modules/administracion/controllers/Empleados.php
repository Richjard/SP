<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Empleado{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='empleado'; 
    private $tabla_='v_empleados'; 
    private $vista='v_empleados_oficina'; 
    private $nombres="";
    private $apellidos="";
    private $idempleado="";
    private $condicion="";
    private $reg_total="";
    
    public function __construct($id="",$param=array())
    {       
       if(isset($param['skip'])){
          if(isset($param['filtro'])){
             $params = array(
                'tabla' =>$this->tabla,    
                'skip' =>$param['skip'],
                'top'=>$param['top'],
                'filtro'=>$param['filtro']
              ); 
             $params_total = array(
                'tabla' =>$this->tabla,
                'filtro'=>$param['filtro']
              );
             // print_r($params);
          }else{
            $params = array(
                'tabla' =>$this->tabla,    
                'skip' =>$param['skip'],
                'top'=>$param['top']
              );  
            $params_total = array(
                'tabla' =>$this->tabla,  
              );
          }
        
        $getResult = new Crud($params);     
        $this->registros=$getResult->getRegisterResult();
        
        
        $getTotal = new Crud($params);     
        $this->reg_total=$getTotal->getTotal();
         }
        //row
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        if($id<>""){            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idempleado='".$id."'"              
          );
          $getRow = new Crud($params);    
          $_row=$getRow->getRegisterRow();
          if($getRow){
              $this->registro_row=$_row;
          }  
        }

         
    }
    //mentodos
    public function get_result(){
        return $this->registros;
       
    }
    public function get_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_row($data_request = array()){
        $this->idempleado=$data_request['id_empleado_crud'];
        $this->nombres=$data_request['nombre_empleado'];
        $this->apellidos=$data_request['apellidos_empleado'];
        $this->condicion=$data_request['condicion_empleado'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "nombres,apellidos,condicion",
                "values"=>'"'.$this->nombres.'","'.$this->apellidos.'","'.$this->condicion.'"'                
            );
            $insert = new Crud($params);
            $id_empleado_new = $insert->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idempleado='".$this->idempleado."'",
                'campos_values_update'=>"nombres='".$this->nombres."', apellidos='".$this->apellidos."', condicion='".$this->condicion."'"
              );
             print_r($params);

            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idempleado='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
     public function set_registros_combo($id){           
             $params = array(
                'tabla' => $this->vista,
                "filtro"=>"idoficina='".$id."'",
              );
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
     public function set_registros_combo_($id=""){  
            if($id==""){
                 $params = array(
                'tabla' => $this->tabla_
               
              );
            }else{
                 $params = array(
                'tabla' => $this->tabla_,
                "filtro"=>"empleado like '%".$id."%'",
              );
            }
            
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
    
}


class empleados extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {  
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/empleados';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='EMPLEADOS'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/empleados');
          $this->load->view('includes/template',$datos);
              }else{
        redirect(base_url(), 'refresh');
      }
   
 }
 //CODIGO PARA DIRECTOR
  public function leerRegistro() {        
     if($_SERVER['REQUEST_METHOD']=="GET"){  
            $parameters = $this->input->get();//RECIBIMOS 3 PARAMETROS DE LA GRILLA            
            $paginas    = $parameters['$inlinecount'];//PARAMETRO PARA MOSTRAR TODAS LAS PAGINAS
            $skip       = $parameters['$skip'];//PARAMETRO PARA MOSTRAR DESDE DODNE MOSTRAR LOS REGISTROS
            $top        = $parameters['$top'];//PARAMETRO PARA MOSTRAR HASTA DQUE REGISTRO  EN MYSQL LIMIT  0, 12            
            if(isset($parameters['$filter'])){  
                
                $i=str_replace("(startswith(tolower("," ",$parameters['$filter']);
                $i=str_replace("),'"," LIKE '%",$i);
                $i=str_replace("'))","%' ",$i);  
                $i= str_replace("(tolower("," ",$i); 
                $i=str_replace(") eq '"," = '",$i);
                $i=str_replace("')","' ",$i);
                $i=str_replace("AND (idgrupos eq null)"," ",$i);
                $i=str_replace("(idgrupos eq null)"," EliminadoSis is null",$i);
                $i=str_replace("AND (idClases eq null)"," ",$i);
                $i=str_replace("(idClases eq null)"," EliminadoSis is null",$i);
                
                 
                $param=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL                    
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top, //HASTA 
                    //"filtro"=>"codigo LIKE '%{$parametro_busqueda[0]}%'" 
                    "filtro"=>"$i" 
                  );
            }else{
                $param=array(            
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top //HASTA 
                    //"order"=>"dtFechaSis  DESC"
                 );
            }               
            $registros_get = new Empleado("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'idempleado'=>$reg->idempleado,
                      'nombres'=>$reg->nombres,
                      'apellidos'=>$reg->apellidos,
                      'condicion'=>$reg->condicion,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }         
 }
 
public function form_() {    
   $this->load->view('administracion/form_empleado');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $empleado_ = new Empleado($id,"");
      $row_ = $empleado_->get_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_empleado_crud"=>$row_->idempleado,
              "nombre_empleado"=>$row_->nombres,
              "apellidos_empleado"=>$row_->apellidos,  
              "condicion_empleado"=>$row_->condicion,  
      ));
      
      
   }   
 public function guardar() {      
    $empleado_ = new Empleado("");
    $empleado_->set_row($_REQUEST);
     if($_REQUEST['id_empleado_crud']=="autogenerado"){
        $empleado_->guardar_en_bd();     
     }else{
        $empleado_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $empleados_ = new Empleado("");
       $empleados_->set_delete_virtual($id);
 }
 
  public function combo() {  
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro
            // print_r($parameters);
            $filtro= $parameters['$filter'];//FILTRO EN CADENA
            $porciones = explode(" ", $filtro);           
            $valor = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
            
            $data_ = new Empleado("","");           
            $data=$data_->set_registros_combo($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idempleado_oficina'=>$d->idempleado_oficina,                     
                      'descripcion'=>$d->apellidos.", ".$d->nombres,
                      'idoficina'=>$d->idoficina,
                    );
                }
              }             
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
 public function set_registros_combo_() {  
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro 
            $valor="";
            if(isset($parameters['$filter'])){
               $filtro= $parameters['$filter'];//FILTRO EN CADENA
               $porciones = explode(" ", $filtro);           
               $valor = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
              
            }
           
            $data_ = new Empleado("","");           
            $data=$data_->set_registros_combo_($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idempleado'=>$d->idempleado,                     
                      'descripcion'=>$d->empleado
                    );
                }
              }             
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
}
/*
*end modules/login/controllers/index.php
*/
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
class Empleado_as_oficina{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='empleado_oficina'; 
    private $vista='v_empleados_oficina';
    private $idempleado_oficina="";
    private $idoficina="";
    private $cargo="";
    private $idanio=2018;
    private $reg_total="";
    
    public function __construct($id="",$param=array())
    {       
      if(isset($param['skip'])){
          if(isset($param['filtro'])){
             $params = array(
                'tabla' =>$this->vista,    
                'skip' =>$param['skip'],
                'top'=>$param['top'],
                'filtro'=>$param['filtro']
              ); 
             $params_total = array(
                'tabla' =>$this->vista,
                'filtro'=>$param['filtro']
              );
             // print_r($params);
          }else{
            $params = array(
                'tabla' =>$this->vista,    
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
            'tabla' => $this->vista,
            "filtro"=>"idempleado_oficina='".$id."'"              
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
        $this->idempleado_oficina=$data_request['id_empleado_as_oficina_crud'];
        $this->idempleado=$data_request['empleado_combo_in_empleado_as_ofi'];
        $this->cargo=$data_request['cargo_empleado_as_ofi'];
        $this->idoficina=$data_request['oficina_combo_in_empleado_as_ofi'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "idempleado,idoficina,cargo,idanio",
                "values"=>'"'.$this->idempleado.'","'.$this->idoficina.'","'.$this->cargo.'","'.$this->idanio.'"'                
            );
            $insert_ = new Crud($params);
            $id_new = $insert_->insert();
       
    }
    public function modificar_en_bd(){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idempleado_oficina='".$this->idempleado_oficina."'",
                'campos_values_update'=>"idempleado='".$this->idempleado."', idoficina='".$this->idoficina."', cargo='".$this->cargo."'"
              );
            $update_register = new Crud($params);     
            $update_register->update();       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idempleado_oficina='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
     public function set_registros_combo($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"locales_idlocales='".$id."'",
              );
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
     public function set_registros_combo_($id="",$busqueda="",$idoficina=""){  
           
               
             if($busqueda==""){
                $params = array(
                'tabla' => $this->vista,
                 "filtro"=>"idoficina='".$id."'",
              );
               
            }else{
                $params = array(
                'tabla' => $this->vista,
                 "filtro"=>" empleado like '%".$busqueda."%' and idoficina='".$idoficina."'",
              );               
               
            }
           
            
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
      public function get_registros2($param=array()){   
           if(isset($param['filtro'])){
                $params = array(
                'tabla' => $this->vista,
                'filtro'=>$param['filtro']
              );
               
            }else{
                $params = array(
                'tabla' => $this->vista,
               // "filtro"=>"idgrupos='".$id."'",
                //'campos_values_update'=>"EliminadoSis=1"
              );            
               
            }    
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
}


class Empleados_as_oficina extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {   
     if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/empleados_as_oficina';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='ASIGNAR EMPLEADOS A OFICINA'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/empleados_as_oficina');
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
                $i=str_replace("AND (idlocales eq null)"," ",$i);
                $i=str_replace("(idlocales eq null)"," EliminadoSis is null",$i);
                $i=str_replace("AND (idarea eq null)"," ",$i);
                $i=str_replace("(idarea eq null)"," EliminadoSis is null",$i);               
                $i=str_replace("AND (idoficina eq null)"," ",$i);
                $i=str_replace("(idoficina eq null)"," EliminadoSis is null",$i);  
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
            $registros_get = new Empleado_as_oficina("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'idempleado_oficina'=>$reg->idempleado_oficina,
                      'nombres'=>$reg->nombres,
                      'apellidos'=>$reg->apellidos,
                      'cargo'=>$reg->cargo,
                      'condicion'=>$reg->condicion,
                      'idempleado'=>$reg->idempleado,
                      'idarea'=>$reg->idarea,
                      'idlocales'=>$reg->idlocales,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_empleado_as_oficina');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $empleado_as_ofi = new Empleado_as_oficina($id,"");
      $row_ = $empleado_as_ofi->get_row();         
      header('Content-type: application/json');
      echo json_encode(array(
              "id_empleado_as_oficina_crud"=>$row_->idempleado_oficina,
              "cargo_empleado_as_ofi"=>$row_->cargo,
              "idlocal_in_emp_as_of"=>$row_->idlocales,
              "idarea_in_emp_as_of"=>$row_->idarea,
              "idoficina_in_emp_as_of"=>$row_->idoficina,
              "idempleado_in_emp_as_of"=>$row_->idempleado,  
      ));
      
      
   }   
 public function guardar() {      
    $empleados_as_ofi = new Empleado_as_oficina("");
    $empleados_as_ofi->set_row($_REQUEST);
     if($_REQUEST['id_empleado_as_oficina_crud']=="autogenerado"){
        $empleados_as_ofi->guardar_en_bd();     
     }else{
        $empleados_as_ofi->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $empleados_as_ofi = new Empleado_as_oficina("");
       $empleados_as_ofi->set_delete_virtual($id);
 }
 
  public function combo() { 
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro
            // print_r($parameters);
            $filtro= $parameters['$filter'];//FILTRO EN CADENA
            $porciones = explode(" ", $filtro);           
            $valor = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
            
            $data_ = new Area("","");           
            $data=$data_->set_registros_combo($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idarea'=>$d->idarea,                     
                      'descripcion'=>$d->descripcion,
                      'idlocales'=>$d->locales_idlocales,
                    );
                }
              }             
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
  public function combo2() { 
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro
            // print_r($parameters);
            $filtro= $parameters['$filter'];//FILTRO EN CADENA
            $porciones = explode(" ", $filtro);           
            $valor = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
            
            $data_ = new Area("","");           
            $data=$data_->set_registros_combo($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idarea'=>$d->idarea,                     
                      'descripcion'=>$d->descripcion,
                      'idlocales'=>$d->locales_idlocales,
                    );
                }
              }   
               $datos['xxx'][]=array(
                    'idarea'=>NULL,                     
                    'descripcion'=>"TODOS",
                  );
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
 public function set_registros_combo_() {  
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro 
           
            $filtro= $parameters['$filter'];//FILTRO EN CADENA
            $porciones = explode(" ", $filtro);           
            $i = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
           
            $busqueda=""; 
            $idoficina="";
            if (strpos($filtro, 'tolower') !== false) {
                 $filtro= $parameters['$filter'];
                $idoficina= $parameters['idoficina'];
                $filtro= $parameters['$filter'];//FILTRO EN CADENA
               $porciones = explode(" ", $filtro);           
               $busqueda = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
              
            }
           
           
          
            
            $data_ = new Empleado_as_oficina("","");    
            
            $data=$data_->set_registros_combo_($i,$busqueda,$idoficina);
            
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idempleado_oficina'=>$d->idempleado_oficina,        
                      'idoficina'=>$d->idoficina,        
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
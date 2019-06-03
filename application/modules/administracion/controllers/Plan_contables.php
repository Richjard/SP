<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Plan_contable{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='plan_contable';   
    private $descripcion="";
    private $codigo="";
    private $idplan_contable="";
    private $reg_total="";
    
    public function __construct($idplan_contable="",$param=array())
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
        if($idplan_contable<>""){            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idplan_contable='".$idplan_contable."'"              
          );
          $getRow = new Crud($params);    
          $_row=$getRow->getRegisterRow();
          if($getRow){
              $this->registro_row=$_row;
          }  
        }

      
       /* if($_REQUEST){
            $this->ruc=$data_request['ruc'];
        }*/
         
    }
    //mentodos
    public function get_plan_contables(){
        return $this->registros;
       
    }
    public function get_plan_contables_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_plan_contables_row($data_request = array()){
        $this->idplan_contable=$data_request['id_plan_contable_crud'];
        $this->codigo=$data_request['codigo'];
        $this->descripcion=$data_request['descripcion'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion",
                "values"=>'"'.$this->codigo.'","'.$this->descripcion.'"'                
            );
            $insert_plan_contables = new Crud($params);
            $id_plan_contables_new = $insert_plan_contables->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idplan_contable='".$this->idplan_contable."'",
                'campos_values_update'=>"codigo='".$this->codigo."', descripcion='".$this->descripcion."'"
              );
             print_r($params);

            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idplan_contable='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
    
    public function get_consulta_row($cuenta){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"codigo='".$cuenta."'"               
              );
             $getRow = new Crud($params);    
             return $getRow->getRegisterRow();
    }
}


class Plan_contables extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {          
          $datos['contenido']    ='administracion/plan_contables';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='plan_contables'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/plan_contables');
          
          $this->load->view('includes/template',$datos);
   
 }
  public function all() {          
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/plan_contables');
          $datos['app_url']      =base_url();
          $this->load->view('administracion/plan_contables_all',$datos);
   
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
            
            $plan_contables = new plan_contable("",$param);
            $registros=$plan_contables->get_plan_contables();
            
            
            
            
            $total=$plan_contables->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['plan_contables_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['plan_contables_result'][]=array(
                      'idplan_contable'=>$reg->idplan_contable,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['plan_contables_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_plan_contables');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $plan_contables_ = new plan_contable($id,"");
      $row_ = $plan_contables_->get_plan_contables_row(); 
        
     // print_r($row_);
      header('Content-type: application/json');
      echo json_encode(array(
              "id_plan_contable_crud"=>$row_->idplan_contable,
              "codigo"=>$row_->codigo,
              "descripcion"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $plan_contables_ = new plan_contable("");
    $plan_contables_->set_plan_contables_row($_REQUEST);
     if($_REQUEST['id_plan_contable_crud']=="autogenerado"){
        $plan_contables_->guardar_en_bd();     
     }else{
        $plan_contables_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $plan_contables_ = new plan_contable("");
       $plan_contables_->set_delete_virtual($id);
 }
 public function consulta_cuenta($cuenta_=""){
        $cuenta= new Plan_contable("","");
        $row=$cuenta->get_consulta_row($cuenta_);
        if(!$row){
           $row=0; 
        }
        $to1tal=1;
        header("Content-type: application/json");
        echo  "{\"data\":" .json_encode($row). ",\"total\":".$to1tal."}";
  }
}
/*
*end modules/login/controllers/index.php
*/
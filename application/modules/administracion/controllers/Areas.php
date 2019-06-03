<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Area{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='area';   
    private $descripcion="";
    private $abre="";
    private $idlocal="";
    private $idarea="";
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
            "filtro"=>"idarea='".$id."'"              
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
        $this->idarea=$data_request['id_area_crud'];
        $this->idlocal=$data_request['local_combo_in_area'];
        $this->descripcion=$data_request['nombre_area'];
        $this->abre=$data_request['abre_area'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "descripcion,abre,locales_idlocales",
                "values"=>'"'.$this->descripcion.'","'.$this->abre.'","'.$this->idlocal.'"'                
            );
            $insert_ = new Crud($params);
            $id_new = $insert_->insert();
       
    }
    public function modificar_en_bd(){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idarea='".$this->idarea."'",
                'campos_values_update'=>"descripcion='".$this->descripcion."', abre='".$this->abre."', locales_idlocales='".$this->idlocal."'"
              );
            $update_register = new Crud($params);     
            $update_register->update();       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idarea='".$id."'",
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
}


class areas extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() { 
    if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/areas';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='AREAS'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/areas');
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
                $i=str_replace("AND (locales_idlocales eq null)"," ",$i);
                $i=str_replace("(locales_idlocales eq null)"," EliminadoSis is null",$i);
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
            $registros_get = new Area("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'idarea'=>$reg->idarea,
                      'descripcion'=>$reg->descripcion,
                      'abre'=>$reg->abre,
                      'locales_idlocales'=>$reg->locales_idlocales,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_area');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $area = new Area($id,"");
      $row_ = $area->get_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_area_crud"=>$row_->idarea,
              'idlocal'=>$row_->locales_idlocales,
              "abre_area"=>$row_->abre,
              "nombre_area"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $areas_ = new Area("");
    $areas_->set_row($_REQUEST);
     if($_REQUEST['id_area_crud']=="autogenerado"){
        $areas_->guardar_en_bd();     
     }else{
        $areas_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $areas_ = new Area("");
       $areas_->set_delete_virtual($id);
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
}
/*
*end modules/login/controllers/index.php
*/
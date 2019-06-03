<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
class Oficina{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='oficina'; 
    private $vista='v_oficinas'; 
    private $descripcion="";
    private $idarea="";
    private $idoficina="";
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
                'tabla' =>$this->tabla,
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
            "filtro"=>"idoficina='".$id."'"              
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
        $this->idoficina=$data_request['id_oficina_crud'];
        $this->idarea=$data_request['area_combo_in_oficina'];
        $this->descripcion=$data_request['nombre_oficina'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "area_idarea,descripcion",
                "values"=>'"'.$this->idarea.'","'.$this->descripcion.'"'                
            );
            $insert_grupos = new Crud($params);
            $id_area_new = $insert_grupos->insert();       
    }
    public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idoficina='".$this->idoficina."'",
                'campos_values_update'=>"area_idarea='".$this->idarea."', descripcion='".$this->descripcion."'"
              ); 
            $update_register = new Crud($params);     
            $update_register->update();       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idoficina='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
     public function set_registros_combo($id){           
             $params = array(
                'tabla' => $this->tabla,
              "filtro"=>"area_idarea='".$id."'",
              );
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


class oficinas extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() { 
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/oficinas';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='OFICINAS'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/oficinas');
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
                $i=str_replace("AND (area_idarea eq null)"," ",$i);
                $i=str_replace("(area_idarea eq null)"," EliminadoSis is null",$i);  
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
            $registros_get = new oficina("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'idoficina'=>$reg->idoficina,
                      'descripcion'=>$reg->descripcion,                     
                      'area_idarea'=>$reg->area_idarea,
                      'idlocales'=>$reg->idlocales,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }        
 }
 
public function form_() {    
   $this->load->view('administracion/form_oficinas');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $oficina_ = new Oficina($id,"");
      $row_ = $oficina_->get_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_oficina_crud"=>$row_->idoficina,
              "idlocal_in_of"=>$row_->idlocales,
              "idarea_in_of"=>$row_->area_idarea,
              "nombre_oficina"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $oficinas_ = new Oficina("");
    $oficinas_->set_row($_REQUEST);
     if($_REQUEST['id_oficina_crud']=="autogenerado"){
        $oficinas_->guardar_en_bd();     
     }else{
        $oficinas_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $oficina_ = new Oficina("");
       $oficina_->set_delete_virtual($id);
 }
 
  public function combo() {  
            $parameters = $this->input->get();//RECIBIMOS 1 parametro de filtro
            // print_r($parameters);
            $filtro= $parameters['$filter'];//FILTRO EN CADENA
            $porciones = explode(" ", $filtro);           
            $valor = str_replace("'",'',$porciones[2]); //OBTENEMOS EL VALOR PARA FILTRAR departamento_id
            
            $data_ = new Oficina("","");           
            $data=$data_->set_registros_combo($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idoficina'=>$d->idoficina,                     
                      'descripcion'=>$d->descripcion,
                      'idarea'=>$d->area_idarea,
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
            
            $data_ = new Oficina("","");           
            $data=$data_->set_registros_combo($valor);
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idoficina'=>$d->idoficina,                     
                      'descripcion'=>$d->descripcion,
                      'idarea'=>$d->area_idarea,
                    );
                }
              }     
            $datos['xxx'][]=array(
                 'idoficina'=>NULL,                     
                 'descripcion'=>"TODOS",
               );
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
}
/*
*end modules/login/controllers/index.php
*/
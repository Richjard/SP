<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
class Md{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='motivo_desplazamiento'; 
    private $idlocales="";
    private $entidad_identidad=1;
    private $descripcion="";
    private $direccion="";   
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
            "filtro"=>"idlocales='".$id."'"              
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
        $this->idlocales=$data_request['id_local_crud'];
        $this->direccion=$data_request['direccion_local'];
        $this->descripcion=$data_request['nombre_local'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "descripcion,direccion,entidad_identidad",
                "values"=>'"'.$this->descripcion.'","'.$this->direccion.'","'.$this->entidad_identidad.'"'                 
            );
            $insert_ = new Crud($params);
            $id_new = $insert_->insert();
       
    }
     public function modificar_en_bd(){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idlocales='".$this->idlocales."'",
                'campos_values_update'=>"descripcion='".$this->descripcion."', direccion='".$this->direccion."'"
              );  
            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idlocales='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
     public function set_registros_combo($param=array()){           
             $params = array(
                'tabla' => $this->tabla,
               // "filtro"=>"idgrupos='".$id."'",
                //'campos_values_update'=>"EliminadoSis=1"
              );          
            $getResult = new Crud($params);  
            echo "DDDDdd";
            print_r($getResult->getRegisterResult());
            return $getResult->getRegisterResult();
           
    }
    public function get_registros2($param=array()){           
             $params = array(
                'tabla' => $this->tabla,
               // "filtro"=>"idgrupos='".$id."'",
                //'campos_values_update'=>"EliminadoSis=1"
              );
            $getResult = new Crud($params);     
             return $getResult->getRegisterResult();
    }
}


class motivo_desplazamiento extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() { 
     if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/locales';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='LOCALES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/locales');
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
            $registros_get = new Local("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'idlocales'=>$reg->idlocales,
                      'descripcion'=>$reg->descripcion,
                      'direccion'=>$reg->direccion,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_local');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $local_ = new Local($id,"");
      $row_ = $local_->get_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_local_crud"=>$row_->idlocales,
              "direccion_local"=>$row_->direccion,
              "nombre_local"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $local_ = new Local("");
    $local_->set_row($_REQUEST);
     if($_REQUEST['id_local_crud']=="autogenerado"){
        $local_->guardar_en_bd();     
     }else{
        $local_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $local_ = new Local("");
       $local_->set_delete_virtual($id);
 }
 
  public function combo() {         
            $data_ = new Md("","");           
            $data=$data_->set_registros_combo("");
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idmotivo_desplazamiento'=>$d->idmotivo_desplazamiento,                     
                      'descripcion'=>$d->descripcion,
                    );
                }
              }  
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
  public function combo2() {         
            $data_ = new Local("","");           
            $data=$data_->set_registros_combo("");
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idlocales'=>$d->idlocales,                     
                      'descripcion'=>$d->descripcion,
                    );
                }
              }  
              $datos['xxx'][]=array(
                    'idlocales'=>NULL,                     
                    'descripcion'=>"TODOS",
                  );
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
}
/*
*end modules/login/controllers/index.php
*/
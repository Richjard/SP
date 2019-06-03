<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Estado_bienes{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='estado_bien';   
    private $descripcion="";
    private $codigo="";
    private $idgrupos="";
    private $reg_total="";
    
    public function __construct($idgrupos="",$param=array())
    {       
      if(isset($param['skip'])){
        $params = array(
          'tabla' =>$this->tabla,    
          'skip' =>$param['skip'],
          'top'=>$param['top']
        );
        $getResult = new Crud($params);     
        $this->registros=$getResult->getRegisterResult();
        
        $params = array(
          'tabla' =>$this->tabla,  
        );
        $getTotal = new Crud($params);     
        $this->reg_total=$getTotal->getTotal();
         }
        //row
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        if($idgrupos<>""){            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idgrupos='".$idgrupos."'"              
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
    public function get_grupos(){
        return $this->registros;
       
    }
    public function get_grupos_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_grupos_row($data_request = array()){
        $this->idgrupos=$data_request['id_grupo_crud'];
        $this->codigo=$data_request['codigo'];
        $this->descripcion=$data_request['descripcion'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion",
                "values"=>'"'.$this->codigo.'","'.$this->descripcion.'"'                
            );
            $insert_grupos = new Crud($params);
            $id_grupos_new = $insert_grupos->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idgrupos='".$this->idgrupos."'",
                'campos_values_update'=>"codigo='".$this->codigo."', descripcion='".$this->descripcion."'"
              );
             print_r($params);

            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idgrupos='".$id."'",
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
             return $getResult->getRegisterResult();
    }
}


class estado_bien extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {  
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/grupos';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='GRUPOS'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/grupos');
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
                $palabras = explode ("(substringof('",  $parameters['$filter']);
                $parametro_busqueda = explode ("',tolower(",  $palabras[1]);
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"grupos",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top, //HASTA 
                    "filtro"=>"descripcion LIKE '%{$parametro_busqueda[0]}%'" 
                  );
            }else{
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"grupos",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top //HASTA 
                    //"order"=>"dtFechaSis  DESC"
                 );
            }   
            $param=array(            
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top //HASTA 
                    //"order"=>"dtFechaSis  DESC"
                 );
            $grupos = new Grupo("",$param);
            $registros=$grupos->get_grupos();
            
            
            
            
            $total=$grupos->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['grupos_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['grupos_result'][]=array(
                      'idgrupos'=>$reg->idgrupos,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['grupos_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_grupos');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $grupos_ = new Grupo($id,"");
      $row_ = $grupos_->get_grupos_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_grupo_crud"=>$row_->idgrupos,
              "codigo"=>$row_->codigo,
              "descripcion"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $grupos_ = new Grupo("");
    $grupos_->set_grupos_row($_REQUEST);
     if($_REQUEST['id_grupo_crud']=="autogenerado"){
        $grupos_->guardar_en_bd();     
     }else{
        $grupos_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $grupos_ = new Forma_adquisiciones("");
       $grupos_->set_delete_virtual($id);
 }
 
  public function combo() {         
            $data_ = new Estado_bienes("","");           
            $data=$data_->set_registros_combo("");
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idestado_bien'=>$d->idestado_bien,                     
                      'descripcion'=>$d->descripcion,
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
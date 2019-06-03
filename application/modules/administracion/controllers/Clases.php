<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Clase{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='clases';   
    private $descripcion="";
    private $codigo="";
    private $idclases="";
    private $reg_total="";
    
    public function __construct($idclases="",$param=array())
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
        if($idclases<>""){            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idclases='".$idclases."'"              
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
    public function get_clases(){
        return $this->registros;
       
    }
    public function get_clases_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_clases_row($data_request = array()){
        $this->idclases=$data_request['id_clase_crud'];
        $this->codigo=$data_request['codigo'];
        $this->descripcion=$data_request['descripcion'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion",
                "values"=>'"'.$this->codigo.'","'.$this->descripcion.'"'                
            );
            $insert_clases = new Crud($params);
            $id_clases_new = $insert_clases->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idclases='".$this->idclases."'",
                'campos_values_update'=>"codigo='".$this->codigo."', descripcion='".$this->descripcion."'"
              );
             print_r($params);

            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idclases='".$id."'",
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


class clases extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {  
        if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/clases';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='clases'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/clases');
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
                    "tabla"=>"clases",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top, //HASTA 
                    "filtro"=>"descripcion LIKE '%{$parametro_busqueda[0]}%'" 
                  );
            }else{
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"clases",//NOMBRE DE LA TABLA 
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
            $clases = new clase("",$param);
            $registros=$clases->get_clases();
            
            
            
            
            $total=$clases->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['clases_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['clases_result'][]=array(
                      'idclases'=>$reg->idclases,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['clases_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_clases');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $clases_ = new clase($id,"");
      $row_ = $clases_->get_clases_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_clase_crud"=>$row_->idclases,
              "codigo"=>$row_->codigo,
              "descripcion"=>$row_->descripcion,  
      ));
      
      
   }   
 public function guardar() {      
    $clases_ = new clase("");
    $clases_->set_clases_row($_REQUEST);
     if($_REQUEST['id_clase_crud']=="autogenerado"){
        $clases_->guardar_en_bd();     
     }else{
        $clases_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $clases_ = new clase("");
       $clases_->set_delete_virtual($id);
 }
  public function clase_combo() {         
            $clases = new Clase("","");           
            $data=$clases->set_registros_combo("");
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idclases'=>$d->codigo,
                      'codigo'=>$d->codigo,
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
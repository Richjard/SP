<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Tipo_bien{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='tipo_bien';   
    private $idtipo_bien="";
    private $tipo_bien="";
    private $codigo="";
    private $descripcion="";
    private $idgrupos="";
    private $idClases="";
    private $reg_total="";
    
    public function __construct($idtipo_bien="",$param=array())
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
        if($idtipo_bien<>""){            
          $params = array(
            'tabla' => $this->tabla,
            "filtro"=>"idtipo_bien='".$idtipo_bien."'"              
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
    public function get_tipo_bien(){
        return $this->registros;
       
    }
    public function get_tipo_bien_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_tipo_bien_row($data_request = array()){
        $this->idtipo_bien=$data_request['id_tipo_bien_crud'];
        $this->codigo=$data_request['codigo'];
        $this->descripcion=$data_request['descripcion'];
        $this->idgrupos=$data_request['idgrupos'];
        $this->idClases=$data_request['idClases'];
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion,idgrupos,idClases",
                "values"=>'"'.$this->codigo.'","'.$this->descripcion.'","'.$this->idgrupos.'","'.$this->idClases.'"'                
            );
            $insert_tipo_bien = new Crud($params);
            $id_tipo_bien_new = $insert_tipo_bien->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idtipo_bien='".$this->idtipo_bien."'",
                'campos_values_update'=>"codigo='".$this->codigo."', descripcion='".$this->descripcion."', idgrupos='".$this->idgrupos."', idClases='".$this->idClases."'"
              );
             //print_r($params);

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
}


class Tipo_bienes extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {   
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/tipo_bienes';         
          $datos['app_url']      =base_url();
          $datos['titulo']       =' TIPO BIENES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/menu','assets/administracion/js_all','assets/administracion/tipo_bienes');
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
                    "tabla"=>"tipo_bien",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top, //HASTA 
                    "filtro"=>"descripcion LIKE '%{$parametro_busqueda[0]}%'" 
                  );
            }else{
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"tipo_bien",//NOMBRE DE LA TABLA 
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
            $tipo_bien = new Tipo_bien("",$param);
            $registros=$tipo_bien->get_tipo_bien();
            
            
            
            
            $total=$tipo_bien->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['grupos_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['grupos_result'][]=array(
                      'idtipo_bien'=>$reg->idtipo_bien,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion,
                      'idgrupos'=>$reg->idgrupos,
                      'idClases'=>$reg->idClases,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['grupos_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_tipo_bien');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $tipo_bien_ = new Tipo_bien($id,"");
      $row_ = $tipo_bien_->get_tipo_bien_row(); 
        
      header('Content-type: application/json');
      echo json_encode(array(
              "id_tipo_bien_crud"=>$row_->idtipo_bien,
              "codigo"=>$row_->codigo,
              "descripcion"=>$row_->descripcion,  
              "idgrupos"=>$row_->idgrupos,  
              "idClases"=>$row_->idClases,  
      ));
      
      
   }   
 public function guardar() {      
    $tipo_bien_ = new Tipo_bien("");
    $tipo_bien_->set_tipo_bien_row($_REQUEST);
     if($_REQUEST['id_tipo_bien_crud']=="autogenerado"){
        $tipo_bien_->guardar_en_bd();     
     }else{
        $tipo_bien_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $tipo_bien_ = new Grupo("");
       $tipo_bien_->set_delete_virtual($id);
 }
}
/*
*end modules/login/controllers/index.php
*/
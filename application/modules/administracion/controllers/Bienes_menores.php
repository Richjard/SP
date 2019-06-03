<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Bien_menor{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='catalogo'; 
    private $vista='catalogo';
    private $idCatalogo="";    
    private $codigo="";
    private $descripcion=""; 
    private $reg_total="";    
    public function __construct($id="",$param=array())
    // modificando para upload
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
            'tabla' => $this->tabla,
            "filtro"=>"idCatalogo='".$id."'"              
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
    public function get_row(){
        return $this->registro_row;       
    } 
    public function get_total(){
        return $this->reg_total;       
    }
    public function set_row($data_request = array()){
        $this->idCatalogo=$data_request['id_bien_menor_crud'];
        $this->codigo=$data_request['codigo_b_m_f'];
        $this->descripcion=$data_request['descripcion_b_m_f'];        
    }    
    public function guardar_en_bd($data_request = array()){     
           $y = "0000"; 
           $new_codigo = $y.str_pad($this->obtener_ultimo_codigo(), 4, "0", STR_PAD_LEFT);
           echo $new_codigo;
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion",
                "values"=>'"'.$new_codigo.'","'.$this->descripcion.'"'                
            );
            $insert = new Crud($params);
            $id_bien_menor_new = $insert->insert();
       
    }
     public function modificar_en_bd($data_request = array()){ 
            $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idCatalogo='".$this->idCatalogo."'",
                'campos_values_update'=>" descripcion='".$this->descripcion."'"
              );
            $update_register = new Crud($params);     
            $update_register->update();       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idCatalogo='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
    public function obtener_ultimo_codigo(){  
             //echo "tmr";
            // $y = date("Y");
            $y="0000";
             $params = array(
                'tabla' => $this->tabla,
                'select_campos'=>"MAX(codigo) as codigo",
                 "filtro"=>" substring(codigo,1,4)='".$y."'"
               // "filtro"=>"codigo LIKE '".$y."%'"
              );
            $ultimo_registro = new Crud($params);
            $num=1;
            if($ultimo_registro->getRegisterRow()){
                $rest = substr($ultimo_registro->getRegisterRow()->codigo, -4);
                $num=intval($rest)+1;
            }           
            return $num;
            //return $ultimo_registro;
    }
}


class Bienes_menores extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {   
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/bienes_menores';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='BIENES MENORES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/bienes_menores');          
          $this->load->view('includes/template',$datos);   
          }else{
        redirect(base_url(), 'refresh');
      }
 }
  public function all() { 
      if($this->session->userdata('logged_in')==TRUE){
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/bienes_menores');
          $datos['app_url']      =base_url();
          $this->load->view('administracion/bienes_menores_all',$datos); 
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
            $get_bienes_menores = new Bien_menor("",$param);
            $registros=$get_bienes_menores->get_registros();   
            $total=$get_bienes_menores->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['data']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['data'][]=array(
                      'idCatalogo'=>$reg->idCatalogo,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['data']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_bienes_menores');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $row_data = new Bien_menor($id,"");
      $row_ = $row_data->get_row(); 
      header('Content-type: application/json');
      echo json_encode(array(
              "id_bien_menor_crud"=>$row_->idCatalogo,              
             "codigo_b_m_f"=>$row_->codigo,
             "descripcion_b_m_f"=>$row_->descripcion            
      ));
      
      
   }   
 public function guardar() {      
    $bien_menor_ = new Bien_menor("");
    $bien_menor_->set_row($_REQUEST);
     if($_REQUEST['id_bien_menor_crud']=="autogenerado"){
        $bien_menor_->guardar_en_bd();     
     }else{
        $bien_menor_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $eliminar = new Bien_menor("");
       $eliminar->set_delete_virtual($id);
 }
 public function consulta_cuenta($cuenta){
        $cuenta= new Plan_contable($cuenta,"");
        $row=$cuenta->get_plan_contables_row();
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
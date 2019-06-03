<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Bien_mayor{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='tipo_bien'; 
    private $vista='bienes_mayores';
    private $idtipo_bien="";    
    private $codigo="";
    private $descripcion="";    
    private $idgrupos="";
    private $idClases="";
    
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
            'tabla' => $this->tabla,
            "filtro"=>"idtipo_bien='".$id."'"              
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
    public function get_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_row($data_request = array()){
        $this->idtipo_bien=$data_request['id_bien_mayor_crud'];
        $this->codigo=$data_request['codigo'];
        $this->descripcion=$data_request['descripcion'];
        $this->idgrupos=$data_request['grupo_bien_form'];
        $this->idClases=$data_request['clase_bien_form'];        
    }
    
    public function guardar_en_bd($data_request = array()){          
        
            $new_codigo = $this->codigo.str_pad($this->obtener_ultimo_codigo(), 4, "0", STR_PAD_LEFT);
           
          
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo,descripcion,idgrupos,idClases",
                "values"=>'"'.$new_codigo.'","'.$this->descripcion.'","'.$this->idgrupos.'","'.$this->idClases.'"'                
            );
            $insert = new Crud($params);
            $id_bien_mayor_new = $insert->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
            $new_codigo=$this->codigo;
            if(strlen($new_codigo)<8){
               $new_codigo = $this->codigo.str_pad($this->obtener_ultimo_codigo(), 4, "0", STR_PAD_LEFT);
            
            }else{
               $new_codigo=$this->codigo;
            }  
            $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idtipo_bien='".$this->idtipo_bien."'",
                'campos_values_update'=>"codigo='".$new_codigo."', descripcion='".$this->descripcion."', idgrupos='".$this->idgrupos."', idClases='".$this->idClases."'"
              );
            $update_register = new Crud($params);     
            $update_register->update();       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idtipo_bien='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
    }
    public function obtener_ultimo_codigo(){  
        //echo "tmr";
             $params = array(
                'tabla' => $this->tabla,
                'select_campos'=>"MAX(codigo) as codigo",
                "filtro"=>" substring(codigo,1,4)='".$this->codigo."'"
               // "filtro"=>"codigo LIKE '".$this->codigo."%'"
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


class Bienes_mayores extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {  
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/bienes_mayores';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='plan_contables'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/bienes_mayores');
          
          $this->load->view('includes/template',$datos);
             }else{
      redirect(base_url(), 'refresh');

    }
   
 }
  public function all() { 
      if($this->session->userdata('logged_in')==TRUE){
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/bienes_mayores');
          $datos['app_url']      =base_url();
          $this->load->view('administracion/bienes_mayores_all',$datos); 
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
            
            $plan_contables = new Bien_mayor("",$param);
            $registros=$plan_contables->get_plan_contables();
            
            
            
            
            $total=$plan_contables->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['plan_contables_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['plan_contables_result'][]=array(
                      'idtipo_bien'=>$reg->idtipo_bien,
                      'codigo'=>$reg->codigo,
                      'descripcion'=>$reg->descripcion,
                      'idgrupos'=>$reg->idgrupos,
                      'idClases'=>$reg->idClases,
                      'idplan_contable'=>$reg->idplan_contable,
                      'CUENTA_CONTABLE'=>$reg->CUENTA_CONTABLE,
                      'descripcion_cuenta_contable'=>$reg->descripcion_cuenta_contable,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['plan_contables_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_bienes_mayores');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $row_data = new Bien_mayor($id,"");
      $row_ = $row_data->get_row(); 
      header('Content-type: application/json');
      echo json_encode(array(
              "id_bien_mayor_crud"=>$row_->idtipo_bien,
              
             "codigo"=>$row_->codigo,
             "descripcion"=>$row_->descripcion,
             "grupo_bien_form_h"=>$row_->idgrupos,
             "clase_bien_form_h"=>$row_->idClases
             
      ));
      
      
   }   
 public function guardar() {      
    $bien_mayor_ = new Bien_mayor("");
    $bien_mayor_->set_row($_REQUEST);
     if($_REQUEST['id_bien_mayor_crud']=="autogenerado"){
        $bien_mayor_->guardar_en_bd();     
     }else{
        $bien_mayor_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $eliminar = new Bien_mayor("");
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
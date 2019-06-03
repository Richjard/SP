<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
class Provedores{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='proveedor';   
    private $ruc="";
    private $razon_social="";
    private $idproveedor="";
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
            "filtro"=>"idproveedor='".$id."'"              
          );
          $getRow = new Crud($params);    
          $_row=$getRow->getRegisterRow();
          if($getRow){
              $this->registro_row=$_row;
          }  
        }
         
    }
    //mentodos
    public function get_proveedores(){
        return $this->registros;
       
    }
    public function get_proveedores_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_proveedores_row($data_request = array()){
        $this->ruc=$data_request['ruc'];
        $this->idproveedor=$data_request['id_proveedor_crud'];
        $this->razon_social=$data_request['razon_social'];
        $this->direccion=$data_request['direccion'];
       
    } 
     public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "ruc,razon_social,direccion",
                "values"=>'"'.$this->ruc.'","'.$this->razon_social.'","'.$this->direccion.'"'                
            );
            $insert_proveedor = new Crud($params);
            $id_proveedor_new = $insert_proveedor->insert();
       
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idproveedor='".$this->idproveedor."'",
                'campos_values_update'=>"ruc='".$this->ruc."', razon_social='".$this->razon_social."', direccion='".$this->direccion."'"
              );
            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idproveedor='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
       
    }  
    public function set_registros_combo(){           
             $params = array(
                'tabla' => $this->tabla,
              );
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
     public function get_consulta_ruc_row($ruc=""){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"ruc='".$ruc."'"               
              );
             $getRow = new Crud($params);    
             return $getRow->getRegisterRow();
    }
    
}


class Proveedor extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {   
       if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/proveedores';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='PROVEEDORES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/proveedor');
          $this->load->view('includes/template',$datos);
                                   }else{
        redirect(base_url(), 'refresh');
      }
   
 }
 public function all() {          
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/proveedor');
          $datos['app_url']      =base_url();
          $this->load->view('administracion/proveedores_all',$datos);   
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
            
            $proveedores = new Provedores("",$param);
            $registros=$proveedores->get_proveedores();
            
            
            
            
            $total=$proveedores->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['proveedores_result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['proveedores_result'][]=array(
                      'idproveedor'=>$reg->idproveedor,
                      'razon_social'=>$reg->razon_social,
                      'ruc'=>$reg->ruc,
                      'direccion'=>$reg->direccion,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['proveedores_result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_proveedor');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $proveedores_ = new Provedores($id,"");
      $row_ = $proveedores_->get_proveedores_row();     
      header('Content-type: application/json');
      echo json_encode(array(
              "id_proveedor_crud"=>$row_->idproveedor,
              "ruc"=>$row_->ruc, 
              "razon_social"=>$row_->razon_social,  
              "direccion"=>$row_->direccion,
          
            ));
      
      
   }   
 public function guardar() {      
    $proveedores_ = new Provedores("");
    $proveedores_->set_proveedores_row($_REQUEST);
     if($_REQUEST['id_proveedor_crud']=="autogenerado"){
        $proveedores_->guardar_en_bd();     
     }else{
        $proveedores_->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $proveedores_ = new Provedores("");
       $proveedores_->set_delete_virtual($id);
 }
 public function combo() { 
            $data_ = new Provedores("","");           
            $data=$data_->set_registros_combo();
            $datos['xxx']=array();
            if($data){
                foreach ($data as $d) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['xxx'][]=array(
                      'idproveedor'=>$d->idproveedor,                     
                      'descripcion'=>$d->razon_social
                    );
                }
              }             
            header("Content-type: application/json");
            echo  json_encode($datos['xxx']); 
 }
  public function consulta_ruc($ruc_=""){
        $proveedor= new Provedores("","");
        $row=$proveedor->get_consulta_ruc_row($ruc_);
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
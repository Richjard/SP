<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
class Db{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='desplazamiento_bien'; 
    private $vista='v_desplazamiento_bien';
    private $iddesplazamiento_bien="";
    private $fecha="";
    private $doc="";
    private $fines="";  
    private $referencia=""; 
    private $idanio="";  
    private $idmotivo_desplazamiento="";  
    private $idempleado_oficina_origen="";  
    private $idoficina_origen="";  
    private $idempleado_oficina_destino="";  
    private $idoficina_destino=""; 
    private $data_desplazamiento=array();  
    private $reg_total="";
    
    public function __construct($id="",$param=array())
    {       
      if(isset($param['skip'])){
          if(isset($param['filtro'])){
             $params = array(
                'tabla' =>$this->vista,    
                'skip' =>$param['skip'],
                'top'=>$param['top'],
                'filtro'=>$param['filtro'],
                'order'=>$param['order']
                     
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
                'top'=>$param['top'],
                'order'=>$param['order']
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
            "filtro"=>"iddesplazamiento_bien='".$id."'"              
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
        $this->iddesplazamiento_bien=$data_request['id_desplazamiento_de_bien_crud'];
        $this->fecha=$data_request['fecha_des'];
        $this->doc=$data_request['doc_des'];
        $this->fines=$data_request['finesde_des'];
        $this->referencia=$data_request['ref_des'];
        $this->idanio=$data_request['anio_des'];
        $this->idmotivo_desplazamiento=$data_request['motivo_desplazamiento_combo'];
        $this->idoficina_origen=$data_request['combo_oficinas_despl']; 
        if(isset($data_request['combo_empleado_despl']) and $data_request['combo_empleado_despl']<>"" ){
            $this->idempleado_oficina_origen=$data_request['combo_empleado_despl'];
        }else{
            $this->idempleado_oficina_origen="null";
        }
        $this->idoficina_destino=$data_request['combo_oficinas_despl_des'];
        if(isset($data_request['combo_empleado_despl_des']) and $data_request['combo_empleado_despl_des']<>"" ){
            $this->idempleado_oficina_destino=$data_request['combo_empleado_despl_des'];
        }else{
            $this->idempleado_oficina_destino="null";
        }
        $this->data_desplazamiento=json_decode($data_request['bienes']);
    }
    
    public function guardar_en_bd($data_request = array()){           
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "fecha,doc,fines,referencia,idanio,idmotivo_desplazamiento,idoficina_origen,idempleado_oficina_origen,idoficina_destino,idempleado_oficina_destino",
                "values"=>'"'.$this->fecha.'","'.$this->doc.'","'.$this->fines.'","'.$this->referencia.'","'.$this->idanio.'","'.$this->idmotivo_desplazamiento.'","'.$this->idoficina_origen.'",'.$this->idempleado_oficina_origen.',"'.$this->idoficina_destino.'",'.$this->idempleado_oficina_destino.''                 
            );
            $insert_ = new Crud($params);
            $id_new = $insert_->insert();
            foreach ($this->data_desplazamiento as $d ){
                $params= array(
                    "tabla"=>"detalle_desplazamiento_de_bienes",              
                    'campos' => "iddesplazamiento_bien,idformato_registro_bien",
                    "values"=>'"'.$id_new.'","'.$d->idformato_registro_bien.'"'                 
                );
                $insert__= new Crud($params);
                $insert__->insert();
            }
       
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
                "filtro"=>"iddesplazamiento_bien='".$id."'",
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


class desplazamiento_de_bienes extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {    
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/desplamiento_de_bienes';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='DESPLAZAMIENTO DE BIENES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/menu','assets/administracion/desplazamiento','assets/administracion/jquery.mask');
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
                    "filtro"=>"$i",
                    "order"=>"iddesplazamiento_bien  DESC"
                  );
            }else{
                $param=array(            
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top ,//HASTA 
                    "order"=>"iddesplazamiento_bien  DESC"
                 );
            }               
            $registros_get = new Db("",$param);
            $registros=$registros_get->get_result(); 
            $total=$registros_get->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'iddesplazamiento_bien'=>$reg->iddesplazamiento_bien,
                      'anio'=>$reg->idanio,
                      'fecha'=>$reg->fecha,
                      'motivo'=>$reg->motivo,
                      
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_() {    
   $this->load->view('administracion/form_desplazamiento_de_bienes');
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
     //print_r(json_decode($_REQUEST['bienes']));
   /* foreach(json_decode($_REQUEST['bienes'])  as $r){
       echo $r->descripcion;
    }*/
    $db_ = new Db("");
    $db_->set_row($_REQUEST);
     if($_REQUEST['id_desplazamiento_de_bien_crud']=="autogenerado"){
        $db_->guardar_en_bd();     
     }else{
        $db_->modificar_en_bd();  
     }     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $local_ = new Db("");
       $local_->set_delete_virtual($id);
 }
 
  public function combo() {         
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
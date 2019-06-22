<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include ("Crud.php");
include_once ("Bienes.php");
include_once ("Oficinas.php");
include_once ("Empleados_as_oficina.php");
include_once ("Desplazamiento_de_bienes.php");
include_once ("Detalle_desplazamiento_de_bienes.php");
require APPPATH .'vendor/autoload.php';
class Area{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='area';   
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
     public function set_registros_combo($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"locales_idlocales='".$id."'",
              );
            $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
    }
}


class reportes extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() {          
          $datos['contenido']    ='administracion/grupos';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='GRUPOS'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/grupos');
          $this->load->view('includes/template',$datos);
   
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
 
 public function v_por_locales(){
      $this->load->view('administracion/report/v_por_locales');
 } 
 public function temp_datos_por_locales(){       
   $this->session->set_flashdata('combo_por_local_report', $_REQUEST["combo_por_local_report"]);
 }
 public function r_por_locales(){ 
      
 //echo "aaaa:".$this->session->flashdata('combo_por_local_report') ;
     
     ini_set("pcre.backtrack_limit", "50000000"); 
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/report_general', $this->data_bienes_report("idlocales=".$this->session->flashdata('combo_por_local_report')),true); 

        $arr='<table width="100%">
            <tr>
               <td width="33%" style="text-align: left; font-size: 12px;"><img style="height: 30px;" src="'.base_url('img/logo.png').'">OFICINA DE CONTROL PATRIMONIAL</td>
                <td width="33%"  style="text-align: center; font-size: 16px;font-weight: bold;"><p>INVENTARIO FISICO DE BIENES</p><p>al 07/02/2018</p> </td>

                 <td width="33%"  style="text-align: right; font-size: 10px;"><p>{PAGENO}/{nbpg}</p><p> Fecha: {DATE j-m-Y}</p></td>
            </tr>
        </table>';
        $mpdf->SetHeader($arr);  // 'O' for Odd header

                $stylesheet =  file_get_contents(base_url('assets/administracion/print_all.css'));

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser
                
     
 }
 
 
 
 //´por areas
  public function v_por_areas(){
      $this->load->view('administracion/report/v_por_areas');
 } 
 public function temp_datos_por_areas(){       
   $this->session->set_flashdata('combo_por_area_area_report', $_REQUEST["combo_por_area_area_report"]);
 }
 public function r_por_areas(){ 
      
 //echo "aaaa:".$this->session->flashdata('combo_por_local_report') ;
     
     ini_set("pcre.backtrack_limit", "50000000"); 
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/report_general', $this->data_bienes_report("area_idarea=".$this->session->flashdata('combo_por_area_area_report')),true); 

        $arr='<table width="100%">
            <tr>
               <td width="33%" style="text-align: left; font-size: 12px;"><img style="height: 30px;" src="'.base_url('img/logo.png').'">OFICINA DE CONTROL PATRIMONIAL</td>
                <td width="33%"  style="text-align: center; font-size: 16px;font-weight: bold;"><p>INVENTARIO FISICO DE BIENES</p><p>al 07/02/2018</p> </td>

                 <td width="33%"  style="text-align: right; font-size: 10px;"><p>{PAGENO}/{nbpg}</p><p> Fecha: {DATE j-m-Y}</p></td>
            </tr>
        </table>';
        $mpdf->SetHeader($arr);  // 'O' for Odd header

                $stylesheet =  file_get_contents(base_url('assets/administracion/print_all.css'));

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser
                
     
 }
 
 
 
 //´por oficinas
  public function v_por_oficinas(){
      $this->load->view('administracion/report/v_por_oficinas');
 } 
 public function temp_datos_por_oficinas(){       
   $this->session->set_flashdata('combo_por_oficina_oficina_report', $_REQUEST["combo_por_oficina_oficina_report"]);
 }
 public function r_por_oficinas(){ 
      
 //echo "aaaa:".$this->session->flashdata('combo_por_local_report') ;
     
     ini_set("pcre.backtrack_limit", "50000000"); 
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/report_general', $this->data_bienes_report("idoficina=".$this->session->flashdata('combo_por_oficina_oficina_report')),true); 

        $arr='<table width="100%">
            <tr>
               <td width="33%" style="text-align: left; font-size: 12px;"><img style="height: 30px;" src="'.base_url('img/logo.png').'">OFICINA DE CONTROL PATRIMONIAL</td>
                <td width="33%"  style="text-align: center; font-size: 16px;font-weight: bold;"><p>INVENTARIO FISICO DE BIENES</p><p>al 07/02/2018</p> </td>

                 <td width="33%"  style="text-align: right; font-size: 10px;"><p>{PAGENO}/{nbpg}</p><p> Fecha: {DATE j-m-Y}</p></td>
            </tr>
        </table>';
        $mpdf->SetHeader($arr);  // 'O' for Odd header

                $stylesheet =  file_get_contents(base_url('assets/administracion/print_all.css'));

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser
                
     
 }
 
 
 
 
 //´por empleado
  public function v_por_empleado(){
      $this->load->view('administracion/report/v_por_empleado');
 } 
 public function temp_datos_por_empleado(){       
   $this->session->set_flashdata('combo_por_empleado_empleado_report', $_REQUEST["combo_por_empleado_empleado_report"]);
 }
 public function r_por_empleado(){ 
      
 //echo "aaaa:".$this->session->flashdata('combo_por_local_report') ;
     
     ini_set("pcre.backtrack_limit", "50000000"); 
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/report_por_empleado', $this->data_bienes_empleado_report("idempleado_oficina=".$this->session->flashdata('combo_por_empleado_empleado_report')),true); 

        $arr='<table width="100%">
            <tr>
               <td width="33%" style="text-align: left; font-size: 12px;"><img style="height: 30px;" src="'.base_url('img/logo.png').'">OFICINA DE CONTROL PATRIMONIAL</td>
                <td width="33%"  style="text-align: center; font-size: 16px;font-weight: bold;"><p>ASIGNACION DE BIENES PERSONALES</p><p>al 07/02/2018</p> </td>

                 <td width="33%"  style="text-align: right; font-size: 10px;"><p>{PAGENO}/{nbpg}</p><p> Fecha: {DATE j-m-Y}</p></td>
            </tr>
        </table>';
        $mpdf->SetHeader($arr);  // 'O' for Odd header

                $stylesheet =  file_get_contents(base_url('assets/administracion/print_all.css'));

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser
                
     
 }
  public function data_bienes_empleado_report($filtro){
     $param=array(            
                  "filtro"=>$filtro, 
            );
            $oficinas_as_empleado= new Empleado_as_oficina("","");
            $registros_= $oficinas_as_empleado->get_registros2($param);
            $datos["empleados"]=array();
            if($registros_){
                foreach ($registros_ as $rl){   
                     $param=array(            
                            "filtro"=>"idempleado_oficina=".$rl->idempleado_oficina, 
                      );
                        $bienes = new Bien("","");
                        $datos['empleados'][]=array(//"idoficina=".$id,
                           'empleado'=>$rl->apellidos.", ".$rl->nombres, 
                          'oficina'=>$rl->oficina, 
                          'area'=>$rl->area,
                          'local'=>$rl->local,
                          'bienes'=>$bienes->data_for_report($param)
                        );
                }
            } 
     return $datos;
 }
 
 public function data_bienes_report($filtro){
     $param=array(            
                  "filtro"=>$filtro  
            );
            $oficinas= new Oficina("","");
            $registros_oficinas= $oficinas->get_registros2($param);
            $datos["oficinas"]=array();
            if($registros_oficinas){
                foreach ($registros_oficinas as $rl){ 
                        $param=array(            
                              "filtro"=>"idoficina=".$rl->idoficina, 
                        );
                        $bienes = new Bien("","");
                        $datos['oficinas'][]=array(
                          'descripcion'=>$rl->descripcion, 
                          'area'=>$rl->area,
                          'local'=>$rl->local,
                          'bienes'=>$bienes->data_for_report($param)
                        );
                }
            } 
     return $datos;
 }

 public function re_papeleta($id=""){   
      
     
     
      $db_ = new Db($id,"");
      $row_ = $db_->get_row(); 
      $datos["des"]=$row_;
      $db_r = new Ddb("","");
      $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL                    
                    "filtro"=>"iddesplazamiento_bien = ".$id 
                  );
      $datos["result"] = $db_r->get_result_no_g($data_model);
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/reporte_papeleta',$datos,true);
        
        
    

        $arr='<table width="100%">
            <tr>
               <td width="33%" style="text-align: left; font-size: 12px;"><img style="height: 30px;" src="'.base_url('img/logo.png').'">OFICINA DE CONTROL PATRIMONIAL</td>
                <td width="33%"  style="text-align: center; font-size: 16px;font-weight: bold;"> </td>

                 <td width="33%"  style="text-align: right; font-size: 10px;"><p>{PAGENO}/{nbpg}</p><p> Fecha: {DATE j-m-Y}</p></td>
            </tr>
        </table>';
        $mpdf->SetHeader($arr);  // 'O' for Odd header

                $stylesheet =  file_get_contents(base_url('assets/administracion/print_all.css'));

                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser
     // echo "hola";
     
 }
}
/*
*end modules/login/controllers/index.php
*/
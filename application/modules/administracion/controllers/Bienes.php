<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once ("Crud.php");
include_once ("Locales.php");
/*include ("areas.php");*/
include_once ("Oficinas.php");
include_once ("Verificacion_de_bienes.php");
require APPPATH .'vendor/autoload.php';

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;






              # 4 generadores
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorSVG;

class Bien{   

    private $registros;//array tipo result
   
    private $registro_row=array();//array para un solo elemento
    private $tabla='formato_registro_bien';  
    private $vista='v_bienes';  
    private $idformato_registro_bien="";
    private $codigo_interno="";
    private $descripcion="";
    private $cantidad="";
    private $codigo="";
    private $valor_adquirido="";
    private $valor_neto="";
    private $fecha_adquisicion="";
    private $orden_compra="";
    private $factura="";
    private $pecosa="";
    private $guia_remision="";
  
    
    private $fecha_baja="";
    private $resolucion_baja="";
    private $causal="";
    private $asegurado = "";
    private $anio = "";
    
    
    
    //private $codigo="";
    
    
   
    private $idlocal="";
    private $idarea="";
    private $idoficina="";
    private $idempleado_oficina="";
    
    private $idtipo_bien="";
    private $tipo_bien="";
    private $idplan_contable="";
    private $idforma_adquisicion="";
    private $idestado_bien="";
    private $idproveedor="";
    private $id_bien_mm="";
    private $id_bien_mm_campo="";
    //dtalle tecnico
    private $dt_marca="";
    private $dt_modelo="";
    private $dt_tipo="";
    private $dt_color="";
    private $dt_serie="";
    private $dt_otros="";
    
    private $dtc_discoDuro="";
    private $dtc_discoDuroMarca="";
    private $dtc_discoDuroSerie="";
    
    private $dtc_procesador="";
    private $dtc_procesadorMarca="";
    private $dtc_procesadorSerie="";
    
    private $dtc_memoriaRam="";
    private $dtc_memoriaRamMarca="";
    private $dtc_memoriaRamSerie="";
    
    private $dtc_placa="";
    private $dtc_placaMarca="";
    private $dtc_placaSerie="";
    
    private $reg_total="";

    private $idusuario="";
        
    public function __construct($id="",$param=array(),$idusuario="",$anio="")
    {      
        $this->anio=$anio;
        $this->idusuario=$idusuario;
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
                'tabla' =>$this->vista,  
              );
          }
        
        $getResult = new Crud($params);     
        $this->registros=$getResult->getRegisterResult();
        
        
        $getTotal = new Crud($params);     
        $this->reg_total=$getTotal->getTotal();
         }
              
            
        //row
        //
        //OBTENEMOS DATOS DE LA BASE  DE DATOS
        if($id<>""){            
          $params = array(
            'tabla' => $this->vista,
            "filtro"=>"idformato_registro_bien='".$id."'"              
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
    public function get_registros_filtro_por_oficina($id_ofi=""){
        $params = array(
                'tabla' =>$this->vista,  
                "filtro"=>"idoficina='".$id_ofi."'"    
              );
         $getResult = new Crud($params);     
         return $getResult->getRegisterResult();       
    }
     public function get_registros_despla_empleado_ofi($id_ofi=""){
        $params = array(
                'tabla' =>$this->vista,  
                "filtro"=>"idempleado_oficina='".$id_ofi."'"    
              );
         $getResult = new Crud($params);     
         return $getResult->getRegisterResult();       
    }
    public function get_registro_row(){
        return $this->registro_row;
       
    } 
    public function get_total(){
        return $this->reg_total;
       
    }
    public function set_row($data_request = array()){  
        //$this->anio=date("Y");
        //$this->anio=
        $this->idformato_registro_bien=$data_request['id_bien_crud'];
        $this->codigo_interno=substr($data_request['codigo_bien'], 0, 8);
        $this->descripcion=$data_request['nombre_bien'];
        $this->cantidad=$data_request['cantidad'];
        $this->codigo=$data_request['codigo_'];
        $this->valor_adquirido=$data_request['valor_adquirido'];
        $this->valor_neto=$data_request['valor_neto'];
        $this->fecha_adquisicion=$data_request['fecha_adquisicion'];
        $this->orden_compra=$data_request['orden_compra'];
        $this->factura=$data_request['factura'];
        $this->pecosa=$data_request['pecosa'];
        $this->guia_remision=$data_request['guia_remision'];
        $this->tipo_bien=$data_request['tipo_bien'];
       // $this->asegurado=$data_request['asegurado'];
        //$this->fecha_baja=$data_request['fecha_baja'];
        //$this->resolucion_baja=$data_request['resolucion_baja'];
        if($data_request['idplan_contable']=="" ){
            $this->idplan_contable="null";
        }else{
           $this->idplan_contable=$data_request['idplan_contable']; 
        }
        
        
        
        $this->idlocal=$data_request['combo_locales'];
        $this->idarea=$data_request['combo_areas'];
        $this->idoficina=$data_request['combo_oficinas'];
        if(isset($data_request['combo_empleados']) and $data_request['combo_empleados']<>"" ){
            $this->idempleado_oficina=$data_request['combo_empleados'];
        }else{
            $this->idempleado_oficina="null";
        }
        
        if($data_request['idproveedor_form_modal']==""){
            $this->idproveedor="null";
        }else{           
            $this->idproveedor=$data_request['idproveedor_form_modal'];
        }
        if(isset($data_request['asegurado'])){
            $this->asegurado=$data_request['asegurado'];
        }else{
            $this->asegurado="";
        }
        $this->idtipo_bien=$data_request['tipo_bien'];
        if($this->idtipo_bien==1){
            $this->id_bien_mm_campo="idtipo_bien";
        }else{
           $this->id_bien_mm_campo="idCatalogo";
        }
        
        $this->id_bien_mm=$data_request['id_bien_mm'];
       // $this->idplan_contable=$data_request['combo_locales'];
        $this->idforma_adquisicion=$data_request['combo_forma_adquisicion'];
        $this->idestado_bien=$data_request['combo_estado_bien'];
        
        //seteamos detalle tecnico
        $this->dt_marca=$data_request['dt_marca'];
        $this->dt_modelo=$data_request['dt_modelo'];
        $this->dt_tipo=$data_request['dt_tipo'];
        $this->dt_color=$data_request['dt_color'];
        $this->dt_serie=$data_request['dt_serie'];
        $this->dt_otros=$data_request['dt_otros'];
        
        if(isset($data_request['resolucion_baja'])){
            
            $this->resolucion_baja=$data_request['resolucion_baja'];
            $this->fecha_baja=$data_request['fecha_baja'];
            $this->causal=$data_request['causal'];
        }else{           
            $this->resolucion_baja="";
            $this->fecha_baja="";
            $this->causal="";
        }
        
        $this->dtc_discoDuro=$data_request['dtc_discoDuro'];
        $this->dtc_discoDuroMarca=$data_request['dtc_discoDuroMarca'];
        $this->dtc_discoDuroSerie=$data_request['dtc_discoDuroSerie'];
      
        $this->dtc_procesador=$data_request['dtc_procesador'];
        $this->dtc_procesadorMarca=$data_request['dtc_procesadorMarca'];
        $this->dtc_procesadorSerie=$data_request['dtc_procesadorSerie'];
         
        $this->dtc_memoriaRam=$data_request['dtc_memoriaRam'];
        $this->dtc_memoriaRamMarca=$data_request['dtc_memoriaRamMarca'];
        $this->dtc_memoriaRamSerie=$data_request['dtc_memoriaRamSerie'];

        $this->dtc_placa=$data_request['dtc_placa'];
        $this->dtc_placaMarca=$data_request['dtc_placaMarca'];
        $this->dtc_placaSerie=$data_request['dtc_placaSerie'];

    
       
    } 
     public function guardar_en_bd($data_request = array()){  
         for($i=1;$i<=$this->cantidad;$i++){
              $new_codigo = $this->codigo_interno.str_pad($this->obtener_ultimo_codigo(), 4, "0", STR_PAD_LEFT); 
       
           $params= array(
                "tabla"=>$this->tabla,              
                'campos' => "codigo_interno,descripcion,".$this->id_bien_mm_campo.",tipo_bien,idforma_adquisicion,fecha_adquisicion,orden_compra,factura,pecosa,guia_remision,idestado_bien,idoficina,idanio,valor_adquirido,valor_neto,asegurado,dt_marca,dt_modelo,dt_tipo,dt_color,dt_serie,dt_otros,dtc_discoDuro,dtc_discoDuroMarca,dtc_discoDuroSerie,dtc_procesador,dtc_procesadorMarca,dtc_procesadorSerie,dtc_memoriaRam,dtc_memoriaRamMarca,dtc_memoriaRamSerie,dtc_placa,dtc_placaMarca,dtc_placaSerie,resolucion_baja,fecha_baja,causal,codigo,idplan_contable,idproveedor,idempleado_oficina,idusuarios",
                "values"=>'"'.$new_codigo.'","'
                          .$this->descripcion.'","'
                          .$this->id_bien_mm.'","'
                          .$this->tipo_bien.'","'
                          .$this->idforma_adquisicion.'","'
                          .$this->fecha_adquisicion.'","'
                          .$this->orden_compra.'","'
                          .$this->factura.'","'
                          .$this->pecosa.'","'
                          .$this->guia_remision.'","'
                          .$this->idestado_bien.'","'
                          .$this->idoficina.'","'
                          .$this->anio.'","'
                          .$this->valor_adquirido.'","'
                          .$this->valor_neto.'","'
                          .$this->asegurado.'","'
                          .$this->dt_marca.'","'
                          .$this->dt_modelo.'","'
                          .$this->dt_tipo.'","'
                          .$this->dt_color.'","'
                          .$this->dt_serie.'","'
                          .$this->dt_otros.'","'
                          .$this->dtc_discoDuro.'","'
                          .$this->dtc_discoDuroMarca.'","'
                          .$this->dtc_discoDuroSerie.'","'
                          .$this->dtc_procesador.'","'
                          .$this->dtc_procesadorMarca.'","'
                          .$this->dtc_procesadorSerie.'","'
                          .$this->dtc_memoriaRam.'","'
                          .$this->dtc_memoriaRamMarca.'","'
                          .$this->dtc_memoriaRamSerie.'","'
                          .$this->dtc_placa.'","'
                          .$this->dtc_placaMarca.'","'
                          .$this->dtc_placaSerie.'","'                          
                          .$this->resolucion_baja.'","'
                          .$this->fecha_baja.'","'
                          .$this->causal.'","'
                          .$this->codigo.'",'
                          .$this->idplan_contable.','
                          .$this->idproveedor.','
                          .$this->idempleado_oficina.',"'
                          .$this->idusuario.'"'                
            );
            $insert = new Crud($params);
            $id_new = $insert->insert();  
         }
               
    }
     public function modificar_en_bd($data_request = array()){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idformato_registro_bien='".$this->idformato_registro_bien."'",
                'campos_values_update'=>
                   "idforma_adquisicion='".$this->idforma_adquisicion
                   ."', fecha_adquisicion='".$this->fecha_adquisicion
                   ."', orden_compra='".$this->orden_compra
                   ."', factura='".$this->factura
                   ."', pecosa='".$this->pecosa
                   ."', guia_remision='".$this->guia_remision
                   ."', orden_compra='".$this->orden_compra
                   ."', idestado_bien='".$this->idestado_bien
                   ."', idoficina='".$this->idoficina
                   ."', valor_adquirido='".$this->valor_adquirido
                   ."', valor_neto='".$this->valor_neto
                   ."', dt_marca='".$this->dt_marca
                   ."', dt_modelo='".$this->dt_modelo
                   ."', dt_tipo='".$this->dt_tipo
                   ."', dt_color='".$this->dt_color
                   ."', dt_serie='".$this->dt_serie
                   ."', dt_otros='".$this->dt_otros
                   ."', dtc_discoDuro='".$this->dtc_discoDuro
                   ."', dtc_discoDuroMarca='".$this->dtc_discoDuroMarca
                   ."', dtc_discoDuroSerie='".$this->dtc_discoDuroSerie  
                   ."', dtc_procesador='".$this->dtc_procesador
                   ."', dtc_procesadorMarca='".$this->dtc_procesadorMarca
                   ."', dtc_procesadorSerie='".$this->dtc_procesadorSerie   
                   ."', dtc_memoriaRam='".$this->dtc_memoriaRam
                   ."', dtc_memoriaRamMarca='".$this->dtc_memoriaRamMarca
                   ."', dtc_memoriaRamSerie='".$this->dtc_memoriaRamSerie     
                   ."', dtc_placa='".$this->dtc_placa
                   ."', dtc_placaMarca='".$this->dtc_placaMarca
                   ."', dtc_placaSerie='".$this->dtc_placaSerie       
                   //."', resolucion_baja='".$this->resolucion_baja
                  // ."', fecha_baja='".$this->fecha_baja
                  // ."', causal='".$this->causal
                   ."', codigo='".$this->codigo
                   ."', idplan_contable=".$this->idplan_contable
                   .", idproveedor=".$this->idproveedor  
                   .",idempleado_oficina=".$this->idempleado_oficina
              );
            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function set_delete_virtual($id){           
             $params = array(
                'tabla' => $this->tabla,
                "filtro"=>"idformato_registro_bien='".$id."'",
                'campos_values_update'=>"EliminadoSis=1"
              );
            $update_register = new Crud($params);     
            $update_register->update();
       
    }
    public function obtener_ultimo_codigo(){  
        //echo "tmr";
             $params = array(
                'tabla' => $this->tabla,
                'select_campos'=>"MAX(codigo_interno) as codigo_interno",
                "filtro"=>" substring(codigo_interno,1,8)='".$this->codigo_interno."'"
              );
            $ultimo_registro = new Crud($params);
            $num=1;
            if($ultimo_registro->getRegisterRow()){
                $rest = substr($ultimo_registro->getRegisterRow()->codigo_interno, -4);
                $num=intval($rest)+1;
            }           
            return $num;
            //return $ultimo_registro;
    }
     public function data_for_report($param=array()){
             $params = array(
                'tabla' =>$this->vista,                 
                'filtro'=>$param['filtro'], 
                'order'=>"idformato_registro_bien"
              ); 
             $getResult = new Crud($params);     
            return $getResult->getRegisterResult();
     }
    
    public function genera_etiqueta($c=""){
             $params = array(
                'tabla' =>$this->vista,                 
                "filtro"=>"idformato_registro_bien in(".$c.")",
                'order'=>"idformato_registro_bien"
              ); 
             $getResult = new Crud($params);     
            $registros=$getResult->getRegisterResult();
            
             
         
        
                $spreadsheet = new Spreadsheet();
                $j=count($registros);               
                $j= round(($j/4),1); 
                $aux = (string) $j;
                $decimal = substr( $aux, strpos( $aux, "." ) );
                if($decimal>0 and $decimal<5){
                   $j=$j+1; 
                }
                $k=4;
                $ii=1;
                $f=1;
                $f5=1;
                for ($h=1; $h<=$j ; $h++) {
                 $i=1;
                 $letra="A";
                    
                    foreach ($registros as $row) {
                        if($i>$k-4 and  $i<=$k){
                           // $l=$letra;
                            $logo_c=$letra.$ii;
                            $i_2=$ii+2;
                            $c1=$letra.$i_2;
                            $i2=$ii+3;
                            $c11=$letra.$i2;                            
                            $i3=$ii+4;
                            $c111=$letra.$i3;                            
                            $i4=$ii+5;
                            $c1111=$letra.$i4; 
                            $i5=$ii+6;
                            $c11111=$letra.$i5;   //codigo_barra
                            $spreadsheet->getActiveSheet()->setCellValue($c1, "LOCAL" );
                           // $spreadsheet->getActiveSheet()->setCellValue($c1, $this->codigo_barra() );
                            $spreadsheet->getActiveSheet()->setCellValue($c11, "AREA" );  
                            $spreadsheet->getActiveSheet()->setCellValue($c111, "OFICINA" );
                            $spreadsheet->getActiveSheet()->setCellValue($c1111, "CODIGO" );
                            $spreadsheet->getActiveSheet()->setCellValue($c11111, "CONTROL PATRIMONIAL" );
                            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setWidth(6);
                            $spreadsheet->getActiveSheet()->getStyle($c1.":".$c1111)->getFont()->setSize(7);
                            $letra++;
                            $c2=$letra.$i_2;                              
                            $c22=$letra.$i2;
                            $c222=$letra.$i3;
                            $c2222=$letra.$i4;
                            $c22222=$letra.$i5;                          
                            $spreadsheet->getActiveSheet()->setCellValue($c2, $row->local );
                            $spreadsheet->getActiveSheet()->setCellValue($c22, $row->area );
                            $spreadsheet->getActiveSheet()->setCellValue($c222, $row->oficina );
                            //$spreadsheet->getActiveSheet()->setCellValue($c222, '<img alt=$row->codigo_interno src=barcode.php?text=$row->codigo_interno />' );
                            $data_anio = substr($row->fecha_adquisicion, 0, -6);
                            $spreadsheet->getActiveSheet()->setCellValue($c2222, $row->codigo_interno." - ".$data_anio );  

                            
                            $spreadsheet->getActiveSheet()->getStyle($c2.":".$c2222)->getFont()->setBold(true);              
                            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setWidth(30);                
                            $styleThinBlackBorderOutline = [
                                'borders' => [
                                    'outline' => [
                                        'borderStyle' => Border::BORDER_THIN,
                                        'color' => ['argb' => 'FF000000'],
                                    ],
                                ],
                            ];
                            $spreadsheet->getActiveSheet()->getStyle($logo_c.":".$c22222)->applyFromArray($styleThinBlackBorderOutline);                           
                            
                            $path = "img/ujcm.png";
                            //$path = "barcode.php?text=".$row->codigo_interno."";
                            $drawing = new Drawing();
                            $drawing->setName('Logo');
                            $drawing->setDescription('Logo');
                            $drawing->setCoordinates($logo_c);
                            $drawing->setPath($path);
                            $drawing->setHeight(37);
                            $drawing->setOffsetX(90);
                            $drawing->setOffsetY(1);
                            //$drawing->setRotation(25);
                            $drawing->setWorksheet($spreadsheet->getActiveSheet());                           
                       
                            $letra++;
                        }
                        $i++;
                     }
                 $f++; 
                 if($f==$f5+5){
                     $ii=$ii+7+2; 
                     $f5=$f5+6;
                     //$spreadsheet->getActiveSheet()->getPageSetup()->setPrintArea('A1:H35,A36:H50');
                 }else{
                      $ii=$ii+7;
                 }
                
                 $k=$k+4;
                
                }

        
         $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
         $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

	 $spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.3);	
         $spreadsheet->getActiveSheet()->getPageMargins()->getLeft(0.1);
         $spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.75);
         
       $writer = new Xlsx($spreadsheet);

		$filename = 'Etiquetas';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');
		
		$writer->save('php://output');
       
    }
            
    public function genera_etiqueta_pdf($c=""){
          
              $params = array(
                'tabla' =>$this->vista,                 
                "filtro"=>"idformato_registro_bien in(".$c.")",
                'order'=>"idformato_registro_bien"
              ); 
             $getResult = new Crud($params);     
            $registros=$getResult->getRegisterResult();
            return $registros;
       
    }    


    public function codigo_barra(){

      

           # Crear generador
            $generador = new BarcodeGeneratorPNG();
            # Ajustes
            $texto = "parzibyte.me";
            $tipo = $generador::TYPE_CODE_128;
            $imagen = $generador->getBarcode($texto, $tipo);
            # Encabezado para que el navegador sepa que es una imagen
            //header("Content-type: image/png");
            # Hora de imprimir*/
            echo $imagen;



                      # Crear generador
         /* $generador = new BarcodeGeneratorPNG();
          # Ajustes
          $texto = "parzibyte.me";
          $tipo = $generador::TYPE_CODE_128;
          $imagen = $generador->getBarcode($texto, $tipo);
          # Aquí se guarda la imagen
          $nombreArchivo = "codigo.png";
          # Escribir los datos
          $bytesEscritos = file_put_contents($nombreArchivo, $imagen);
          # Comprobar si todo fue bien
          if ($bytesEscritos !== false) {
              echo "Correcto. Se escribieron $bytesEscritos bytes en $nombreArchivo";

              header("Content-type: image/png");

              echo $bytesEscritos;
          } else {
              echo "Error guardando código de barras";*/


    }
    
    
}


class Bienes extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
  public function index() { 
      if($this->session->userdata('logged_in')==TRUE){
          $datos['contenido']    ='administracion/bienes';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='BIENES'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/bienes','assets/administracion/menu','assets/administracion/jquery.mask');
          $this->load->view('includes/template',$datos);
             }else{
      redirect(base_url(), 'refresh');

    }
   
 }
public function leerRegistro($id_oficina="") {        
      if($_SERVER['REQUEST_METHOD']=="GET"){  
            $parameters = $this->input->get();//RECIBIMOS 3 PARAMETROS DE LA GRILLA            
            $paginas    = $parameters['$inlinecount'];//PARAMETRO PARA MOSTRAR TODAS LAS PAGINAS              
            if (!empty($parameters['$skip'])) { // <= false
             $skip       = $parameters['$skip'];//PARAMETRO PARA MOSTRAR DESDE DODNE MOSTRAR LOS REGISTROS
                // No está vacía (true)

            } else {
             $skip       = 0;//PARAMETRO PARA MOSTRAR DESDE DODNE MOSTRAR LOS REGISTROS
                // Está vacía (false)
            }


            $top        = $parameters['$top'];//PARAMETRO PARA MOSTRAR HASTA DQUE REGISTRO  EN MYSQL LIMIT  0, 12   
            if(!empty($id_oficina)) {
               $filtro_oficina="  idoficina=$id_oficina  "; 
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
                    "filtro"=>"$i AND $filtro_oficina",
                    "order"=>"idformato_registro_bien  DESC"
                  );
                }else{

                    $param=array(            
                        "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                        "top"=>$top, //HASTA 
                        "order"=>"idformato_registro_bien  DESC",
                        "filtro"=>"$filtro_oficina",
                        //"order"=>"dtFechaSis  DESC"
                     );
                }   

            }else{

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
                    "filtro"=>$i,
                    "order"=>"idformato_registro_bien  DESC"
                  );
                }else{

                    $param=array(            
                        "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                        "top"=>$top, //HASTA 
                        "order"=>"idformato_registro_bien  DESC",                 
                        //"order"=>"dtFechaSis  DESC"
                     );
                }   
              
            }         
            
            
            $data = new Bien("",$param);
            $registros=$data->get_registros();            
            $total=$data->get_total();//$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['data']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA      

                //verificamos si esta verificado
                    $param=array();
                    $data = new Veb($reg->idformato_registro_bien,$this->session->userdata('anio'),"",$param,$this->session->userdata('idusuario'));
                    $estado=$data->get_estado();
                    $estado_="check_ok_accept_apply_1582.png";
                    if($estado=="F"){
                      $estado_="minusflat_105990.png";
                    }
                    
                //fin                          
                  $datos['data'][]=array(
                      'idformato_registro_bien'=>$reg->idformato_registro_bien,
                      'codigo_interno'=>$reg->codigo_interno,
                      'estado'=>$estado_,
                      'descripcion'=>$reg->descripcion,
                      'fecha_adquisicion'=>$reg->fecha_adquisicion,
                      'local'=>$reg->local,
                      'area'=>$reg->area,
                      'oficina'=>$reg->oficina,
                      'estado_bien'=>$reg->estado_bien,  
                      'pecosa'=>$reg->pecosa,
                      'dt_marca'=>$reg->dt_marca,
                      'dt_modelo'=>$reg->dt_modelo,
                      'dt_serie'=>$reg->dt_serie,
                      'dt_color'=>$reg->dt_color,
                      'dt_otros'=>$reg->dt_otros,
                      'factura'=>$reg->factura,  
                      'codigo_cuenta'=>$reg->codigo_cuenta,  
                      'valor_adquirido'=>$reg->valor_adquirido,
                      'valor_neto'=>$reg->valor_neto,
                      'orden_compra'=>$reg->orden_compra,
                      'codigo'=>$reg->codigo,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['data']). ",\"count\":".$total."}"; 
     }      
 }
 public function leerRegistro_($idempleado_ofi="",$idoficina="") {        
      
                 
                $param=array();
            
            
            $data = new Bien("",$param);
            if($idempleado_ofi!="no"){
                $registros=$data->get_registros_despla_empleado_ofi($idempleado_ofi); 
            }
            //echo "idoficina".$idoficina;
            if($idoficina!="no"){              
                $registros=$data->get_registros_filtro_por_oficina($idoficina); 
            }
            
            $datos['data']=array();
            if($registros){
                foreach ($registros as $reg) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['data'][]=array(
                      'idformato_registro_bien'=>$reg->idformato_registro_bien,
                      'codigo_interno'=>$reg->codigo_interno,
                      'descripcion'=>$reg->descripcion,
                      'fecha_adquisicion'=>$reg->fecha_adquisicion,
                      'local'=>$reg->local,
                      'area'=>$reg->area,
                      'oficina'=>$reg->oficina,
                      'estado_bien'=>$reg->estado_bien,
                      'valor_adquirido'=>$reg->valor_adquirido,
                      'valor_neto'=>$reg->valor_neto,
                      'orden_compra'=>$reg->orden_compra,
                      'codigo_cuenta'=>$reg->codigo_cuenta,
                  );
                }
              }              
             header("Content-type: application/json");
             echo  json_encode($datos['data']); 
       
 }
 public function reporte(){
     
 }
 
public function form_() {    
   $this->load->view('administracion/form_bienes');
 }
public function datos_json(){ 
      $id=$this->input->get('id');
      $row_json = new Bien($id,"");
      $row_ = $row_json->get_registro_row(); 
      $asegurado=false;
      if($row_->asegurado=="on"){
          $asegurado=true;
      }
      
      if($row_->fecha_baja=="0000-00-00"){
          $fecha_b="";
      }else{
          $fecha_b=formatear_fecha_syncfusion($row_->fecha_baja);
      }
      header('Content-type: application/json');
      echo json_encode(array(
              "id_bien_crud"=>$row_->idformato_registro_bien,
              "tipo_bien_bien"=>$row_->tipo_bien,
              "codigo_bien"=>$row_->codigo_interno,  
              "nombre_bien"=>$row_->descripcion,
              "codigo_"=>$row_->codigo,
              "valor_adquirido"=>$row_->valor_adquirido,
              "valor_neto"=>$row_->valor_neto,
              "codigo_cuenta"=>$row_->codigo_cuenta,
              "nombre_cuenta"=>$row_->nombre_cuenta,
              "idplan_contable"=>$row_->idplan_contable,
              "idforma_adquicision_bien"=>$row_->idforma_adquisicion,
              "fecha_adquisicion"=>$row_->fecha_adquisicion,
              "idestado_bien_bien"=>$row_->idestado_bien,
              "orden_compra"=>$row_->orden_compra,
              "factura"=>$row_->factura,
              "pecosa"=>$row_->pecosa,
              "guia_remision"=>$row_->guia_remision,
              "idlocal_bien"=>$row_->idlocales,
              "idarea_bien"=>$row_->idarea,
              "idoficina_bien"=>$row_->idoficina,
              "idempleado_oficina_bien"=>$row_->idempleado_oficina,
              "idempleado_oficina_bien"=>$row_->idempleado_oficina,
              "idproveedor_form_modal"=>$row_->idproveedor,
              "razon_social_form_modal"=>$row_->razon_social,
              "ruc_form_modal"=>$row_->ruc,
          
              "dt_marca"=>$row_->dt_marca, 
              "dt_modelo"=>$row_->dt_modelo,
              "dt_tipo"=>$row_->dt_tipo,
              "dt_color"=>$row_->dt_color,
              "dt_serie"=>$row_->dt_serie,
              "dt_otros"=>$row_->dt_otros,
              
              "dtc_discoDuro"=>$row_->dtc_discoDuro,
              "dtc_discoDuroMarca"=>$row_->dtc_discoDuroMarca,
              "dtc_discoDuroSerie"=>$row_->dtc_discoDuroSerie,
              "dtc_procesador"=>$row_->dtc_procesador,
              "dtc_procesadorMarca"=>$row_->dtc_procesadorMarca,
              "dtc_procesadorSerie"=>$row_->dtc_procesadorSerie,
              "dtc_memoriaRam"=>$row_->dtc_memoriaRam,
              "dtc_memoriaRamMarca"=>$row_->dtc_memoriaRamMarca,
              "dtc_memoriaRamSerie"=>$row_->dtc_memoriaRamSerie,
              "dtc_placa"=>$row_->dtc_placa,
              "dtc_placaMarca"=>$row_->dtc_placaMarca,
              "dtc_placaSerie"=>$row_->dtc_placaSerie,
          
              "causal"=>$row_->causal,
              "resolucion_baja"=>$row_->resolucion_baja,
              "fecha_baja_bien"=>$fecha_b,
              "fecha_adquisicion_bien"=>formatear_fecha_syncfusion($row_->fecha_adquisicion),
              "asegurado_bien"=>$asegurado,
             // "ruc_form_modal"=>$row_->ruc,
             // "idforma_adquicision_bien"=>$row_->idforma_adquisicion,
          
              
            
            /*$this->codigo=$data_request['codigo_'];
            $this->valor_adquirido=$data_request['valor_adquirido'];
            $this->valor_neto=$data_request['valor_neto'];
            $this->fecha_adquisicion=$data_request['fecha_adquisicion'];
            $this->orden_compra=$data_request['orden_compra'];
            $this->factura=$data_request['factura'];
            $this->pecosa=$data_request['pecosa'];
            $this->guia_remision=$data_request['guia_remision'];
            $this->tipo_bien=$data_request['tipo_bien'];*/
          
            ));
      
      
   }   
 public function guardar() {      
    $bien = new Bien("","",$this->session->userdata('idusuario'),$this->session->userdata('anio'));
    $bien->set_row($_REQUEST);
     if($_REQUEST['id_bien_crud']=="autogenerado"){
        $bien->guardar_en_bd();     
     }else{
        $bien->modificar_en_bd();  
     }
     
    //$query = $this->ma->guardar_datos_actor($_REQUEST); 
 }
public function eliminar($id="") {      
       $eleminar_ = new Bien("");
       $eleminar_->set_delete_virtual($id);
 }
 public function ge(){
   
     $data = $this->input->post('data'); 
     // print_r($data);
      $c="";
      $i=1;
      $t=count($data);
      if($data){
        foreach ($data as $d){
         // echo $d["idformato_registro_bien"];
            if($t==$i){
                $c=$c.$d["idformato_registro_bien"]; 
            }else{
                $c=$c.$d["idformato_registro_bien"].",";
            }
          
          $i++;
        }  
      }//id in(90,100,150)*/
    $this->session->set_flashdata('data', $c);
      
    
     
 }
 public function gene_x(){
   
   

     $ge = new Bien("",""); 
    
     $ge->genera_etiqueta($this->session->flashdata('data'));


 }
 public function temp_generar_etiquetas_pdf(){
   $data = $this->input->post('data'); 
     // print_r($data);
      $c="";
      $i=1;
      $t=count($data);
      if($data){
        foreach ($data as $d){
         // echo $d["idformato_registro_bien"];
            if($t==$i){
                $c=$c.$d["idformato_registro_bien"]; 
            }else{
                $c=$c.$d["idformato_registro_bien"].",";
            }
          
          $i++;
        }  
      }//id in(90,100,150)*/
    $this->session->set_flashdata('data', $c);

 }
 public function gene_pdf(){

 $ge = new Bien("","");     
 $datos['bienes']=$ge->genera_etiqueta_pdf($this->session->flashdata('data'));



  # Crear generador
           /* $generador = new BarcodeGeneratorPNG();
            # Ajustes
            $texto = "parzibyte.me";
            $tipo = $generador::TYPE_CODE_128;
            $imagen = $generador->getBarcode($texto, $tipo);
             $datos['imagen']=$imagen;*/
            # Encabezado para que el navegador sepa que es una imagen
            //header("Content-type: image/png");
            # Hora de imprimir*/
      //echo $imagen;

      // $this->load->view("administracion/report/etiqueta",$datos);
          


             ini_set("pcre.backtrack_limit", "50000000");


     

         /*  header("Content-type: image/png");
   echo $imagen;*/
        
      $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
    //  $mpdf = new \Mpdf\Mpdf('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
        $html = $this->load->view('report/etiqueta',$datos,true);       
        
    


                $stylesheet =  file_get_contents(base_url('assets/administracion/etiqueta.css'));
               // $mpdf->SetDisplayMode('fullpage');
               // $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
                $mpdf->WriteHTML($stylesheet,1);
                $mpdf->WriteHTML($html,2);
                $mpdf->Output(); // opens in browser*/
            





     
 }


  public function re(){   
      ini_set("pcre.backtrack_limit", "50000000");
            $param=array(            
                   
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
      
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','setAutoTopMargin' => "stretch"]);
       
        $html = $this->load->view('report/report_general',$datos,true);
        
        
    

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
     // echo "hola";
     
 }
 
}
/*
*end modules/login/controllers/index.php
*/
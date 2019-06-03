<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Peliculas extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 $this->load->model('administracion/model_peliculas','mp'); 
 //$this->load->model('index_model');
 
 }
  public function index() {     
    //  if($this->session->userdata('logged')==TRUE){       
          $datos['contenido']    ='administracion/peliculas';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='CARL NET PLAY'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/js_all','assets/administracion/js_peliculas');

          $this->load->view('includes/template',$datos);
     /*  }else{

         redirect(base_url('login/autenteficacion'), 'refresh');
       }  */ 
 }
 //CODIGO PARA DIRECTOR
  public function leerRegistroPeliculas() {        
      if($_SERVER['REQUEST_METHOD']=="GET"){  
            $parameters = $this->input->get();//RECIBIMOS 3 PARAMETROS DE LA GRILLA            
            $paginas    = $parameters['$inlinecount'];//PARAMETRO PARA MOSTRAR TODAS LAS PAGINAS
            $skip       = $parameters['$skip'];//PARAMETRO PARA MOSTRAR DESDE DODNE MOSTRAR LOS REGISTROS
            $top        = $parameters['$top'];//PARAMETRO PARA MOSTRAR HASTA DQUE REGISTRO  EN MYSQL LIMIT  0, 12            
            if(isset($parameters['$filter'])){    
                $palabras = explode ("(substringof('",  $parameters['$filter']);
                $parametro_busqueda = explode ("',tolower(",  $palabras[1]);
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"pelicula",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top, //HASTA 
                    "filtro"=>"nombres LIKE '%{$parametro_busqueda[0]}%' OR apellidos LIKE '%{$parametro_busqueda[0]}%'" 
                  );
            }else{
                $data_model=array(//ARMAMOS EL ARRAY PARAMETROS PARA ARMAR LA CONSULTA EN EL MODEL
                    "tabla"=>"pelicula",//NOMBRE DE LA TABLA 
                    "skip"=>$skip,//EMPEZAR AMOSTRAR REGISTROS  DESDE 
                    "top"=>$top //HASTA 
                    //"order"=>"dtFechaSis  DESC"
                 );
            }   
            $result = $this->ma->getRegisterResult($data_model);//OBTENEMOS LA CONSULTA EN UN RESUL ARRAY
            $total=$this->ma->getTotal($data_model);//OBTENEMOS EL TOTAL DE REGISTROS
            $datos['result']=array();
            if($result){
                foreach ($result as $row) {   //ARMAMOS EL ARRAY PARA MOSTRAR EN LA GRILLA                                
                  $datos['result'][]=array(
                      'peliculaID'=>$row->pelicula_id,
                      'peliculaTitulo'=>$row->titulo,
                      'peliculaDsc'=>$row->description,
                      'peliculaPoster'=>$row->archivo_poster,
                    );
                }
              }              
             header("Content-type: application/json");
             echo  "{\"result\":" .json_encode($datos['result']). ",\"count\":".$total."}"; 
     }      
 }
 
public function form_pelicula() {    
   $this->load->view('administracion/form_pelicula');
 }
public function datos_json_pelicula(){ 
      $id=$this->input->get('id');
       $data_model=array(
          "tabla"=>"pelicula",
          "filtro"=>"pelicula_id=".$id."" 
        );  
      $query = $this->ma->getRegisterRow($data_model);
      if($query){
           //recuperamos sus generos
           $data_model=array(
                "tabla"=>"pelicula_genero",
                "filtro"=>"pelicula_id=".$id."" 
              );  
            $query_generos = $this->ma->getRegisterResult($data_model);
            $generos=array();
            if($query_generos){
              foreach ($query_generos as $row) {
                $generos[]=array(
                'peliculaID'=>$row->pelicula_id,
                'generoID'=>$row->genero_id
              );
              }
            }
            //recuperamos sus actores
           $data_model=array(
                "tabla"=>"pelicula_actor",
                "filtro"=>"pelicula_id=".$id."" 
              );  
            $query_actores = $this->ma->getRegisterResult($data_model);
            $actores=array();
            if($query_actores){
              foreach ($query_actores as $row) {
                $actores[]=array(
                'peliculaID'=>$row->pelicula_id,
                'actorID'=>$row->actor_id
              );
              }
            }
                      
            header('Content-type: application/json');
            echo json_encode(array(
              "id_pelicula_crud"=>$query->pelicula_id,
              "titulo_p"=>$query->titulo,              
              "dsc_p"=>$query->description,
              "year_p"=>$query->lanzamiento_anio,
              "upload"=>$query->archivo_pelicula,
              "id_archivo_temp"=>$query->archivo_pelicula,
          
              "upload_poster"=>$query->archivo_poster,
              "id_archivo_temp_poster"=>$query->archivo_poster,
              
          
              "upload_trailer"=>$query->archivo_trailer,
              "id_archivo_temp_trailer"=>$query->archivo_trailer,
          
              "upload_sub"=>$query->archivo_sub_titulo_forzado,
              "id_archivo_temp_sub"=>$query->archivo_sub_titulo_forzado,
                
                "upload_baner"=>$query->archivo_baner,
              "id_archivo_temp_baner"=>$query->archivo_baner,
                
                
              "generos_multiselect"  =>$generos,
              "actores_multiselect"  =>$actores,
             // "director"=>$query->director_id,
              "director_pelicula_h"=>$query->director_id,
            ));
      }
    
   }   
 public function guardar_pelicula() {  
            print_r($_REQUEST);
            if (isset($_FILES['mp4_pelicula_']['name'][0]) &&  isset($_FILES['poster_pelicula_']['name'][0]) &&  isset($_FILES['trailer_pelicula_']['name'][0]) &&  isset($_FILES['sub_pelicula_']['name'][0]) &&  isset($_FILES['baner_pelicula_']['name'][0])) { //si son 5 ARCHIVOS ABRA 
                
                //cuando todos los ipunt file mandan archivos
                
                if($_REQUEST['id_pelicula_crud']=="autogenerado"){
                        $nombre_archivo=generateRandomString();
                        $file = $nombre_archivo.".".obtenerExtensionFichero($_FILES['mp4_pelicula_']['name'][0]);//nuevo nombre para el archivo;    
                        
                        //par el poster
                        $nombre_archivo_poster=generateRandomString();
                        $file_poster = $nombre_archivo_poster.".".obtenerExtensionFichero($_FILES['poster_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el trailer
                        $nombre_archivo_trailer=generateRandomString();
                        $file_trailer = $nombre_archivo_trailer.".".obtenerExtensionFichero($_FILES['trailer_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                        //par el sub
                        $nombre_archivo_sub=generateRandomString();
                        $file_sub = $nombre_archivo_sub.".".obtenerExtensionFichero($_FILES['sub_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el baner
                        $nombre_archivo_baner=generateRandomString();
                        $file_baner = $nombre_archivo_baner.".".obtenerExtensionFichero($_FILES['baner_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                        
                        
                }else{  
                  $file = $_REQUEST['id_archivo_temp'];//cuando se modificar se chanca el archivo 
                  $file_poster = $_REQUEST['id_archivo_temp_poster'];
                  $file_trailer = $_REQUEST['id_archivo_temp_trailer'];
                  $file_sub = $_REQUEST['id_archivo_temp_sub'];
                  $file_baner = $_REQUEST['id_archivo_temp_baner'];
                }                 
                if(!is_dir("files/peliculas/mp4/"))//mp4
                mkdir("files/peliculas/mp4/", 0777);                
                if(!is_dir("files/peliculas/poster/"))//poster
                mkdir("files/peliculas/poster/", 0777);
                if(!is_dir("files/peliculas/trailer/"))//trailer
                mkdir("files/peliculas/trailer/", 0777);
                if(!is_dir("files/peliculas/sub/"))//sub
                mkdir("files/peliculas/sub/", 0777);  
                if(!is_dir("files/peliculas/baner/"))//baner
                mkdir("files/peliculas/baner/", 0777); 
                if ($file && move_uploaded_file($_FILES['mp4_pelicula_']['tmp_name'][0],"files/peliculas/mp4/".$file) && $file_poster && move_uploaded_file($_FILES['poster_pelicula_']['tmp_name'][0],"files/peliculas/poster/".$file_poster) && $file_trailer && move_uploaded_file($_FILES['trailer_pelicula_']['tmp_name'][0],"files/peliculas/trailer/".$file_trailer) && $file_sub && move_uploaded_file($_FILES['sub_pelicula_']['tmp_name'][0],"files/peliculas/sub/".$file_sub) && $file_baner && move_uploaded_file($_FILES['baner_pelicula_']['tmp_name'][0],"files/peliculas/baner/".$file_baner)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            //cuando no envian sub tutilo
            if (isset($_FILES['baner_pelicula_']['name'][0]) && isset($_FILES['mp4_pelicula_']['name'][0]) &&  isset($_FILES['poster_pelicula_']['name'][0]) &&  isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['sub_pelicula_']['name'][0])) { //si son 4 ARCHIVOS ABRA 
                
                //cuando todos los ipunt file mandan archivos
                
                if($_REQUEST['id_pelicula_crud']=="autogenerado"){
                        $nombre_archivo=generateRandomString();
                        $file = $nombre_archivo.".".obtenerExtensionFichero($_FILES['mp4_pelicula_']['name'][0]);//nuevo nombre para el archivo;    
                        
                        //par el poster
                        $nombre_archivo_poster=generateRandomString();
                        $file_poster = $nombre_archivo_poster.".".obtenerExtensionFichero($_FILES['poster_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el trailer
                        $nombre_archivo_trailer=generateRandomString();
                        $file_trailer = $nombre_archivo_trailer.".".obtenerExtensionFichero($_FILES['trailer_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el baner
                        $nombre_archivo_baner=generateRandomString();
                        $file_baner = $nombre_archivo_baner.".".obtenerExtensionFichero($_FILES['baner_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                      
                }else{  
                  $file = $_REQUEST['id_archivo_temp'];//cuando se modificar se chanca el archivo 
                  $file_poster = $_REQUEST['id_archivo_temp_poster'];
                  $file_trailer = $_REQUEST['id_archivo_temp_trailer'];
                  $file_baner = $_REQUEST['id_archivo_temp_baner'];
                }    
                $file_sub="";               
                if(!is_dir("files/peliculas/mp4/"))//mp4
                mkdir("files/peliculas/mp4/", 0777);                
                if(!is_dir("files/peliculas/poster/"))//poster
                mkdir("files/peliculas/poster/", 0777);
                if(!is_dir("files/peliculas/trailer/"))//trailer
                mkdir("files/peliculas/trailer/", 0777);   
                if(!is_dir("files/peliculas/baner/"))//trailer
                mkdir("files/peliculas/baner/", 0777);  
                
                if ($file && move_uploaded_file($_FILES['mp4_pelicula_']['tmp_name'][0],"files/peliculas/mp4/".$file) && $file_poster && move_uploaded_file($_FILES['poster_pelicula_']['tmp_name'][0],"files/peliculas/poster/".$file_poster) && $file_trailer && move_uploaded_file($_FILES['trailer_pelicula_']['tmp_name'][0],"files/peliculas/trailer/".$file_trailer) && $file_baner && move_uploaded_file($_FILES['baner_pelicula_']['tmp_name'][0],"files/peliculas/baner/".$file_baner) )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            
                //cuando no envian baner
            if (isset($_FILES['sub_pelicula_']['name'][0]) && isset($_FILES['mp4_pelicula_']['name'][0]) &&  isset($_FILES['poster_pelicula_']['name'][0]) &&  isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['baner_pelicula_']['name'][0])) { //si son 4 ARCHIVOS ABRA 
                
                //cuando todos los ipunt file mandan archivos
                
                if($_REQUEST['id_pelicula_crud']=="autogenerado"){
                        $nombre_archivo=generateRandomString();
                        $file = $nombre_archivo.".".obtenerExtensionFichero($_FILES['mp4_pelicula_']['name'][0]);//nuevo nombre para el archivo;    
                        
                        //par el poster
                        $nombre_archivo_poster=generateRandomString();
                        $file_poster = $nombre_archivo_poster.".".obtenerExtensionFichero($_FILES['poster_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el trailer
                        $nombre_archivo_trailer=generateRandomString();
                        $file_trailer = $nombre_archivo_trailer.".".obtenerExtensionFichero($_FILES['trailer_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el baner
                        $nombre_archivo_sub=generateRandomString();
                        $file_sub = $nombre_archivo_sub.".".obtenerExtensionFichero($_FILES['sub_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                      
                }else{  
                  $file = $_REQUEST['id_archivo_temp'];//cuando se modificar se chanca el archivo 
                  $file_poster = $_REQUEST['id_archivo_temp_poster'];
                  $file_trailer = $_REQUEST['id_archivo_temp_trailer'];
                  $file_sub = $_REQUEST['id_archivo_temp_sub'];
                }    
                $file_baner="";               
                if(!is_dir("files/peliculas/mp4/"))//mp4
                mkdir("files/peliculas/mp4/", 0777);                
                if(!is_dir("files/peliculas/poster/"))//poster
                mkdir("files/peliculas/poster/", 0777);
                if(!is_dir("files/peliculas/trailer/"))//trailer
                mkdir("files/peliculas/trailer/", 0777);   
                if(!is_dir("files/peliculas/sub/"))//trailer
                mkdir("files/peliculas/sub/", 0777);  
                
                if ($file && move_uploaded_file($_FILES['mp4_pelicula_']['tmp_name'][0],"files/peliculas/mp4/".$file) && $file_poster && move_uploaded_file($_FILES['poster_pelicula_']['tmp_name'][0],"files/peliculas/poster/".$file_poster) && $file_trailer && move_uploaded_file($_FILES['trailer_pelicula_']['tmp_name'][0],"files/peliculas/trailer/".$file_trailer) && $file_sub && move_uploaded_file($_FILES['sub_pelicula_']['tmp_name'][0],"files/peliculas/sub/".$file_sub) )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            
            
            
            
                  //cuando no envian baner y sub q no sonj requeridos
            if ( isset($_FILES['mp4_pelicula_']['name'][0]) &&  isset($_FILES['poster_pelicula_']['name'][0]) &&  isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['baner_pelicula_']['name'][0])  && !isset($_FILES['sub_pelicula_']['name'][0]) ) { //si son 4 ARCHIVOS ABRA 
                
                //cuando todos los ipunt file mandan archivos
                
                if($_REQUEST['id_pelicula_crud']=="autogenerado"){
                        $nombre_archivo=generateRandomString();
                        $file = $nombre_archivo.".".obtenerExtensionFichero($_FILES['mp4_pelicula_']['name'][0]);//nuevo nombre para el archivo;    
                        
                        //par el poster
                        $nombre_archivo_poster=generateRandomString();
                        $file_poster = $nombre_archivo_poster.".".obtenerExtensionFichero($_FILES['poster_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                         //par el trailer
                        $nombre_archivo_trailer=generateRandomString();
                        $file_trailer = $nombre_archivo_trailer.".".obtenerExtensionFichero($_FILES['trailer_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                        
                    
                      
                }else{  
                  $file = $_REQUEST['id_archivo_temp'];//cuando se modificar se chanca el archivo 
                  $file_poster = $_REQUEST['id_archivo_temp_poster'];
                  $file_trailer = $_REQUEST['id_archivo_temp_trailer'];              
                }    
                $file_baner=""; 
                $file_sub=""; 
                if(!is_dir("files/peliculas/mp4/"))//mp4
                mkdir("files/peliculas/mp4/", 0777);                
                if(!is_dir("files/peliculas/poster/"))//poster
                mkdir("files/peliculas/poster/", 0777);
                if(!is_dir("files/peliculas/trailer/"))//trailer
                mkdir("files/peliculas/trailer/", 0777);  
                
                if ($file && move_uploaded_file($_FILES['mp4_pelicula_']['tmp_name'][0],"files/peliculas/mp4/".$file) && $file_poster && move_uploaded_file($_FILES['poster_pelicula_']['tmp_name'][0],"files/peliculas/poster/".$file_poster) && $file_trailer && move_uploaded_file($_FILES['trailer_pelicula_']['tmp_name'][0],"files/peliculas/trailer/".$file_trailer)  )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            
            
            
            
            
            //cuado solo se modifica el file pelicla mp4            
            if (isset($_FILES['mp4_pelicula_']['name'][0]) &&  (!isset($_FILES['poster_pelicula_']['name'][0]) &&  !isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['sub_pelicula_']['name'][0])) ) { //si son 4 ARCHIVOS ABRA 
                  //echo "entra aqui?";          
              //  $file_exte_antiguo = obtenerExtensionFichero($_REQUEST['id_archivo_temp']);//nuevo nombre para el archivo;   
                          
                $file = $_REQUEST['id_archivo_temp'];//cuando se modificar se chanca el archivo  hay qestraer la extension
                $file_poster = $_REQUEST['upload_poster'];
                $file_trailer = $_REQUEST['upload_trailer'];
                $file_sub = $_REQUEST['upload_sub'];
                $file_baner = $_REQUEST['upload_baner'];        
                if(!is_dir("files/peliculas/mp4/"))//mp4
                mkdir("files/peliculas/mp4/", 0777);               
                               
                if ($file && move_uploaded_file($_FILES['mp4_pelicula_']['tmp_name'][0],"files/peliculas/mp4/".$file)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
              //cuado solo se modifica el file poster      
            if (isset($_FILES['poster_pelicula_']['name'][0]) &&  (!isset($_FILES['mp4_pelicula_']['name'][0]) &&  !isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['sub_pelicula_']['name'][0])) ) { //si son 4 ARCHIVOS ABRA 
                                          
                $file = $_REQUEST['upload'];//cuando se modificar se chanca el archivo 
                $file_poster = $_REQUEST['id_archivo_temp_poster'];
                $file_trailer = $_REQUEST['upload_trailer'];
                $file_sub = $_REQUEST['upload_sub'];
                 $file_baner = $_REQUEST['upload_baner'];        
                if(!is_dir("files/peliculas/poster/"))//poster
                mkdir("files/peliculas/poster/", 0777);             
                               
                if ($file_poster && move_uploaded_file($_FILES['poster_pelicula_']['tmp_name'][0],"files/peliculas/poster/".$file_poster)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
               //cuado solo se modifica el file trailer     
            if (isset($_FILES['trailer_pelicula_']['name'][0]) &&  (!isset($_FILES['mp4_pelicula_']['name'][0]) &&  !isset($_FILES['poster_pelicula_']['name'][0]) &&  !isset($_FILES['sub_pelicula_']['name'][0])) ) { //si son 4 ARCHIVOS ABRA 
                                          
                $file = $_REQUEST['upload'];//cuando se modificar se chanca el archivo 
                $file_poster = $_REQUEST['upload_poster'];
                $file_trailer = $_REQUEST['id_archivo_temp_trailer'];
                $file_sub = $_REQUEST['upload_sub'];
                $file_baner = $_REQUEST['upload_baner'];  
                if(!is_dir("files/peliculas/trailer/"))//trailer
                mkdir("files/peliculas/trailer/", 0777);           
                               
                if ($file_trailer && move_uploaded_file($_FILES['trailer_pelicula_']['tmp_name'][0],"files/peliculas/trailer/".$file_trailer)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            
            //cuado solo se modifica el file sub titulo     
            if (isset($_FILES['sub_pelicula_']['name'][0]) &&  (!isset($_FILES['mp4_pelicula_']['name'][0]) &&  !isset($_FILES['poster_pelicula_']['name'][0]) &&  !isset($_FILES['trailer_pelicula_']['name'][0])) ) { //si son 4 ARCHIVOS ABRA 
                                          
                $file = $_REQUEST['upload'];//cuando se modificar se chanca el archivo 
                $file_poster = $_REQUEST['upload_poster'];
                $file_trailer = $_REQUEST['upload_trailer'];
                $file_sub = $_REQUEST['id_archivo_temp_sub'];
                $file_baner = $_REQUEST['upload_baner'];                
               // echo "aaqui:: ".$file_sub;
                if($file_sub==""){
                   // echo "entra aqui";
                    //par el sub
                        $nombre_archivo_sub=generateRandomString();
                        $file_sub = $nombre_archivo_sub.".".obtenerExtensionFichero($_FILES['sub_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                    
                }      
               // echo "nuevo valor:: ".$file_sub;
                if(!is_dir("files/peliculas/sub/"))//sub
                mkdir("files/peliculas/sub/", 0777);         
                               
                if ($file_sub && move_uploaded_file($_FILES['sub_pelicula_']['tmp_name'][0],"files/peliculas/sub/".$file_sub)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
                //cuado solo se modifica el file baner
            if (isset($_FILES['baner_pelicula_']['name'][0]) && (!isset($_FILES['sub_pelicula_']['name'][0]) && !isset($_FILES['mp4_pelicula_']['name'][0]) &&  !isset($_FILES['poster_pelicula_']['name'][0]) &&  !isset($_FILES['trailer_pelicula_']['name'][0])) ) { //si son 4 ARCHIVOS ABRA 
                                          
                $file = $_REQUEST['upload'];//cuando se modificar se chanca el archivo 
                $file_poster = $_REQUEST['upload_poster'];
                $file_trailer = $_REQUEST['upload_trailer'];
                $file_sub = $_REQUEST['upload_sub'];
                $file_baner = $_REQUEST['id_archivo_temp_baner'];
               // echo "aaqui:: ".$file_sub;
                if($file_baner==""){
                   // echo "entra aqui";
                    //par el sub
                        $nombre_archivo_baner=generateRandomString();
                        $file_baner = $nombre_archivo_baner.".".obtenerExtensionFichero($_FILES['baner_pelicula_']['name'][0]);//nuevo nombre para el archivo;   
                    
                }      
               // echo "nuevo valor:: ".$file_sub;
                if(!is_dir("files/peliculas/baner/"))//sub
                mkdir("files/peliculas/baner/", 0777);         
                               
                if ($file_baner && move_uploaded_file($_FILES['baner_pelicula_']['tmp_name'][0],"files/peliculas/baner/".$file_baner)   )
                {
                 $query = $this->mp->guardar_datos_pelicula($_REQUEST,$file,$file_poster,$file_trailer,$file_sub,$file_baner); 
                }
            }
            
            
            if(!isset($_FILES['mp4_pelicula_']['name'][0]) &&  !isset($_FILES['poster_pelicula_']['name'][0]) &&  !isset($_FILES['trailer_pelicula_']['name'][0]) &&  !isset($_FILES['sub_pelicula_']['name'][0]) &&  !isset($_FILES['baner_pelicula_']['name'][0])){
                $query = $this->mp->guardar_datos_pelicula($_REQUEST,$_REQUEST['upload'],$_REQUEST['upload_poster'],$_REQUEST['upload_trailer'],$_REQUEST['upload_sub'],$_REQUEST['upload_baner']);               
            } 
         // $query = $this->ma->guardar_datos_simpatizante($_REQUEST);
         /* $retornar=($query==true)?"exito":"fallo";
          header('Content-type: application/json');
          echo json_encode($retornar);*/     
 }
public function eliminar_pelicula($id="") {      
        //eliminamos la imagen
          $data_model=array(
                 "tabla"=>"pelicula",
                 "filtro"=>"pelicula_id=".$id."" 
               );  
            $query_ = $this->ma->getRegisterRow($data_model);          
           $file = "files/peliculas/mp4/" . $query_->archivo_pelicula;
           $do = unlink($file);
           
           $file_poster = "files/peliculas/poster/" . $query_->archivo_poster;
           $doo = unlink($file_poster);
           
           $file_trailer = "files/peliculas/trailer/" . $query_->archivo_trailer;
           $dooo = unlink($file_trailer);
           
           $file_sub = "files/peliculas/sub/" . $query_->archivo_sub_titulo_forzado;
           $doooo = unlink($file_sub);
           
           
           $file_baner = "files/peliculas/baner/" . $query_->archivo_baner;
           $doooo = unlink($file_baner);
            if($do == true && $doo == true && $dooo == true && $dooo == true){
                //eliminamos  sus generos
                    $data_model=array(
                        "tabla"=>"pelicula_genero",
                        "id_name"=>"pelicula_id",
                        "id"=>$id
                      );
                    $query = $this->ma->deleteRegisterFisico($data_model);
                //
                //eliminamos  sus actores
                    $data_model=array(
                        "tabla"=>"pelicula_actor",
                        "id_name"=>"pelicula_id",
                        "id"=>$id
                      );
                    $query = $this->ma->deleteRegisterFisico($data_model);
                //
                     $data_model=array(
                        "tabla"=>"pelicula",
                        "id_name"=>"pelicula_id",
                        "id"=>$id
                      );
                    $query = $this->ma->deleteRegisterFisico($data_model);
                    if($query==true){
                       /* $retornar=($query==true)?"exito":"fallo";
                    header('Content-type: application/json');
                    echo json_encode($retornar);/*/
                    }                  
             }  
 }
//FIN CODIGO PARA DIRECTORES 
 
 
 
 }
/*
*end modules/login/controllers/index.php
*/
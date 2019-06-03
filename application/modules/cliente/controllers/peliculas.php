<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Peliculas extends MX_Controller
{
 
 public function __construct()
 {
 
 parent::__construct();
 $this->load->model('administracion/model_all','ma'); 
 //$this->load->model('index_model');
 
 }
 

  public function index() {
     
    //  if($this->session->userdata('logged')==TRUE){       
          $datos['contenido']    ='cliente/peliculas';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='CARLNET PLAY'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/datasource','assets/administracion/js_configuracion');

          $this->load->view('includes_cliente/template',$datos);
     /*  }else{

         redirect(base_url('login/autenteficacion'), 'refresh');
       }  */ 
 }
  public function film($id="") {
     
       
       $data_model=array(
          "tabla"=>"v_peli",
          "filtro"=>"pelicula_id=".$id."" 
        );  
      $query = $this->ma->getRegisterRow($data_model);
      if($query){
           //recuperamos sus generos
           $data_model=array(
                "tabla"=>"v_generos",
                "filtro"=>"pelicula_id=".$id."" 
              );  
            $query_generos = $this->ma->getRegisterResult($data_model);
            $generos=array();
            if($query_generos){
              foreach ($query_generos as $row) {
                $generos[]=array(
                'peliculaID'=>$row->pelicula_id,
                'generoID'=>$row->genero_id,
                'generoNombre'=>$row->nombre
              );
              }
            }
            //recuperamos sus actores
           $data_model=array(
                "tabla"=>"v_actores",
                "filtro"=>"pelicula_id=".$id."" 
              );  
            $query_actores = $this->ma->getRegisterResult($data_model);
            $actores=array();
            if($query_actores){
              foreach ($query_actores as $row) {
                $actores[]=array(
                'peliculaID'=>$row->pelicula_id,
                'actorID'=>$row->actor_id,
                'actor_nombres'=>$row->nombres, 
                'actor_apellidos'=>$row->apellidos, 
                'actor_foto'=>"img/actores/".$row->archivo_foto, 
              );
              }
            }
                      
          
       
      $datos["id_pelicula_crud"]=$query->pelicula_id;
       $datos["titulo_p"]      =$query->titulo;             
        $datos["dsc_p"]      =$query->description;
        $datos["year_p"]      =$query->lanzamiento_anio;
        $datos["upload"]      ="files/peliculas/mp4/".$query->archivo_pelicula;
        $datos["id_archivo_temp"]      =$query->archivo_pelicula;
          
        $datos["upload_poster"]      ="files/peliculas/poster/".$query->archivo_poster;
        $datos["id_archivo_temp_poster"]     =$query->archivo_poster;
              
          
         $datos["upload_trailer"]    ="files/peliculas/trailer/".$query->archivo_trailer;
         $datos["id_archivo_temp_trailer"]     =$query->archivo_trailer;
          
          $datos["upload_sub"]    =$query->archivo_sub_titulo_forzado;
         $datos["id_archivo_temp_sub"]     =$query->archivo_sub_titulo_forzado;
         $datos["generos"]       =$generos;
         $datos["actores"]       =$actores;
             // "director"=>$query->director_id,
         //$datos["director_pelicula_h"]    =$query->director_id;
         $datos["director"]=$query->director_nombres." ".$query->director_apellidos;
         $datos["director_foto"]="img/directores/".$query->director_foto;
          
      }
    
      
    //  if($this->session->userdata('logged')==TRUE){       
          $datos['contenido']    ='cliente/film';         
          $datos['app_url']      =base_url();
          $datos['titulo']       ='CARLNET PLAY'; 
          $datos['JS_PROPIO_VIEW']    =array('assets/administracion/datasource','assets/administracion/js_configuracion');

          $this->load->view('includes_cliente/template',$datos);
     /*  }else{

         redirect(base_url('login/autenteficacion'), 'refresh');
       }  */ 
 }
 
 
}
/*
*end modules/login/controllers/index.php
*/
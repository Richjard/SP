<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_peliculas extends CI_Model{

	public function __construct(){
		parent::__construct();
                $this->load->model('administracion/model_all','ma'); 
	}
       
        public function guardar_datos_pelicula($data = array(),$file,$file_poster,$file_trailer,$file_sub,$file_baner){
            echo "mp4 :".$file;
                $titulo_pelicula=$this->db->escape($data['titulo_pelicula']);
                $dsc_pelicula=$this->db->escape($data['dsc_pelicula']);
                $year_pelicula=$data['year_pelicula'];
                $file=$this->db->escape($file);	
                $file_poster=$this->db->escape($file_poster);
                $file_trailer=$this->db->escape($file_trailer);
                $file_sub=$this->db->escape($file_sub);
                $file_baner=$this->db->escape($file_baner);
                $Director=$data['Director'];
                $id_pelicula_crud=$data["id_pelicula_crud"];
                if ($id_pelicula_crud=='autogenerado'){ //nuevo registro
                    $sql_persona="insert pelicula (titulo, description,lanzamiento_anio,archivo_pelicula,archivo_poster,archivo_trailer,archivo_sub_titulo_forzado,director_id,archivo_baner) values("
                    . "$titulo_pelicula,$dsc_pelicula,$year_pelicula,$file,$file_poster,$file_trailer,$file_sub,$Director,$file_baner)";
                    $this->db->query($sql_persona);
                    $iCodigo=$this->db->insert_id();
                    if($iCodigo){
                        if($data['generos']){
                            foreach ($data['generos'] as $g){
                                $v=$g['valor'];
                                 $sql_persona="insert pelicula_genero (pelicula_id, genero_id) values("
                                . "$iCodigo,$v)";
                                $this->db->query($sql_persona);
                            }                            
                        }
                        if($data['actores']){
                            foreach ($data['actores'] as $a){
                                $v=$a['valor'];
                                 $sql_persona="insert pelicula_actor (pelicula_id, actor_id) values("
                                . "$iCodigo,$v)";
                                $this->db->query($sql_persona);
                            }                            
                        }
                       
                    }
                                       
                }else{                   
                    $sql_persona="Update pelicula set titulo=$titulo_pelicula,description=$dsc_pelicula,lanzamiento_anio=$year_pelicula,archivo_pelicula=$file,archivo_poster=$file_poster,archivo_trailer=$file_trailer,archivo_sub_titulo_forzado=$file_sub,director_id=$Director";
                    $sql_persona.=" where pelicula_id=$id_pelicula_crud";
                    $this->db->query($sql_persona);
                    if($data['generos']){
                         //elminamos sus generos                                
                        $data_model=array(
                            "tabla"=>"pelicula_genero",
                            "id_name"=>"pelicula_id",
                            "id"=>$id_pelicula_crud
                          );
                        $query = $this->ma->deleteRegisterFisico($data_model);
                        if($query){
                            foreach ($data['generos'] as $g){
                                 $v=$g['valor'];  
                                if($query){
                                    $sql_persona="insert pelicula_genero (pelicula_id, genero_id) values("
                                    ."$id_pelicula_crud,$v)";
                                    $this->db->query($sql_persona);                                     
                                }
                                //ffiin                                
                            }
                        }        
                                                        
                    }
                    if($data['actores']){
                        $data_model=array(
                            "tabla"=>"pelicula_actor",
                            "id_name"=>"pelicula_id",
                            "id"=>$id_pelicula_crud
                          );
                        $query = $this->ma->deleteRegisterFisico($data_model);
                        if($query){
                            foreach ($data['actores'] as $g){
                                 $v=$g['valor'];
                                //eliminamos sus generos    
                                    $sql_persona="insert pelicula_actor (pelicula_id, actor_id) values("
                                    ."$id_pelicula_crud,$v)";
                                    $this->db->query($sql_persona); 
                                //ffiin
                                
                            }   
                        }
                                                     
                    }
                }                
        }
         
        
        
        
        

        public function deleteRegisterFisico($data = array()){
	    $tabla=str_replace("'","" ,$this->db->escape($data['tabla']));
	    $id_name=str_replace("'","" ,$this->db->escape($data['id_name']));	
	    $id=$data['id'];				
	    $sql="delete from $tabla  where $id_name=$id ";		
	    $consulta=$this->db->simple_query($sql);				
            return $consulta;	
	}
}
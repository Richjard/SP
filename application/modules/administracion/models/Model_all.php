<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_all extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
        public function getTotal($data = array()){
		$tabla=str_replace("'","" ,$this->db->escape($data['tabla']));
		$filtro= (isset($data['filtro']))? " and ".trim($data['filtro']) :"";               
		$sql="select * from $tabla  ";
		//1->arreglo, 2->simple, 3->fila
                $query = $this->db->query($sql);
		$retornar=$query->num_rows();
		return $retornar;
	}
        public function getRegisterRow($data = array()){
		$tabla=str_replace("'","" ,$this->db->escape($data['tabla']));		               
		$filtro= (isset($data['filtro']))? " WHERE ".trim($data['filtro']) :"";               
                $sql="select * from $tabla $filtro  "; 
                $query = $this->db->query($sql); 
                if ($query )
                {
                     $retornar=$query->row();  
                     return $retornar;
                }
                else
                {
                        echo "Query failed!";
                }
	}
	public function getRegisterResult($data = array()){
		$tabla=str_replace("'","" ,$this->db->escape($data['tabla']));
		$order= (isset($data['order']))? " ORDER BY  ".trim($data['order']) :"";
                $limit= (isset($data['skip']))? " LIMIT ".$data['skip']." ,".$data['top'] :"";
		$filtro= (isset($data['filtro']))? " WHERE ".trim($data['filtro']) :"";               
                $sql="select * from $tabla $filtro  $order   $limit "; 
                $query = $this->db->query($sql); 
                if ($query )
                {
                     $retornar=$query->result();  
                     $query->free_result();
                     return $retornar;
                }
                else
                {
                        echo "Query failed!";
                }
	}
        public function guardar_datos_actor($data = array(),$file){
                $nombre_actor=$this->db->escape($data['nombre_actor']);
                $apellidos_actor=$this->db->escape($data['apellidos_actor']);		 
                $file=$this->db->escape($file);		 
                $id_simpatizante_crud=$data["id_actor_crud"];
                if ($id_simpatizante_crud=='autogenerado'){ //nuevo registro
                    $sql_persona="insert director (nombres, apellidos,archivo_foto) values("
                    . "$nombre_actor,$apellidos_actor,$file)";
                    $this->db->query($sql_persona);
                    $iCodigoPersonaGenerado=$this->db->insert_id();
                    echo "codigo generado:: ".$iCodigoPersonaGenerado;                     
                }else{                   
                    $sql_persona="Update director set nombres=$nombre_actor,apellidos=$apellidos_actor,archivo_foto=$file";
                    $sql_persona.=" where director_id=$id_simpatizante_crud";
                    $this->db->query($sql_persona);
                }                
        }
         public function guardar_datos_actor_($data = array(),$file){
                $nombre_actor=$this->db->escape($data['nombre_actor']);
                $apellidos_actor=$this->db->escape($data['apellidos_actor']);		 
                $file=$this->db->escape($file);		 
                $id_crud=$data["id_actor_crud"];
                if ($id_crud=='autogenerado'){ //nuevo registro
                    $sql_persona="insert actor (nombres, apellidos,archivo_foto) values("
                    . "$nombre_actor,$apellidos_actor,$file)";
                    $this->db->query($sql_persona);
                    $iCodigoPersonaGenerado=$this->db->insert_id();
                    echo "codigo generado:: ".$iCodigoPersonaGenerado;                     
                }else{                   
                    $sql_persona="Update actor set nombres=$nombre_actor,apellidos=$apellidos_actor,archivo_foto=$file";
                    $sql_persona.=" where actor_id=$id_crud";
                    $this->db->query($sql_persona);
                }                
        }
        public function guardar_datos_genero_($data = array()){
                $nombre_genero=$this->db->escape($data['nombre_genero']);              	 
                $id_crud=$data["id_genero_crud"];
                if ($id_crud=='autogenerado'){ //nuevo registro
                    $sql_persona="insert genero (nombre) values("
                    . "$nombre_genero)";
                    $this->db->query($sql_persona);
                    $iCodigoPersonaGenerado=$this->db->insert_id();
                    echo "codigo generado:: ".$iCodigoPersonaGenerado;                     
                }else{                   
                    $sql_persona="Update genero set nombre=$nombre_genero";
                    $sql_persona.=" where genero_id=$id_crud";
                    $this->db->query($sql_persona);
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
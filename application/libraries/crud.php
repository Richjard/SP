<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Crud 
{
    private $tabla;
    private $filtro;
  
   
  public function __construct($params = array())
  {
      $this->CI =& get_instance();
      $this->tabla=str_replace("'","" ,$this->CI->db->escape($params['tabla']));
      $this->filtro= (isset($params['filtro']))? " WHERE ".trim($params['$filtro']) :""; 
      
      /*$order= (isset($data['order']))? " ORDER BY  ".trim($data['order']) :"";
                $limit= (isset($data['skip']))? " LIMIT ".$data['skip']." ,".$data['top'] :"";*/
		
      /*$this->tabla=$params['tabla'];
      $this->filtro=$params['$filtro'];*/
     
  }
  
  public function getRegisterResult(){
        $sql="select * from $this->tabla $this->filtro  "; 
        $query = $this->CI->db->query($sql); 
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
   public function getRegisterRow(){
       echo "tabla :: crud :".$this->tabla;
        $sql="select * from $this->tabla $this->filtro  "; 
        $query = $this->CI->db->query($sql); 
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
  
   public function insert($data = array()){   
                    $campos=$data['campos'];
                    $values=$data['values'];
                    $tabla=$data['tabla'];
                    $sql_persona="insert $tabla ($campos) values("
                    . "$values)";
                    $query = $this->CI->db->query($sql_persona);
                    if($query){
                      //  return $this->CI->db->insert_id();
                       // echo "aaa";
                        return true;
                    }else{
                        return false;
                    }                                   
                          
    }
        
  private function getDatabaseConsul(){
       /* $registros= $this->CI->db->get_where("cliente", array('idNRO_TARJETA' => $this->num_tarjeta));       
        if( $check->num_rows() == 0 ) {
            return false;
        }
        $Q = $check->row();
        $check->free_result();*/
        
        $sql="select * from $this->tabla $this->filtro  "; 
        $query = $this->CI->db->query($sql); 
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
  
}

/* End of file Zmpdf.php */
/* Location: ./application/libraries/Zmpdf.php */
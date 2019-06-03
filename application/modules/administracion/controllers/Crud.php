<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

//CRUD VERSION 1 30/09/2018
class Crud 
{
    private $tabla;
    private $filtro;
    private $order;
    private $select_campos;
    private $campos;
    private $values;
    private $limit;
    private $campos_values_update;
  
   
  public function __construct($params = array())
  {
      $this->CI =& get_instance();
      $this->tabla=str_replace("'","" ,$this->CI->db->escape($params['tabla']));
      $this->filtro = (isset($params['filtro']))? " WHERE (EliminadoSis=0 OR EliminadoSis is null) AND   ".trim($params['filtro']) :"WHERE (EliminadoSis=0 OR EliminadoSis is null) "; 
      $this->select_campos=(isset($params['select_campos']))? trim($params['select_campos']) :"*"; 
      $this->campos_values_update= (isset($params['campos_values_update']))? " SET ".trim($params['campos_values_update']) :""; 
      $this->campos=(isset($params['campos']))? trim($params['campos']) :""; 
      $this->values=(isset($params['values']))? trim($params['values']) :""; 
     /* $order= (isset($data['order']))? " ORDER BY  ".trim($data['order']) :"";*/
      $this->limit= (isset($params['skip']))? " LIMIT ".$params['skip']." ,".$params['top'] :"";
      $this->order= (isset($params['order']))? " ORDER BY  ".trim($params['order']) :"";
		
      /*$this->tabla=$params['tabla'];
      $this->filtro=$params['$filtro'];*/
     
  }
  public function getTotal(){	
                $sql="select * from   $this->tabla $this->filtro ";         
                $query = $this->CI->db->query($sql); 
                if ($query )
                {                  
                     $retornar=$query->num_rows($sql);	      	    
                     return $retornar;
                }
                else
                {
                        echo "Query failed!";
                }
        
	}
   public function getRegisterResult(){
      
        $sql="select $this->select_campos from   $this->tabla $this->filtro $this->order $this->limit  "; 
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
        $sql="select $this->select_campos from $this->tabla $this->filtro  "; 
        $query = $this->CI->db->query($sql); 
        //print_r($sql);
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
  
   public function insert(){  //modificado el 01/01 
                    /*$campos=$data['campos'];*/
                   /* $values=$data['values'];
                    $tabla=$data['tabla'];*/
                    $sql_insert="insert $this->tabla ($this->campos) values("
                    ."$this->values)";                    
                    $query = $this->CI->db->query($sql_insert);
                    if($query){
                        return $this->CI->db->insert_id();                  
                    }else{
                        return false;
                    }                                   
                          
    }
    public function update($data = array()){   
                    $sql_update="Update $this->tabla  $this->campos_values_update";
                    $sql_update.= $this->filtro;                    
                    $query = $this->CI->db->query($sql_update);
                    if($query){
                        //return $this->CI->db->insert_id();
                       // echo "aaa";
                       // return true;
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
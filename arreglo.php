<?php
	 header("Content-Type: text/html;charset=UTF-8");
   $mysqli = new mysqli("localhost", "busca3_patrimonio", "b6882a8@", "busca3_patrimonio");
   $mysqli->set_charset("utf8");
   $result = $mysqli->query("SELECT * FROM oficina");
   
   foreach ($result as $res => $data) {

   echo $data['idoficina'].'<br>';
   	
   	# code...
   }

    
 

// verificando .. data ;
?>
<?php
require APPPATH .'vendor/autoload.php';
              # 4 generadores
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorSVG;
 $generador = new BarcodeGeneratorPNG();
            # Ajustes
            
            $tipo = $generador::TYPE_CODE_128;

            // $datos['imagen']=$imagen;


?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div id="wrapper">

<!--<p style="text-align:center; font-weight:bold; padding-top:5mm;">INVOICE</p>-->
<br />

	<?php


  
	
           //  print_r($estrenos);
      $total= count($bienes);
       if($bienes){
           $i=1;
           $b=1;
           $bb=4;

           $t=1;
           $tt=1;
           $ttt=20;
           $txrt="";
           $txrt2="";

           $itablas=1;
           foreach ($bienes as $es) {
           	if($t==1 or $t==$tt){
           		echo '<table class="heading" width="100%"  >';
           		
           		 $txrt='abrir tabla';
           		$tt=$t+20;
           		$itablas++;

           	}else{
           		$txrt="";
           	}

            if($i==1 or $i==$b){
            	echo '<tr>';
            	$b=$i+4;
            }


          	 $texto = $es->codigo_interno;
              $imagen = $generador->getBarcode($texto, $tipo);
          
                    $base64 = chunk_split(base64_encode($imagen));
        

 
               ?>
                <td width="25%" valign="top"  height="200px" > 

                	<table class="table" width="100%"  height="100%" style="">
			
						<tr><td class="td">
							<table width="100%">
									
								<tr>
									<td><img style="height: 30px;" src="<?=base_url('img/logo.png')?>"></td><td style="text-align:center;">UNIVERSIDAD JOSÉ CARLOS MARIÁTEGUI</td>
								</tr>
							</table>

							


						</td></tr>
					<tr><td class="td">
						<table width="100%">
									
								<tr>
									<td rowspan="2" style="text-align: center;"><?=$es->idformato_registro_bien?></td><td ><?php echo "<img src=\"data:image/gif;base64,$base64\" />";?></td>
									
								</tr>
								<tr>
									
									<td style="text-align:center;"><?=$es->codigo_interno?></td>
								</tr>
							</table>



					</td></tr>
					<tr><td class="td">

				     	<table width="100%">
									
								<tr>
									<td  style="font-size:8px;"><?=$es->descripcion?></td><td  style="text-align: right;"><?=$es->idanio?></td>
									
								</tr>
								
							</table>


					 </td></tr>
				    </table>
					<!--i :<?=$i?><br />
					b :<?=$b?> <br />
					t :<?=$t?><br />
					tt :<?=$tt?> <br />
					ttt :<?=$ttt?> <br />
					<b>ABC Cor p ::  <?=$txrt?></b>
				
					ce ::.<?=$txrt2?>-->
					<!--<br /><br />-->
			    </td>	   
                <?php  
                if($i==4 or $i==$bb){
	            	echo '</tr>';
	            	$bb=$i+4;
	            }   

	            if($t==20 or $t==$ttt){
	            	echo '</table>';
	            	 $txrt2='cerrar tabla';
	            	$ttt=$t+20;
	            }else{
	            	 $txrt2="";
	            }


	             $i++; 
	             $t++;    
	            // $ic++;  
               }
              $rt=($tt-1)-$total;

                $j=1;
              if($rt<>0){

               
              for($j=1;$j<=$rt;$j++){


		            if($i==1 or $i==$b){
		            	echo '<tr>';
		            	$b=$i+4;
		            }
                 ?>
	                <td width="25%" valign="top" class="td">
						
				    </td>	   
                <?php  
	                if($i==4 or $i==$bb){
		            	echo '</tr>';
		            	$bb=$i+4;
		            }  

		             if($t==20 or $t==$ttt){
	            		 echo '</table>';
		            	 $txrt2='cerrar tabla';
		            	 $ttt=$t+20;
		            }else{
		            	 $txrt2="";
		            }
		             $i++; 
	                 $t++;   

              } 

           }

             
            //  echo "<h4>".$rt."  i::".$i."   total:::".$total."</h4>";
           }
       
       
       ?>


	

<!--<table style="width:100%; height:35mm;">
<tr>
<td style="width:65%;" valign="top">
Payment Information :<br />
Please make cheque payments payable to : <br />
<b>ABC Corp</b>
<br /><br />
The Invoice is payable within 7 days of issue.<br /><br />
</td>
<td>
<div id="box">
E &amp; O.E.<br />
For ABC Corp<br /><br /><br /><br />
Authorised Signatory
</div>
</td>
</tr>
</table>-->







<!--<td rowspan="2" valign="top" align="right" style="padding:3mm;">
						<h1 class="heading">ABC Corp</h1>
						<h2 class="heading">
						123 Happy Street<br />
						CoolCity - Pincode<br />
						Region , Country<br />

						Website : www.website.com<br />
						E-mail : info@website.com<br />
						Phone : +1 - 123456789
						</h2>
				</td>

				<td rowspan="2" valign="top" align="right" style="padding:3mm;">
						<h1 class="heading">ABC Corp</h1>
						<h2 class="heading">
						123 Happy Street<br />
						CoolCity - Pincode<br />
						Region , Country<br />

						Website : www.website.com<br />
						E-mail : info@website.com<br />
						Phone : +1 - 123456789
						</h2>
				</td>-->



</div>


<h3 align="center">PAPELETA DE DESPLAZAMIENTO  EXTERNOS E INTERNO DE BIENES DE LA UJCM N° <?=zero_fill($des->iddesplazamiento_bien,7)?></h3>
<table class="cabezera_"> 
        <tr>
            <td class="titulo" width="10%">ENTIDAD:</td> 
            <td colspan="3"  colspan="3">UNIVERSIDAD JOSÉ CARLOS MARIATEGUI</td> 
            <td class="titulo"  width="10%">Fecha</td> 
            <td ><?=$des->fecha?></td>
            <td class="titulo"  width="10%">Motivo</td> 
            <td ><?=$des->motivo?></td>
        </tr>
        <tr>
            <td class="titulo" width="10%">Fines de</td> 
            <td colspan="3" colspan="3"><?=$des->fines?></td> 
            <td class="titulo"  width="10%">Refer</td> 
            <td  colspan="3"><?=$des->referencia?></td>
        </tr>
        <tr>
            <td class="titulo" width="10%" rowspan="2">Origen</td>
            <td class="titulo" width="20%">Local</td>
            <td  colspan="2"><?=$des->local_origen?></td>
            <td class="titulo" width="20%">Area</td>
            <td  colspan="3"><?=$des->area_origen?></td>
          
        </tr> 
        <tr>
            <td class="titulo" width="10%" >Oficina</td>
            <td width="20%" colspan="2"><?=$des->oficina_origen?></td>
            <td class="titulo" width="10%">Empleado:</td>
            <td width="20%" colspan="3"><?=$des->empleado_origen?></td>
          
        </tr>
        
        <tr>
            <td class="titulo" width="10%" rowspan="2">Destino</td>
            <td class="titulo" width="20%">Local</td>
            <td  colspan="2"><?=$des->local_destino?></td>
            <td class="titulo" width="20%">Area</td>
            <td colspan="3"><?=$des->area_destino?></td>
          
        </tr> 
        <tr>
            <td class="titulo" width="10%" >Oficina</td>
            <td width="20%" colspan="2"><?=$des->oficina_destino?></td>
            <td class="titulo" >Empleado:</td>
            <td width="20%" colspan="3"><?=$des->empleado_destino?></td>
          
        </tr>
    </table >
    
    <table class="list">
                    <thead>
                        <tr >
                            <th>N°</th> 
                            <th>Código</th>  
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>                            
                            <th>Color</th>                      
                            <th>Estado</th>
                        </tr>

                    </thead>
                     <tbody>
                    <?php
  $i=1;
                    if($result){
                      
                        foreach ($result as $reg){

                            ?>
                    <tr >
                        <td ><?=$i?></td>
                       <td ><?=$reg->codigo_interno?></td>
                       <td ><?=$reg->descripcion?></td>
                       <td ><?=$reg->dt_marca?></td>
                        <td ><?=$reg->dt_modelo?></td>
                       <td ><?=$reg->dt_serie?></td>                      
                       <td ><?=$reg->dt_color?></td>
                        <td ><?=$reg->estado?></td>
                    </tr>
                    <?php
                    $i++;
                        }
                    }else{
                        echo "<tr ><td colspan='9'>No hay datos</td></tr>";
                    }
                ?>


                    </tbody>
                </table>
     <table class="list">
                    <tbody>
                        <tr >
                            <td><b>Estado : Nuevo (N), Bueno (B), Regular (R), Malo (M)</b>
                            </td> 
                            <td width="20%">Total de Bienes :<b> <?=$i-1?></b>
                            </td>                 
                        </tr>
                            <tr >
                                <td colspan="2">                   El trabajador es responsable Directo de la Existencia, permanencia, conservación y buen uso de cada uno de los
                                        bienes descritos por lo que se recomienda tomar las providencias del caso para evitar pérdida, sustracción, deterioro, etc. cualquier movimiento
                                        del bien dentro o fuera de la entidad deberá ser comunicado al encargado de Control Patrimonial, bajo responsabilidad.
                                </td> 
                            </tr>
                    </tbody>
     </table>
    
    <br>
    <br>
    
    <table class="table_sin_borde">
                    <tbody>
                        <tr >
                            <td align="center">__________________________</td> 
                            <td align="center">__________________________</td> 
                            <td align="center">__________________________</td> 
                            <td align="center">__________________________</td> 
                                            
                        </tr>
                        <tr >
                            <td width="20%" align="center">Firma del Transferente </td> 
                            <td width="20%" align="center">Firna del Receptor </td> 
                            <td width="20%" align="center">Vº Bº  </td> 
                            <td width="20%" align="center">Vº Bº</td> 
                        </tr>
                        <tr >
                            <td width="20%" align="center"><?=$des->empleado_origen?></td> 
                            <td width="20%" align="center"><?=$des->empleado_destino?></td> 
                            <td width="20%" align="center">Funcionario que autoriza </td> 
                            <td width="20%" align="center">Control Patrimonial</td> 
                        </tr>
                    </tbody>
     </table>

<?php
if($oficinas){
    foreach ($oficinas as $of){
        ?>
    <table class="cabezera_"> 
        <tr>
            <td class="titulo" width="10%">ENTIDAD:</td> 
            <td colspan="3" width="60%">UNIVERSIDAD JOSÉ CARLOS MARIATEGUI</td> 
            <td class="titulo"  width="10%">Bines :</td> 
            <td width="20%">Depreciables</td>
        </tr>
        <tr>
            <td class="titulo" width="10%">Local:</td>
            <td width="20%"><?=$of["local"]?></td>
            <td class="titulo" width="10%">Area:</td>
            <td width="20%"><?=$of["area"]?></td>
            <td class="titulo" width="10%">Oficina:</td>
            <td width="30%"><?=$of["descripcion"]?></td>
        </tr> 
    </table >
 
                <table class="list">
                    <thead>
                        <tr >
                            <th>N°</th> 
                            <th>Código</th> 
                            <th>Fecha Adquisición</th> 
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Serie</th>
                            <th>Modelo</th>
                            <th>Color</th>
                            <th>Cuenta</th>
                            <th>Estado</th>
                        </tr>

                    </thead>
                     <tbody>
                    <?php

                    if($of["bienes"]){
                        $i=1;
                        foreach ($of["bienes"] as $reg){

                            ?>
                    <tr >
                        <td ><?=$i?></td>
                       <td ><?=$reg->codigo_interno?></td>
                       <td ><?=$reg->fecha_adquisicion?></td>
                       <td ><?=$reg->descripcion?></td>
                       <td ><?=$reg->dt_marca?></td>
                       <td ><?=$reg->dt_serie?></td>
                       <td ><?=$reg->dt_modelo?></td>
                       <td ><?=$reg->dt_color?></td>
                       <td ><?=$reg->codigo_cuenta?></td>
                        <td ><?=$reg->estado_bien?></td>
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


        <?php
    }
}
?>

   




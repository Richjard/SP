<main role="main" class="container">
   <input type="hidden" id="base_url" value="<?=base_url()?>">   
    
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
        <a class="navbar-brand" href="#">BANCO XYZ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav mr-auto">
          
            <li class="nav-item">
              <a class="nav-link disabled" href="#">BIENVENIDO (<?=$this->session->userdata('Usuario')?>)</a>
            </li>
            
          </ul>
          <form class="form-inline my-2 my-md-0">
              <div class="btn-group" role="group" aria-label="Basic example">
            <a  class="btn btn-primary"  href="<?php echo base_url('cajero/interfaz'); ?>">CANCELAR</a>
            <a  class="btn btn-danger"  href="<?php echo base_url('login/login_conten/salir'); ?>">RETIRAR TARJETA</a
              </div>
          </form>
        </div>
      </nav>
    
    

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0"><?=$operacion." :  ".$tipo_cuenta." ( ".$nro_cuenta." )"?> </h6>
        
         <form class="form-signin" action="<?= base_url('cajero/transacciones/transaccion/'.$op)?>" method="post">
    <?php
    if($op==1 OR $op== 2) {
                    
                ?>
                
                 <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-money-check-alt"></i> <?=$operacion?> </h1>
    
    
                <div class="row">

                   <div class="col ">
                       
               
                           <input type="hidden"  class="inputs form-control " value="<?=$cuenta?>" name="cuenta" id="cuenta">
                         <label for="monto" >Monto</label>
                        <input type="text"  maxlength="4" id="monto" class=" form-control "  name="monto" required autofocus>
                        

                   
                   </div>
                </div>
               <br>
                 <input type="submit" class="btn btn-lg btn-primary btn-block enviar" name="enviar" value="enviar" >
        
                <?php
    }else{
        ?>
               
               <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-money-check-alt"></i> <?=$operacion?></h1>  
    
                <div class="row">

                   <div class="col ">
                         <input type="hidden"  class="inputs form-control " value="<?=$cuenta?>" name="cuenta" id="cuenta">
                        
                         <input type="hidden"  class="inputs form-control " id="id_usuario2"  name="id_usuario2">
                   
                        <label for="cuentaDestino" >Cuenta destino</label>
                        <input type="text" id="cuentaDestino" name="cuentaDestino" class="form-control" required value="43021971070">
                        <div id="msg" ></div>
                        <label for="monto" >Monto</label>
                        <input type="text"  maxlength="4" id="monto" class=" form-control "  name="monto" required autofocus>
                        
      
                   </div>
                </div>
               <br> 
                <input type="submit" class="btn btn-lg btn-primary btn-block enviar" name="enviar" value="enviar" disabled>
        
               <?php
    }
    
    ?>   
   
    
              
         </form>
       
        <!--<small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>-->
      </div>

      
    </main>

   <script >
        $(document).on("blur","#cuentaDestino",function(){
            var Myval = $("#cuentaDestino").val();
            var Myval_cuenta = $("#cuenta").val();

            console.log(Myval+" : "+Myval_cuenta);

           base_url=$("#base_url").val();
           
          console.log("base url:: "+base_url);
           $.ajax({
             url: base_url+'cajero/cuenta/consulta_cuenta/'+Myval,
             success: function(respuesta) {
                 console.log(respuesta.data);
                 if(respuesta.data.length != 0){                
                     if(respuesta.data.NRO_CUENTA == Myval_cuenta){
                           $("#msg").html('<div class="alert alert-danger" role="alert">'
                           +' No puedes transferir a la misma cuenta'
                            +'</div>');
                          $(".enviar").attr('disabled','disabled');
                     }else{                                                  
                          $("#msg").html('<div class="alert alert-success" role="alert">'
                           +respuesta.data.NOMBRES+' '+respuesta.data.APELLIDOS+'('+respuesta.data.DSC+')' 
                            +'</div>');
                    $("#id_usuario2").val(respuesta.data.idUSUARIO_BANCO);
                     $('.enviar').removeAttr("disabled");
                     }
                    
                     
                 }else{
                    // console.log("no");
                     $("#msg").html('<div class="alert alert-danger" role="alert">'
                           +' No existe la cuenta que ingreso'
                            +'</div>');
                    $(".enviar").attr('disabled','disabled');
                 }
                ;


             },
             error: function() {
               console.log("No se ha podido obtener la información");
             }
           });


        });
      </script >
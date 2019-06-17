<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login APP PATRIMONIO</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
            <?php
        echo '<!-- CSS -->';     
        if(CSS) {
         foreach(CSS as $global_css) {

            echo "\n".'<link type="text/css" rel="stylesheet" href="'.base_url($global_css.'.css').'" />';
           }
         }
        ?>    
          <script type="text/javascript">
             /*if (/MSIE d|Trident.*rv:/.test(navigator.userAgent)) {
                 document.write("<script src='https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.5/bluebird.min.js'><\/script>");
             }*/
          </script>          
       <?php
       echo '<!-- JS PRINCIPALES-->';    
       if(JS_HEADER) {
        foreach(JS_HEADER as $global_js) {   
            echo "\n".'<script type="text/javascript" language="javascript" src="'.base_url($global_js.'.js').'"></script>';
          }
        }
        ?>  
         <?php
        echo '<!-- CSS -->';     
        if($CSS) {
         foreach($CSS as $c) {

            echo "\n".'<link type="text/css" rel="stylesheet" href="'.base_url($c.'.css').'" />';
           }
         }

       
      
        ?> 

<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
  <input type="hidden" id="base_url" value="<?=base_url()?>">
  <div id="toast_"></div>
  <div class="limiter">
    <div class="container-login100">
                    
      <div class="wrap-login100">
        <div class="login100-more" style="background-image: url('<?=base_url("img/bg-01.jpg")?>')">
        </div>     
        <form class="login100-form validate-form" id="form_login" >
                                    <i class="fas fa-building  fa-lg "> SP Sistema Patromio</i>
                                     <br>
                                      <br>
          <span class="login100-form-title p-b-43">
            Iniciar sesión
          </span>
                                    <br>
          
           <div class="row "> 
                                            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4 label_form">
                                                 <label>Usuario<label>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8 validar">                 
                                                    <div  class="e-input-in-wrap">
                                                        <input type="text" id="usuario" name="usuario" >                               
                                                    </div> 
                                                    <div class="error"></div>
                                            </div>                                               
                                        </div>
                                       <div class="row "> 
                                            <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4 label_form">
                                                 <label>Contraseña<label>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8 validar">                 
                                                    <div  class="e-input-in-wrap">
                                                        <input type="password" id="pass" name="pass" >                               
                                                    </div> 
                                                   <div class="error"></div> 
                                            </div>                                               
                                        </div>
                                    <br>
                                    <div class="container-login100-form-btn">
             <span  id="ingresar"></span>
          </div>
        </form>
      </div>
    </div>
        </div>
    <script>      
       var base_url = document.getElementById("base_url").value;
           progressButton = new ej.splitbuttons.ProgressButton({
                content: 'Iniciar sesión',duration:1, enableProgress: true, animationSettings: { effect: 'SlideRight' },
                spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
            });
            progressButton.appendTo('#ingresar');

             document.getElementById('ingresar').onclick = function () { 
               console.log("probando login");
             }

            //ValidarDatos(usuario,contraseña)
            var options = {
                /*customPlacement: function (inputElement, errorElement) {
                    inputElement = inputElement.closest('.validar').querySelector('.error');
                    inputElement.parentElement.appendChild(errorElement);
                },*/
                rules: {
                    'usuario': {
                        required: [true, 'Por favor Ingrese su usuario']
                    },
                    'pass': {
                        required: [true, 'Por favor Ingrese su contraseña']
                    }                        
                }
            };
           var form_login = new ej.inputs.FormValidator('#form_login', options);

           var toastObj = new ej.notifications.Toast({
              title: 'Error!', 
              content:  'Usuario o contraseña invalido.', 
              cssClass: 'e-toast-danger',
               icon: 'e-danger toast-icons',
             /* title: 'Matt sent you a friend request',
              content: 'You have a friend request yet to accept.',
              icon: 'e-laura',*/
              target: document.getElementById('form_login'),
              position: { X: 'Right', Y: 'Top' },
            /*  close: onclose,
              beforeOpen: onBeforeOpen*/
           });

            var toasts = [               
                { title: 'Éxito!', content: 'Iniciando sesion...', cssClass: 'e-toast-success', icon: 'e-success toast-icons' },
              
                { title: 'Error!', content:  'Usuario o contraseña invalido.', cssClass: 'e-toast-danger', icon: 'e-danger toast-icons' },
            ]; 
       
           toastObj.appendTo('#toast_');
         
           document.getElementById('ingresar').onclick = function () { 
            if (form_login.validate()) { 

               var data = new FormData();
              //Form data
              var form_data = $('#form_login').serializeArray();
              $.each(form_data, function (key, input) {
                  data.append(input.name, input.value);
              });            
              //Custom data            
              $.ajax({
                 type: 'post',
                 url: base_url+"login/login/validate",
                 processData: false,
                 contentType: false,
                 data: data,
                 beforeSend: function() {
                 },
                 success: function(json) {  
                     if(json=="yes")
                      {     
                         toastObj.show(toasts[0]); 
                         location.reload();         
                      }
                      else
                      {
                          
                           toastObj.show(toasts[1]);
                      }
                 },
                 error: function(resp) {
                     alert(resp);
                 }
              });  
            }
          }
        </script>
            
  
  

  
<?php
  echo '<!-- CSS -->';     
        if($JS_PROPIO_VIEW) {
         foreach($JS_PROPIO_VIEW as $j) {

           echo "\n".'<script type="text/javascript" language="javascript" src="'.base_url($j.'.js').'"></script>';
           }
         }
         ?>
</body>
</html>
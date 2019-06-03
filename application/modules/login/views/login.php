<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Login APP PATRIMONIO</title>
	
	
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="http://busca3.com/patrimonio/assets/theme.css" type="text/css">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        
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
    

<!--===============================================================================================-->
</head>
        <nav class="navbar navbar-light">
    <div class="container d-flex justify-content-center"> <a class="navbar-brand text-primary" href="#">
        <b> SISTEMA DE PATRIMONIO - UNIVERSIDAD JOSE CARLOS MARIATEGUI</b>
      </a> </div>
  </nav>
  <div class="py-5" style="background-image: url('https://static.pingendo.com/cover-stripes.svg'); background-position:left center; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="p-5 col-lg-6">
          <h1>SISPATRI 2.0</h1>
          <p class="mb-3">Bienvenido</p>
          <form action="<?= base_url('login/login/validate')?>" method="post">
            <div class="form-group"> <input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario"> </div>
            <div class="form-group"> <input type="password" class="form-control" placeholder="Password" id="pass" name="pass"> <small class="form-text text-muted text-right">
                <a href="#"> -- </a>
              </small> </div> <button class="btn btn-primary" id="sliderightoutline"></button>
          </form>
        </div>
        <div class="col-md-6"><img class="img-fluid d-block my-5" src="http://busca3.com/patrimonio/assets/logo_control_patrimonial.png" style=""></div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0">2018 SisPatri. Todos los Derechos Reservados.</p>
        </div>
      </div>
    </div>
  </div>
        
    <script>
           progressButton = new ej.splitbuttons.ProgressButton({
                content: 'Iniciar sesión', enableProgress: true, animationSettings: { effect: 'SlideRight' },
                spinSettings: { position: 'Center' }, cssClass: 'e-outline e-primary'
            });
            progressButton.appendTo('#sliderightoutline');
        </script>
            
	  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	

	


</body>
</html>
<main role="main" class="container">
      
    
    
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
           
            <a  class="btn btn-danger"  href="<?php echo base_url('login/login_conten/salir'); ?>">RETIRAR TARJETA</a>
          </form>
        </div>
      </nav>
    
    

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0"><?=$operacion.""?> </h6>
        
         <form class="form-signin" action="<?= base_url('cajero/cuenta/transaccion/'.$op)?>" method="post">
       
    <h1 class="h1 mb-3 font-weight-normal"> <?=$msg?> </h1>
    
    
      <div class="row">
                 
         <div class="col ">
             
         </div>
      </div>
     <br>
      <a class="btn btn-lg btn-danger btn-block" href="<?php echo base_url('login/login_conten/salir'); ?>">RETIRAR TARJETA</a>
      <a class="btn btn-lg btn-primary btn-block"  href="<?php echo base_url('cajero/interfaz'); ?>" >REALIZAR OTRA OPERACIÓN</a>
         </form>
       
        <!--<small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>-->
      </div>

      
    </main>
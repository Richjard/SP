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
        <h6 class="border-bottom border-gray pb-2 mb-0">SELECCIONE QUE OPERACION DESEA REALIZAR</h6>
        <div class="media text-muted pt-3">
            <!--<img data-src="holder.js/32x32?theme=thumb&amp;bg=007bff&amp;fg=007bff&amp;size=1" alt="32x32" class="mr-2 rounded" style="width: 32px; height: 32px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1662c1c87f4%20text%20%7B%20fill%3A%23007bff%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1662c1c87f4%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23007bff%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
          -->
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <a  class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('cajero/cuenta/ver_cuentas/1'); ?>">Sacar Dinero</a>
            </p>
        </div>
        <div class="media text-muted pt-3">
           <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('cajero/cuenta/ver_cuentas/2'); ?>">Ingresar Dinero</a>
            </p>
        </div>
        <div class="media text-muted pt-3">
          <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
              <a  class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('cajero/cuenta/ver_cuentas/3'); ?>">Transferir Dinero</a>
            </p>
        </div>
        <!--<small class="d-block text-right mt-3">
          <a href="#">All updates</a>
        </small>-->
      </div>

      
    </main>
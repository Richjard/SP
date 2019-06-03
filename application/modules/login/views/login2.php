   <!--  <form class="form-signin">
      <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>-->
    
    <?php 
        
        
        
      //$new_user_login = new User("0105","0801");
        
        
       //echo $new_user_login->set_pin(); // Devuelve Rojo
        //$login = new Login("55");
       // $login->pin = '555';
       // echo "probando ob ".$login->pin;
       // echo "probando ob ".$login->get_pin();
      //  $login->set_pit(10000);
      //  echo "probando ob ".$login->get_pin();
         $numeros_ = aleatoriosNoRepetidos();
        
       
        //echo aleatoriosNoRepetidos(5);
        ?> 
   
   <form class="form-signin" action="<?= base_url('login/login_conten/validate')?>" method="post">
       
    <h1 class="h3 mb-3 font-weight-normal"><i class="fas fa-credit-card"></i> Ingrese su tarjeta</h1>
    
    
      <div class="row">
                 
         <div class="col ">
             <div class="input-group">
                    <input type="text"  maxlength="4" class="inputs form-control " placeholder="0000" name="num_1" value="9999">

                    <input type="text"  maxlength="4"   class="inputs form-control " placeholder="0000" name="num_2" value="9999">

                    <input type="text"  maxlength="4"   class="inputs form-control " placeholder="0000" name="num_3" value="9999">


                    <input type="text"  maxlength="4"  class="inputs form-control " placeholder="0000" name="num_4">
             </div>
         </div>
      </div>
      <br>
      <div class="row">
        <div class="col" id="bola_1">
     	   <i class="far fa-circle fa-2x"></i>
        </div>
        <div class="col" id="bola_2">
     	 <i class="far fa-circle fa-2x"></i>
        </div>
        <div class="col" id="bola_3">
     	 <i class="far fa-circle fa-2x"></i>
        </div>
        <div class="col" id="bola_4">
     	<i class="far fa-circle fa-2x"></i>
        </div>
         <div class="col" id="bola_5">
     	<i class="far fa-circle fa-2x"></i>
        </div>
         <div class="col" id="bola_6">
     	<i class="far fa-circle fa-2x"></i>
        </div>
          <input type="hidden" id="_pass" name="pin">
     </div>
     <div class="btn-toolbar " role="toolbar" aria-label="Toolbar with button groups" >
       <?php 
       for($i=0;$i<5;$i++){
           ?>
           <div class="btn-group mr-2  " role="group" aria-label="Second group">
            <button type="button" class="btn btn-secondary btn_pin"><?php echo $numeros_[$i];?></button>
          </div>
           <?php 
       }
       ?>
          
          
          <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-secondary btn-clear"><i class="fas fa-backspace "></i></button>
          </div>
      
     </div>
      <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <?php 
           for($i=5;$i<10;$i++){
               ?>
               <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button type="button" class="btn btn-secondary btn_pin"><?php echo $numeros_[$i];?></button>
              </div>
               <?php 
           }
           ?>
          <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-secondary btn_clear_all"><i class="fas fa-eraser fa-lg"></i></button>
          </div>
      
     </div>
     <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

    </form>
    
    <script>
        
    var pin="";
  $(".inputs").keyup(function () {
     if (this.value.length == this.maxLength) {
      $(this).next('.inputs').focus();
    }
});

    $('.btn_pin').click(function(e) {  
        
         pin_t=pin.length;
         if(pin_t<=5){
            pin=pin+$(this).text(); 
       
        switch(pin_t) {
            case 0:
                $("#bola_1").html('<i class="fas fa-circle fa-2x"></i>');
                break;
            case 1:
               $("#bola_2").html('<i class="fas fa-circle fa-2x"></i>');
                break;
            case 2:
                $("#bola_3").html('<i class="fas fa-circle fa-2x"></i>');
                break;
            case 3:
               $("#bola_4").html('<i class="fas fa-circle fa-2x"></i>');
                break;
            case 4:
               $("#bola_5").html('<i class="fas fa-circle fa-2x"></i>');
                break;
           case 5:
               $("#bola_6").html('<i class="fas fa-circle fa-2x"></i>'); 
                $(".btn_pin").attr('disabled','disabled');   
                $("#_pass").val(pin);
                break;
           /* default:
                code block*/
        }
        }
         
        console.log(pin+ " "+"   total de caracttes " + pin_t);
    });
    $('.btn_clear_all').click(function(e) {  
      pin="";
      for(i=1;i<=6;i++){
          $("#bola_"+i+"").html('<i class="far fa-circle fa-2x"></i>');
      }  
       $(".btn_pin").removeAttr('disabled'); 
    
    });
    $('.btn-clear').click(function(e) { 
    var nuevo_pin_t=pin.length;
    
    
    console.log("total let: "+nuevo_pin_t);
    switch(nuevo_pin_t) {
            case 1:
                $("#bola_1").html('<i class="far fa-circle fa-2x"></i>');
                pin = pin.substring(0,0);
                
                break;
            case 2:
               $("#bola_2").html('<i class="far fa-circle fa-2x"></i>');
                pin = pin.substring(0,1);
                break;
            case 3:
                $("#bola_3").html('<i class="far fa-circle fa-2x"></i>');
                pin = pin.substring(0,2);
                break;
            case 4:
               $("#bola_4").html('<i class="far fa-circle fa-2x"></i>');
                 pin = pin.substring(0,3);
                break;
            case 5:
               $("#bola_5").html('<i class="far fa-circle fa-2x"></i>');
                pin = pin.substring(0,4);
                break;
           case 6:
               $("#bola_6").html('<i class="far fa-circle fa-2x"></i>');
                pin = pin.substring(0,5);
                $(".btn_pin").removeAttr('disabled'); 
                $("#_pass").val("");
                break;
           /* default:
                code block*/
        }
          
        });
    </script>
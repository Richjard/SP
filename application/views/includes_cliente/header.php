<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
      
    <title><?=$titulo?></title>
       <?php
        echo '<!-- CSS -->';     
        if(CSS_CLIENTE) {
         foreach(CSS_CLIENTE as $global_css) {

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
       if(JS_HEADER_CLIENTE) {
        foreach(JS_HEADER_CLIENTE as $global_js) {   
            echo "\n".'<script type="text/javascript" language="javascript" src="'.base_url($global_js.'.js').'"></script>';
          }
        }
        ?>  
          
    
        
   </head>
<body>
    
  <?php 
      echo $this->load->view('includes_cliente/headerBody');
  ?>   
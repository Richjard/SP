<!DOCTYPE html><html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">   
    <title><?=$titulo?></title>
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
          
        <style>
            body{
                touch-action:none;
            }
        </style>
   </head>
<body>
    
  <?php 
      echo $this->load->view('includes/headerBody');
  ?>   
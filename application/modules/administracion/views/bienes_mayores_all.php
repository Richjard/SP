<div class="row bien_form">
            
    <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
        
    </div>
    <div class="col-xs-8 col-sm-8 col-lg-8 col-md-8">
        <div class="row bien_form">
            
            <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                <div class="row bien_form">
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                         <label>Grupo<label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">
                          
                                <input type="text" id="grupo_bien" name="grupo_bien" >
                               
                           
                      
                    </div>
                </div>    
               
                
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                <div class="row bien_form">
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                         <label>Clase<label>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                 
                            
                                <input type="text" id="clase_bien" name="clase_bien" >                               
                           
                    </div>
                </div>    
               
                
            </div>
 </div>  
    </div>
</div>    
    
 
<div id="grid_bien_mayor"></div>
  <div id="toast_type"> </div>
  <div id="confirmDialogObj_bien_mayor"></div>
   <div id="ajaxDlgWrapper" class="content-wrapper">        
        <div id="dialogObj_bien_mayor"></div>
    </div>
  


<style>
    .material button#sendButton,
    button#sendButton {
        top: 4px;
        position: relative;
    }
    .e-bigger.material button#sendButton {
        right: 7px;
    }
    .bootstrap button#sendbtn {
        margin-right: 1%;
    }
    .material .e-dialog .e-dlg-header-content,
    .e-dialog .e-dlg-header-content {
        background-color: #3f51b5;
    }
    .fabric .e-dialog .e-dlg-header-content {
        background-color: #0078d7;
    }
    .bootstrap .e-dialog .e-dlg-header-content {
        background-color: #428bca;
    }
    .highcontrast .e-dialog .e-dlg-header-content {
        background-color: #ffd939;
    }
    .material.e-bigger .e-dialog .e-footer-content {
        padding-left: 23px;
    }
    #template button#sendButton.e-rtl {
        margin-left: 20px;
    }
    #template.e-rtl .e-dlg-closeicon-btn {
        left: 0;
    }
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn {
        top: 5px;
        left: -11px;
    }
    .e-bigger .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn {
        top: 3px;
        left: -11px;
    }
    .e-dialog .e-dlg-header {
        position: relative;
    }
    .e-dialog .e-footer-content, .highcontrast.e-bigger .e-dialog .e-footer-content {
        padding: 15px;
    }
    .e-dialog .e-dlg-content {
        padding: 0;
    }
    .fabric button#sendButton, .highcontrast button#sendButton {
        position: relative;
    }

	.fabric button#sendbtn, .highcontrast button#sendbtn {
		top: -2px;
	}

     .fabric input.e-input,  .highcontrast input.e-input {
        float: left;
        height: 35px;
        width: 70%;
    }
	
	.e-bigger.highcontrast button#sendbtn {
        margin-right: -17px;
		margin-top: -2%;
    }

    .e-dialog .e-dlg-header-content {
        padding: 6px;
    }
    .e-bigger.e-dialog .e-dlg-header-content, .e-bigger .e-dialog .e-dlg-header-content {
        padding: 8px;
    }
    .e-open-icon::before {
        content: '\e782';
    }
    #dlg-template {
        display: inline-block;
        padding: 0px 10px;
        vertical-align: middle;
        height: 40px;
        line-height: 40px;
    }
    input.e-input {
        width: 75%;
        float: left;
    }
    .e-bigger.bootstrap input.e-input {
        height: 39px;
    }
    .e-icon-settings.e-icons {
		float: left;
		position: relative;
		left: 14%;
		top: -33px;
    }

    .fabric .e-icon-settings.e-icons, .highcontrast .e-icon-settings.e-icons {
		top: -37px;
    }

    .e-bigger.fabric .e-icon-settings.e-icons, .e-bigger.highcontrast .e-icon-settings.e-icons {
		top: -35px;
    }
    .dialogContent .dialogText {
        font-size: 13px;
        padding: 5%;
        word-wrap: break-word;
        border-radius: 6px;
        text-align: justify;
        font-style: initial;
		display: block;
	}
    .e-dlg-header .e-icon-settings, .e-icon-btn {
        color: #fff;
    }
    
    .dialogContent .dialogText, .dialogContent .dialogText  {
        background-color: #f5f5f5;
    }

    .material .e-dialog .e-footer-content, .fabric .e-dialog .e-footer-content,
    .e-dialog .e-footer-content {
        border-top: 0.5px solid rgba(0, 0, 0, 0.42);
    }
    .highcontrast .e-dialog .e-footer-content, .fabric .e-dialog .e-footer-content {
        padding: 20px 25px;
    }

    .highcontrast .e-dialog .e-footer-content {
        border-top: 0.5px solid #fff;
    }
	.highcontrast .dialogContent .dialogText { 
	    background-color: #bfbfbf;
	}
    .dialogContent {
        display: block;
        font-size: 15px;
        word-wrap: break-word;
        text-align: center;
        font-style: italic;
        border-radius: 6px;
        padding: 3%;
        position: relative;
        top: 25px;
    }
    .e-bigger.e-dialog .e-dlg-content, .e-bigger .e-dialog .e-dlg-content {
        padding: 0;
    }
    .e-bigger .e-dialog .dialogContent {
        top: 20px;
    }
    .bootstrap .dialogContent {
        top: 7px;
    }
    .control-wrapper .e-control.e-dialog {
        width: 30%;
    }
    .e-dialog .e-dlg-header-content .e-icon-dlg-close {
      color: #fff;
    }
    .fabric .e-dialog .e-btn.e-dlg-closeicon-btn:hover span{
      color: #8ECBFF;
    }
    .material .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:hover,
    .material .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:focus,
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:hover,
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:focus {
        background-color: rgba(255,255,255, 0.10);
    }
    .material .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:active .e-icon-dlg-close ,
    .material .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:focus .e-icon-dlg-close,
    .material .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:hover .e-icon-dlg-close,
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:active .e-icon-dlg-close ,
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:focus .e-icon-dlg-close,
    .e-dialog .e-dlg-header-content .e-btn.e-dlg-closeicon-btn:hover .e-icon-dlg-close {
        color: #fff;
    }
    .e-dialog .e-dlg-header-content .e-dlg-header .e-avatar.template-image {
        background-image: url(src/dialog/images/1.png);
        vertical-align: middle;
        display: inline-block;
        width: 36px;
        height: 36px;
    }
</style>
       <form id="form_area" class="form-horizontal">
         <div class="col-lg-12 control-section">
          <div class="content-wrapper">
              <br>
            <input type="hidden" id="id_area_crud" value="autogenerado" name="id_area_crud"  >   
          
            
              <div class="row bien_form">            
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                       <div class="row  form-group">
                             <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                 <label>Local<label>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                          
                              <input type="text" id="local_combo_in_area" name="local_combo_in_area" data-required-message="*Local es requerido"  required=""  >
                              <input type="hidden" id="idlocal"  name="idlocal"  >

                            </div>
                            <div class="error"></div>
                         </div>    
                    </div>
              </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="nombre_area" name="nombre_area" data-required-message="*Nombre de Area es requerido"  required="" data-msg-containerid="Error" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="ruc">AREA</label>
                    </div>
                    <div id="Error"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="abre_area" name="abre_area" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="direccion">ABREVIATURA</label>
                    </div>
                    
                </div>
          </div>
         </div> 
        </form>


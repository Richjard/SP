       <form id="form_oficina" class="form-horizontal">
         <div class="col-lg-12 control-section">
          <div class="content-wrapper">
              <br>
            <input type="hidden" id="id_oficina_crud" value="autogenerado" name="id_oficina_crud"  >   
          
            
              <div class="row bien_form">            
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                       <div class="row  form-group">
                             <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                 <label>Local<label>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                          
                              <input type="text" id="local_combo_in_area" name="local_combo_in_area" data-required-message="*Local es requerido"  required=""  >
                              <input type="hidden" id="idlocal_in_of"  name="idlocal_in_of"  >

                            </div>
                            <div class="error"></div>
                         </div>    
                    </div>
              </div>
              <div class="row bien_form">            
                    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                       <div class="row  form-group">
                             <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                 <label>Area<label>
                            </div>
                            <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                          
                              <input type="text" id="area_combo_in_oficina" name="area_combo_in_oficina" data-required-message="*Area es requerido"  required=""  >
                              <input type="hidden" id="idarea_in_of"  name="idarea_in_of"  >

                            </div>
                            <div class="error"></div>
                         </div>    
                    </div>
              </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="nombre_oficina" name="nombre_oficina" data-required-message="*Nombre de Oficina es requerido"  required="" data-msg-containerid="Error" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="ruc">OFICINA</label>
                    </div>
                    <div id="Error"></div>
                </div>                
          </div>
         </div> 
        </form>


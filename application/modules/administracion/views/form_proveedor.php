


       <form id="form_proveedor" class="form-horizontal">
         <div class="col-lg-12 control-section">
          <div class="content-wrapper">
            <input type="hidden" id="id_proveedor_crud" value="autogenerado" name="id_proveedor_crud"  >   
                   <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="ruc" name="ruc" data-required-message="*RUC es requerido" maxlength="12" required="" data-msg-containerid="ruc_gError" onkeyup="search_document();">
                      
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="ruc">RUC</label>

                    </div>
                    <!-- <button class="e-control e-btn e-primary" onclick="search_document();"> Buscar RUC </button>-->
                    
                    <div id="ruc_gError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="razon_social" name="razon_social" data-required-message="*RAZON SOCIAL es requerido" required="" data-msg-containerid="razon_social_gError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="razon_social">RAZON SOCIAL</label>
                    </div>
                    <div id="razon_social_gError"></div>
                </div>
             
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="direccion" name="direccion" data-required-message="*DIRECCION es requerido" required="" data-msg-containerid="direccion_gError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="direccion">DIRECCION</label>
                    </div>
                    <div id="direccion_gError"></div>
                </div>
          </div>
         </div> 
        </form>


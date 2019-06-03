       <form id="form_local" class="form-horizontal">
         <div class="col-lg-12 control-section">
          <div class="content-wrapper">
            <input type="hidden" id="id_local_crud" value="autogenerado" name="id_local_crud"  >   
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="nombre_local" name="nombre_local" data-required-message="*Nombre de local es requerido" required="" data-msg-containerid="Error" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="nombre_local">LOCAL</label>
                    </div>
                    <div id="Error"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="direccion_local" name="direccion_local" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="direccion_local">DIRECCION</label>
                    </div>
                   
                </div>
               
          </div>
         </div> 
        </form>


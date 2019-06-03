       <form id="form_empleado" class="form-horizontal">
         <div class="col-lg-12 control-section">
          <div class="content-wrapper">
            <input type="hidden" id="id_empleado_crud" value="autogenerado" name="id_empleado_crud"  >  
             <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="dni" name="dni" data-required-message="*Nombres es requerido" required="" data-msg-containerid="Error" onkeyup="search_document_dni();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="dni_empleado">DNI</label>
                    </div>
                    <div id="Error"></div>
                </div> 
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="nombre_empleado" name="nombre_empleado" data-required-message="*Nombres es requerido" required="" data-msg-containerid="Error" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="nombre_empleado">NOMBRES</label>
                    </div>
                    <div id="Error"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="apellidos_empleado" name="apellidos_empleado" onkeyup="javascript:this.value=this.value.toUpperCase();"  data-required-message="*Apellidos es requerido" required="" data-msg-containerid="ErrorA" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="apellidos_empleado">APELLIDOS</label>
                    </div>
                   <div id="ErrorA"></div>
                </div>
              <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="condicion_empleado" name="condicion_empleado" onkeyup="javascript:this.value=this.value.toUpperCase();" data-required-message="*Condicion es requerido" required="" data-msg-containerid="ErrorC" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="condicion_empleado">CONDICION</label>
                    </div>
                  <div id="ErrorC"></div>
                   
                </div>
               
          </div>
         </div> 
        </form>


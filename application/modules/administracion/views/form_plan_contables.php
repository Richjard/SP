
<form id="form_plan_contable" class="form-horizontal">                     
    <div class="col-lg-12 control-section">
        <div class="content-wrapper">
            <input type="hidden" id="id_plan_contable_crud" value="autogenerado" name="id_plan_contable_crud"  >                
            <div class="form-group" style="padding-top: 11px;">
                <div class="e-float-input">
                    <input type="text" id="codigo" name="codigo"  data-required-message="*CODIGO es requerido" required="" data-msg-containerid="codigo_gError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    <span class="e-float-line"></span>
                    <label class="e-float-text" for="codigo">CODIGO</label>
                </div>
                <div id="codigo_gError"></div>
            </div>            
            <div class="form-group" style="padding-top: 11px;">
                <div class="e-float-input">
                    <input type="text" id="descripcion" name="descripcion" data-required-message="*DESCRIPCION es requerido" required="" data-msg-containerid="descripcion_gError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                    <span class="e-float-line"></span>
                    <label class="e-float-text" for="descripcion">DESCRIPCION</label>
                </div>
                <div id="descripcion_gError"></div>
            </div> 
        </div>
    </div>
</form>



        <form id="form_grupo" class="form-horizontal">
            <input type="hidden" id="id_grupo_crud" value="autogenerado" name="id_grupo_crud"  >
                
              <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="codigo" name="codigo"  value="CODIGO AUTOGENERADO" data-required-message="*CODIGO es requerido" required="" data-msg-containerid="codigo_gError" onkeyup="javascript:this.value=this.value.toUpperCase();">
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
             
      
                    
                
        
            <br>
            <div class="row">
              
                    <button id="cancelar" class="e-custom-button" type="button">Cancelar</button>
               
              
                    <button id="guardar_grupo" class="e-custom-button" type="button">Guardar</button>
               
            </div>
            </div>
        </form>


<style>
    #city {
    display: block;
}
    .prev {
        float: left;
        margin-left: 50px;
    }

    .next {
        float: right;
    }

    .form-title {
        width: 100%;
        text-align: center;
        padding: 10px;
        font-size: 16px;
        font-weight: 500;
        color: rgba(0, 0, 0, 0.70);
    }

    .e-custom-label {
        font-size: 14px;
        font-weight: 500;
        margin-left: 20px;
        width: 180px;
    }

    .e-custom-button {
        width: 125px;
        height: 45px;
        margin-right: 50px;
    }

    .form-custom {
        margin-bottom: 8px;
        margin-top: 17px;
        margin-left: 20px;
        margin-right: 20px;
    }

    h1 {
        font-size: 25px;
        text-align: center;
        opacity: 0.45;
    }

    h4 {
        font-size: 15px;
        color: #b07676;
        padding-bottom: 11px;
        margin-left: 12px;
        padding-top: 3px;
    }

    #formId {
        background-color: #f9f9f9;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 20px;
        padding-top: 10px;
    }

    /*form {
        padding-top: 20px;
        margin-bottom: 45px;
        border: 1px solid #ccc;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.36);
        border-radius: 5px;
        background: #f9f9f9;
    }*/

    .highcontrast #formId {
        color: #ffffff;
        background: #000000;
    }

    .e-error,
    .e-float-text {
        font-weight: 500;
    }

    table,
    td,
    th {
        padding: 5px;
    }

    .form-horizontal .form-group {
        margin-left: 20px;
        margin-right: 20px;
    }

    /* Tab  */

    /*.tab {
        display: none;
    }
    */
    

    @media only screen and (max-width: 700px) {
        .radio-control {
            margin-left: 35%;
            margin-top: 8%;
        }

        .control-section {
            min-height: 200px;
        }

        .prev {
            float: left;
            margin: 0px 10% -50px 10%;
        }
    }

    
    
    
    
    
    
    .radio-control h4 {
        color: rgba(0, 0, 0, 0.64);
    }

    .e-bigger .radio-control h4 {
        font-size: 20px;
    }

    /* Datepicker Styles */

    /*#wrapper {
        margin: 30px auto;
        padding-top: 30px;
    }
*/
    /* Dropdownlist Styles */

    
    
    
    
    
    
    
    
    .control-wrapper {
        margin: 0 auto;
        width: 80%;
    }

    .e-c-error {
        position: absolute;
        top: 9px;
        right: 0px;
    }

    .e-date-error {
        position: relative;
        top: -35px;
        right: 35px;
        float: right;
    }

    .e-c-error:after {
        background: #333;
        background: rgba(0, 0, 0, .8);
        border-radius: 5px;
        bottom: 26px;
        color: #fff;
        padding: 5px 15px;
        position: absolute;
    }

    @media (max-width: 960px) {
        .control-wrapper {
            margin: 0 auto;
            width: 100%;
        }
    }

    @media only screen and (max-width: 360px) {
        .next {
            margin-left: 158px;
        }
    }
    
    
    
</style>
   

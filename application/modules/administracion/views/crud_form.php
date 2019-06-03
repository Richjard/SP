<!--<div class="col-lg-12 control-section">
    <div class="content-wrapper" style="margin-bottom: 25px">
        <div class="form-title"><span>Account Setup</span></div>-->
        <form id="formId" class="form-horizontal">
            <input type="hidden" id="id_simpatizante_crud" value="autogenerado" name="id_simpatizante_crud"  >
                
          <div class="tab">
                <h4>Datos de Personales</h4>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="dni" id="dni_simpatizante" name="DNI_simpatizante" data-required-message="*DNI es requerido" required="" data-msg-containerid="dniError">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="dni">DNI</label>
                    </div>
                    <div id="dniError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="apellido_paterno" name="apellido_paterno_simpatizante" data-required-message="*Apellido Paterno es requerido" required=""  data-msg-containerid="apellido_paternoError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="apellido_paterno">APELLIDO PATERNO</label>
                    </div>
                    <div id="apellido_paternoError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="apellido_materno" name="apellido_materno_simpatizante" data-required-message="*Apellido Materno es requerido" required="" data-msg-containerid="apellido_maternoError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="apellido_materno">APELLIDO MATERNO</label>
                    </div>
                    <div id="apellido_maternoError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="nombres" name="nombres_simpatizante" data-required-message="*Nombres es requerido" required="" data-msg-containerid="nombresError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="nombres">NOMBRES</label>
                    </div>
                    <div id="nombresError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="fecha_de_nacimiento" name="fecha_de_nacimiento_simpatizante" dateiso="true" data-dateiso-message="Por favor ingrese fecha de nacimiento en este formato format(YYYY-MM-DD)." data-required-message="Required field" data-required-message="*Fecha de nacimiento es rquerido"  data-msg-containerid="fecha_de_nacimientoError">
                        <span class="e-float-line"></span>
                        
                    </div>
                    <div id="fecha_de_nacimientoError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="lugar_nacimiento" name="lugar_nacimiento_simpatizante" data-required-message="*Lugar de nacimiento es requerido"  data-msg-containerid="lugar_nacimientoError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="lugar_nacimiento">LUGAR DE NACIMIENTO</label>
                    </div>
                    <div id="lugar_nacimientoError"></div>
                </div>
                              
                <div class="row">
                    <div class="col-sm-2 e-custom-label">SEXO:</div>
                    <div class="col-sm-12">
                        <div class="form-custom">
                            <div style="float:left ; padding-right:10px">
                                <input id="radio1" type="radio" name="r1">
                            </div>
                            <div class="row">
                                <input id="radio2" type="radio" name="r2">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="estado_civil" name="Estado_civil" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Estado_civil_h"></div>
                    <input type="hidden" id="estado_civil_h" name="Estado_civil_h"  >
                
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="profesion_u_ocupacion" name="profesion_u_ocupacion_simpatizante" data-required-message="*Profesion u Ocupacion es requerido"  data-msg-containerid="profesion_u_ocupacionError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="profesion_u_ocupacion">PROFESION U OCUPACION</label>
                    </div>
                    <div id="profesion_u_ocupacionError"></div>
                </div>
            </div>


           
   <div class="tab">
                <h4>Datos de Contacto</h4>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="mail" data-validation="email" name="Email" data-required-message="*Email es requerido"  data-msg-containerid="mError">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="mail">Email</label>
                    </div>
                    <div id="mError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="tel" id="tele" name="Tel" data-required-message="*Numero de celular es requerido" data-msg-containerid="tError">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="tel">Numero de celular</label>
                    </div>
                    <div id="tError"></div>
                </div>
                 <p class="subtitulo_">Domicilio</p>  
                <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="region_domicilio" name="Region_domicilio" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Region_domicilio_h"></div>
                    <input type="hidden" id="region_domicilio_h" name="Region_domicilio_h"  >
                
                </div>
                 <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="provincia_domicilio" name="Provincia_domicilio" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Provincia_domicilio_h"></div>
                     <input type="hidden" id="provincia_domicilio_h" name="Provincia_domicilio_h"  >
                
                </div>              
                 <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="distrito_domicilio" name="Distrito_domicilio" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Distrito_domicilio_h"></div>
                     <input type="hidden" id="distrito_domicilio_h" name="Distrito_domicilio_h"  >
                
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="city" name="City" data-required-message="*Dirección es requerido"  data-msg-containerid="cityError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="city">Dirección</label>
                    </div>
                    <div id="cityError"></div>
                </div> 
               
            </div>


  
         <div class="tab">
                <h4>Datos de Afiliación</h4>
                
                
                <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="region_afiliacion" name="Region_afiliacion" >
                      
                        
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Region_afiliacion_h"></div>
                    <input type="hidden" id="region_afiliacion_h" name="Region_afiliacion_h" required="" >
                
                </div>               
              
                  <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="provincia_afiliacion" name="Provincia_afiliacion" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Provincia_afiliacion_h"></div>
                    <input type="hidden" id="provincia_afiliacion_h" name="Provincia_afiliacion_h"  >
                
                </div>              
                 <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="distrito_afiliacion" name="Distrito_afiliacion" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Distrito_afiliacion_h"></div>
                    <input type="hidden" id="distrito_afiliacion_h" name="Distrito_afiliacion_h"  >
                
                </div>
                <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="base_afiliacion" name="Base_afiliacion" >
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error" id="Base_afiliacion_h"></div>
                    <input type="hidden" id="base_afiliacion_h" name="Base_afiliacion_h" >
                
                </div>
               
               
                
                  <div class="row">
                    <div class="col-sm-2 e-custom-label">CONDICION:</div>
                    <div class="col-sm-12">
                        <div class="form-custom">
                            <div style="float:left ; padding-right:10px">
                                <input id="radio11" type="radio" name="r11">
                            </div>
                            <div class="row">
                                <input id="radio22" type="radio" name="r22">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
            <div class="row">
                <div class="prev">
                    <button id="prevBtn" class="e-custom-button" type="button">Atras</button>
                </div>
                <div class="next">
                    <button id="nextBtn" class="e-custom-button" type="button">Siguiente</button>
                </div>
            </div>
        </form>
  <!--  </div>
</div>-->



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

    .tab {
        display: none;
    }
    
    

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
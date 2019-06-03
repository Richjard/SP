<form id="form_desplazamiento" class="form-horizontal">
    <input type="hidden" id="id_desplazamiento_de_bien_crud" value="autogenerado" name="id_desplazamiento_de_bien_crud"  > 
     <div class="col-lg-12 control-section">
     <div class="content-wrapper">
   
  
        <fieldset>
        <div class="legend_">[ Datos de desplazamiento ]</div>
        
      
        <div class="row bien_form">
                   <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                         <label>Motivo<label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">   
                 
                            <div  class="e-input-in-wrap fv">
                                <input type="text" id="motivo_desplazamiento_combo" name="motivo_desplazamiento_combo" >
                               <div class="error"></div>
                            </div>
                      <input type="hidden" id="tipo_bien_bien"  name="tipo_bien_bien" value="1" >
                    
                       
                      
                    </div>
          
                    <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                         <label>Año<label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">                   
                            <div  class="e-input-in-wrap fv">
                                <input type="text" id="anio_des" name="anio_des" value="2018"> 
                                 <div class="error"></div>
                            </div>  

                    </div>
          
            
                    
                  <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                         <label>Fecha<label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">                 
                            <div  class="e-input-in-wrap fv">
                                <input type="text" id="fecha_des" name="fecha_des" dateiso="true" data-dateiso-message="Please enter valid dateISO format(YYYY-MM-DD)."
                         data-required-message="Fecha  es requerido" required >   
                                <div class="error"></div>
                            </div>                   
                    </div>
        </div> 
         <div class="row bien_form">
                   <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                         <label>Documento<label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">   
                 
                            <div  class="e-input-in-wrap">
                                <input type="text" id="doc_des" name="doc_des" >
                               
                            </div>
                      <input type="hidden" id="tipo_bien_bien"  name="tipo_bien_bien" value="1" >
                    
                       
                      
                    </div>
                    <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                        <label>Fines de</label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">                   
                            <div  class="e-input-in-wrap">
                                <input type="text" id="finesde_des" name="finesde_des" >                               
                            </div>                   
                    </div>
                  <div class="col-xs-1 col-sm-1 col-lg-1 col-md-1 label_form">
                         <label>Referencia<label>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">                 
                            <div  class="e-input-in-wrap">
                                <input type="text" id="ref_des" name="ref_des" >                               
                            </div>                   
                    </div>
        </div> 
        
        
        
    </fieldset>
       
    <fieldset>
     <div class="legend_">[ Datos de ubiicacion ]</div>
        
      
        <div class="row bien_form">
              <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 ">
                       
                       
                            <style>
                       #Grid_origen {
                           float: left;
                       }

                       #Grid_destino {
                           float: right;
                       }
                   </style>
                   <div class="row">
                       <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                           <div class="row"> 
                                       <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                                           <h5><small>Origen</small></h5>
                                       </div>
                                   </div>   
                                   <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Local<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">  
                                               <div  class="e-input-in-wrap fv">
                                                    <input type="text" id="combo_locales_despl" name="combo_locales_despl" data-required-message="*Local es requerido"  required=""  >
                                                    <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                                    <div class="error"></div>   
                                               </div>
                                         </div>
                                                                               
                                    </div> 
                                    <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Area<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">  
                                            <div  class="e-input-in-wrap fv">
                                                <input type="text" id="combo_areas_despl" name="combo_areas_despl" data-required-message="*Local es requerido"  required=""  >
                                                <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                                <div class="error"></div>   
                                             </div>
                                        </div>
                                                                                   
                                    </div> 
                                    <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Oficina<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">   
                                             <div  class="e-input-in-wrap fv">
                                                  <input type="text" id="combo_oficinas_despl" name="combo_oficinas_despl" data-required-message="*Local es requerido"  required=""  >
                                                  <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                              <div class="error"></div>   
                                             </div>
                                         </div>                                           
                                    </div> 
                                   <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Empleado<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                          
                                          <input type="text" id="combo_empleado_despl" name="combo_empleado_despl" data-required-message="*Local es requerido"  required=""  >
                                          <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                        </div>
                                        <div class="error"></div>                                           
                                    </div>
                                   <br>
                                   <br>
                       </div>
                       
                       
                       <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6">
                           <div class="row"> 
                                       <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                                           <h5><small>Destino</small></h5>
                                       </div>
                                   </div>   
                                   <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Local<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">  
                                             <div  class="e-input-in-wrap fv">
                                                <input type="text" id="combo_locales_despl_des" name="combo_locales_despl_des" data-required-message="*Local es requerido"  required=""  >
                                                <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                                 <div class="error"></div>   
                                              </div>
                                        </div>
                                                                               
                                    </div> 
                                    <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Area<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">   
                                            <div  class="e-input-in-wrap fv">
                                                <input type="text" id="combo_areas_despl_des" name="combo_areas_despl_des" data-required-message="*Local es requerido"  required=""  >
                                                <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                                <div class="error"></div>   
                                            </div>
                                        </div>                                          
                                    </div> 
                                    <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Oficina<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">  
                                             <div  class="e-input-in-wrap fv">
                                                <input type="text" id="combo_oficinas_despl_des" name="combo_oficinas_despl_des" data-required-message="*Local es requerido"  required=""  >
                                                <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                                <div class="error"></div>   
                                             </div>
                                        </div>                                          
                                    </div> 
                                   <div class="row bien_form"> 
                                        <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
                                             <label>Empleado<label>
                                        </div>
                                        <div class="col-xs-9 col-sm-9 col-lg-9 col-md-9">                          
                                          <input type="text" id="combo_empleado_despl_des" name="combo_empleado_despl_des" data-required-message="*Local es requerido"  required=""  >
                                          <input type="hidden" id="idlocal_bien"  name="idlocal_bien"  >
                                        </div>
                                        <div class="error"></div>                                           
                                    </div>
                                   <br>
                                   <br>
                       </div>
                       
                       
                   </div>
                   <div class="control-section">
                       <div class="content-wrapper" >
                           <div style="display: inline-block" id="grilllas">
                              
                           </div>
                       </div>


                   </div>
              </div>
        </div>
</fieldset>
         
         
        </div>
    </div>

            
</form>


<style>
    
    .content-wrapper div.bien_form {
        padding: 0.4px 0px;
    }

    .content-wrapper div.row{
        padding: 0.4px 0px;
    }

    
    
    


    
    
    
</style>
   

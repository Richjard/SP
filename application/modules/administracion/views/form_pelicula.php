<form id="form_pelicula" class="form-horizontal">
            <input type="hidden" id="id_pelicula_crud" value="autogenerado" name="id_pelicula_crud"  >
                
        
                <div class="tab_base">
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="titulo_p" name="titulo_pelicula" data-required-message="*Titulo es requerido" required="" data-msg-containerid="titulo_pError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="titulo_p">TITULO</label>
                    </div>
                    <div id="titulo_pError"></div>
                </div>
               <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input type="text" id="dsc_p" name="dsc_pelicula" data-required-message="*Descripcion es requerido" required="" data-msg-containerid="dsc_pError" >
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="dsc_p">DESCRIPCION</label>
                    </div>
                    <div id="dsc_pError"></div>
                </div>
                <div class="form-group" style="padding-top: 11px;">
                    <div class="e-float-input">
                        <input  type="number" min="2016" max="2020"  id="year_p" name="year_pelicula" data-required-message="*Año de lanzamiento es requerido" required="" data-msg-containerid="year_pError" onkeyup="javascript:this.value=this.value.toUpperCase();">
                        <span class="e-float-line"></span>
                        <label class="e-float-text" for="year_p">AÑO DE LANZAMIENTO</label>
                    </div>
                    <div id="year_pError"></div>
                </div>
                <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="director" name="Director" data-required-message="*Director es Required" required="">
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error"></div>
                    <input type="hidden" id="director_pelicula_h" name="Director_pelicula_h"  >
                </div>
                    
               <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="generos_multi" name="Generos_multi" data-required-message="*Position Required" required="">
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error"></div>
                </div>
                    
                    
                <div class="form-group">
                    <div class="e-float-input" style="margin-bottom: 0px">
                        <input type="text" id="actores_multi" name="Actores_multi" data-required-message="*Position Required" required="">
                        <span class="e-float-line"></span>
                    </div>
                    <div class="error"></div>
                </div>    
                    
                    
             
                
                    
                    
                    
                    
                 
                    
                 <div id="dropArea_mp4">
                 <div class="form-group" style="padding-top: 11px;">
                         <div class="e-float-input upload-area">
                             <input type="text" id="upload" readonly="" name="upload" data-required-message="* Seleccione el video en .mp4" required="" data-msg-containerid="uploadError">
                             <button id="browse" class="e-control e-btn e-info">Browse...</button>                        
                             <span class="e-float-line"></span>
                             <label class="e-float-text e-label-top" for="upload">Seleccionar Archivo de pelicula en .mp4</label>
                         </div>   
                         <div id="uploadError"></div>                     
                         <input type="file" name="mp4_pelicula_" id="mp4_pelicula" >                                        
                 </div>
                 </div>                
                 <input type="hidden" id="id_archivo_temp"  name="id_archivo_temp"  >
                 
                 
              
                 
                 
                 
                 <div id="dropArea_poster">
                 <div class="form-group" style="padding-top: 11px;">
                         <div class="e-float-input upload-area">
                             <input type="text" id="upload_poster" readonly="" name="upload_poster" data-required-message="* Seleccione el poster en jpg o png" required="" data-msg-containerid="uploadPosterError">
                             <button id="browse_poster" class="e-control e-btn e-info">Browse...</button>                        
                             <span class="e-float-line"></span>
                             <label class="e-float-text e-label-top" for="upload_poster">Seleccionar Poster de pelicula imagen jpg o png </label>
                         </div>   
                         <div id="uploadPosterError"></div>                     
                         <input type="file" name="poster_pelicula_" id="poster_pelicula"  >                                        
                 </div>
                 </div>  
                  <input type="hidden" id="id_archivo_temp_poster"  name="id_archivo_temp_poster"  >
                  
                 <div id="dropArea_trailer">
                 <div class="form-group" style="padding-top: 11px;">
                         <div class="e-float-input upload-area">
                             <input type="text" id="upload_trailer" readonly="" name="upload_trailer" data-required-message="* Seleccione el trailer en mp4" required="" data-msg-containerid="uploadTrailerError">
                             <button id="browse_trailer" class="e-control e-btn e-info">Browse...</button>                        
                             <span class="e-float-line"></span>
                             <label class="e-float-text e-label-top" for="upload_trailer">Seleccionar Trailer de pelicula  .mp4 </label>
                         </div>   
                         <div id="uploadTrailerError"></div>                     
                         <input type="file" name="trailer_pelicula_" id="trailer_pelicula"  >                                        
                 </div>
                 </div> 
                 <input type="hidden" id="id_archivo_temp_trailer"  name="id_archivo_temp_trailer"  >
                 
                 <div id="dropArea_sub">
                 <div class="form-group" style="padding-top: 11px;">
                         <div class="e-float-input upload-area">
                             <input type="text" id="upload_sub" readonly="" name="upload_sub" data-required-message="* Seleccione el Sub titulo forzado  en .vtt"  data-msg-containerid="uploadSubError">
                             <button id="browse_sub" class="e-control e-btn e-info">Browse...</button>                        
                             <span class="e-float-line"></span>
                             <label class="e-float-text e-label-top" for="upload_sub">Seleccionar Sub titulo forzado en .vtt </label>
                         </div>   
                         <div id="uploadSubError"></div>                     
                         <input type="file" name="sub_pelicula_" id="sub_pelicula"  >                                        
                 </div>
                 </div> 
                 <input type="hidden" id="id_archivo_temp_sub"  name="id_archivo_temp_sub"  >
                 
                 
                 
                 <div id="dropArea_baner">
                 <div class="form-group" style="padding-top: 11px;">
                         <div class="e-float-input upload-area">
                             <input type="text" id="upload_baner" readonly="" name="upload_baner"  data-msg-containerid="uploadBanerError">
                             <button id="browse_baner" class="e-control e-btn e-info">Browse...</button>                        
                             <span class="e-float-line"></span>
                             <label class="e-float-text e-label-top" for="upload_baner">Seleccionar baner en fortamto jpg </label>
                         </div>   
                         <div id="uploadBanerError"></div>                     
                         <input type="file" name="baner_pelicula_" id="baner_pelicula"  >                                        
                 </div>
                 </div> 
                 <input type="hidden" id="id_archivo_temp_baner"  name="id_archivo_temp_baner"  >
                 
                 <p>si ba modifar los archivos por a hora solo permite modificar todas a la vez o uno en especifico</p>
            <br>
            <div class="row">
              
                    <button id="cancelar" class="e-custom-button" type="button">Cancelar</button>
               
              
                    <button id="guardar_pelicula" class="e-custom-button" type="button">Guardar</button>
               
            </div>
            </div>
        </form>


<style>

    .e-multi-select-wrapper .e-chips>.e-chipcontent {
        max-width: 80%;
        white-space: nowrap;
    }

    .control-section .control-wrapper {
        width: 80%;
        margin: 0 auto;
        min-width: 185px;
    }

    .e-bigger .control-section .control-wrapper {
        width: 100%;
    }
</style>
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
   
<style>
      .control_wrapper {
        max-width: 400px;
        margin: auto;
    }
    .e-upload {
        width: 100%;
        position: relative;
        margin-top: 15px;
    }
    .control_wrapper .e-upload .e-upload-drag-hover {
        margin: 0;
    }
    .address-field {
        resize: none;
    }
    
     #control_wrapper {
		max-width: 500px;
		margin: auto;
		border: 0.5px solid #BEBEBE;
		box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.36);
		padding: 1% 4% 7%;
		background: #f9f9f9;
	}

        .highcontrast #control_wrapper {
            background: #000000;
        }
        .upload-area, .e-bigger .upload-area {
            width: 73%;
        }
        .e-error {
            padding-top:3px;
        }
        .e-upload {
            width: 100%;
            position: relative;
            margin-top: 15px;
        }
        .control_wrapper .e-upload .e-upload-drag-hover {
            margin: 0;
        }
    
        .submit-btn {
            margin-top: 15px;          
        }
        .submitBtn .desc {
			margin: 2% 23% 0% 18%;
        }
        @media only screen and (max-width: 500px) {
            .submitBtn .desc {
                margin: 12px;
            }
            .upload-area, .e-bigger .upload-area {
                width: 60%;
            }
        }
        .submitBtn {
            position: relative;
            text-align: center;
        }
        .form-support {
            width: 100%;            
        }
        .success .form-support {
            display: none;
        }
        .success .successmsg {
            border: 0.5px solid green;
            padding: 10%;
            color: green;
        }
        form#form1 {
            position: relative;
            top: 14%;
        }
        .form-support td {
            width: 100%;
            padding-top:4%;
        }
        .e-upload {
            display: none;
        }
        input.choose-file{
            width: 60%;
        }
        button#browse {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        }  
          button#browse_poster {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        }   
        
           button#browse_trailer {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        }  
         button#browse_sub {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        } 
         button#browse_baner {
			float: right;
			margin-right: -113px;
			margin-top: -27px;
        }  
		@media only screen and (max-width: 600px) {
			.submitBtn {
			   margin-top: -22px;
			}
		 }

        .e-bigger.material button#browse {
			margin-top: -36px;      
        }
        .e-bigger.bootstrap #dropArea button#browse {
            margin-top: -40px;
        }
        .fabric #dropArea button#browse {
            margin-top: -33px;
        }
        .fabric.e-bigger #dropArea button#browse {
            margin-right: -118px;
            margin-top: -40px;
        }
		.highcontrast #dropArea button#browse {
			margin-top: -32px;
		}
		.bootstrap #dropArea button#browse {
			margin-right: -118px;
			margin-top: -34px;
		}
        .form-title {
            text-align: center;
        }
        .bootstrap label.e-float-text.e-label-top {
            font-weight: bold;
        }
		.e-bigger.highcontrast #dropArea button#browse {
			margin-top: -40px;
			margin-right: -118px;
}
</style>

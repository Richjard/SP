//dialogrto reportes
//dialogo plan
           // var ok_cuentas_modal = new ej.buttons.Button({});
           // var iconTemp_ = '<label >Cuenta seleccionada: </label> <label id="nombre_plan_contable_modal">No se selecciono a un</label><button id="ok_cuentas_modal" class="e-control e-btn e-primary" data-ripple="true">' + 'OK</button>';
            
            var headerImg_ = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
            var message_ = 'Greetings Nancy! When will you share me the source files of the project';

            var dialogObj_reportes = new ej.popups.Dialog({
               // footerTemplate:  iconTemp_,
                header: headerImg_ + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REPORTES </div>',
              //  content: '<div class="dialogContent"><span class="dialogText">' + message_ + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,
                height: '90%'
            });
            dialogObj_reportes.appendTo('#dialogObj_reportes'); 
            
            function reportes_fun(){
                //alert("aaa");
            }
            
            
            
            var headerImg__ = '<span class="e-avatar template-image e-avatar-xsmall e-avatar-circle"></span>';
       
            var dialogObj_reportes_modal = new ej.popups.Dialog({
               // footerTemplate:  iconTemp_,
                header: headerImg__ + '<div id="dlg-template" title="Nancy" class="e-icon-settings"> REPORTES </div>',
              //  content: '<div class="dialogContent"><span class="dialogText">' + message_ + '</span></div>',
                showCloseIcon: true,
                isModal: true,
                allowDragging: true,
                target: document.getElementById('target'),
                width: '70%',
              //  open: dialogOpen,
               // close: dialogClose,
                visible: false,               
            });
            dialogObj_reportes_modal.appendTo('#dialogObj_reportes_modal'); 
           /* ok_cuentas_modal.appendTo('#ok_cuentas_modal');
            (document.getElementById('ok_cuentas_modal')).onkeydown = function(e)  {
                console.log("ok xxx");
                 if (e.keyCode === 13) { 
                      ok_modal_cuentas();
                     
                 }
                 
                 
             };
              document.getElementById('ok_cuentas_modal').onclick = function () { 
                 console.log("aaaaammm");
                ok_modal_cuentas();
              };
              function ok_modal_cuentas(){                 
                  dialogObj_plan.hide();
                  $("#codigo_cuenta").val(codigo_plan_contable_modal);
                  $("#nombre_cuenta").val(nombre_plan_contable_modal);
                  $("#idplan_contable").val(idplan_contable_modal);
              }*/
//fin

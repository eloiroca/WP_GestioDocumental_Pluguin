jQuery(document).ready(function(){
  //Fer que puguem navegar per les carpetes despres de les crides ajax
  comprobar_actualitzarEventsJS();
  jQuery('#postbox-container-2').append(jQuery('#assignar_carpeta_meta_box'));

  jQuery('.btn_guardarParametres').click(function() {
      var parametre_ruta_arrel_carpetes = jQuery("#rutaCarpetes").val();
      var parametre_fitxers_per_fila =  jQuery("#fitxersFila").val();

      if(jQuery("#documental").is(':checked')){ estatGestioDocumental = 1;}else{estatGestioDocumental = 0;}
      if(jQuery("#contrasenyes").is(':checked')){ estatGestioContrasenyes = 1;}else{estatGestioContrasenyes = 0;}
      if(jQuery("#codi").is(':checked')){ estatGestioCodi = 1;}else{estatGestioCodi = 0;}
      if(jQuery("#backups").is(':checked')){ estatGestioBackups = 1;}else{estatGestioBackups = 0;}


      var parametre_estat_moduls = ["toma", estatGestioContrasenyes, estatGestioCodi, estatGestioBackups];

      var data = {'action': 'guardarParametresBD',
                    'valorParametreRuta' : parametre_ruta_arrel_carpetes,
                    'valorParametreFitxersPerFila' : parametre_fitxers_per_fila,
                    'valorParametreEstatModuls': parametre_estat_moduls
                  }
      console.log(data);

      jQuery.ajax({
            type : "post",
            url : ajax_object.ajax_url,
            data : data,

            success: function(response) {
                if (response == true){
                    alertify.success("Canvis Guardats Correctament!!!");
                }else if(response == false){
                    alertify.success("Error, no es una carpeta, s'ha establert la ruta per defecte!!!");
                }else{
                    console.log(response);
                }
            },
            error: function(response){
                console.log(response);
            }
        });

        /*
        var sortOrder = [adeu,3,2,5,5];
        var jsonString = JSON.stringify(sortOrder);
        jQuery.ajax({
          type: "POST",
          url: ajax_object.ajax_url,
          data: {'action': 'guardarParametresBD', sort_order : jsonString },
          cache: false,
          success: function(responseData) {
              // consider using console.log for these kind of things.
              //alert("Data recived: " + responseData);
              console.log(responseData);
          }
      })*/

/* JSON-encoded object:
{
  "name": "John",
  "age": 30,
  "isAdmin": false,
  "courses": ["html", "css", "js"],
  "wife": null
}
*/
  });

  //Funcio per la quantitat de fitxers per fila vol l'usuari
  //Opcio de triar la quantitat de roba
    jQuery(".incr-btn").on("click", function (e) {
        var jQuerybutton = jQuery(this);
        var oldValue = jQuerybutton.parent().find('.quantity').val();
        jQuerybutton.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if (jQuerybutton.data('action') == "increase") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                jQuerybutton.addClass('inactive');
            }
        }
        jQuerybutton.parent().find('.quantity').val(newVal);
        e.preventDefault();
    });
});

function comprobar_actualitzarEventsJS(){
  //Si els documents ja tenen els events definits no actualitzarem els events
  if (jQuery('.foto-arxiu').css( 'cursor') != 'pointer'){
      actualitzarEventsJS();
  }
}

function actualitzarEventsJS(){

  jQuery('.foto-arxiu').mouseenter(function() {
      jQuery('.foto-arxiu').css( 'cursor', 'pointer' );
  });

  jQuery('.foto-arxiu').click(function() {
      url = ajax_object.visorarchiu_url+"?id="+jQuery(this)[0].parentElement.attributes.data_name.value+"&url="+jQuery(this)[0].parentElement.attributes.data_url.value;
      if (jQuery(this)[0].parentElement.attributes.data_type.value == 'fitxer'){
          window.open(url, '_blank');
      }else{
        var valor_ruta_carpeta = jQuery(this)[0].parentElement.attributes.data_url.value+"\\"+jQuery(this)[0].parentElement.attributes.data_name.value;
        var id_pagina = recuperarIdPagina();
        actualitzar_cos_fitxers(valor_ruta_carpeta, id_pagina);
      }
  });

  jQuery('.btn_tirarEndarrera').click(function() {
      var valor_ruta_carpeta = jQuery(this)[0].attributes.data_url.value;
      var id_pagina = recuperarIdPagina();
      actualitzar_cos_fitxers(valor_ruta_carpeta, id_pagina);
    });

    //Evnet quan apretem pujar fitxers
    jQuery(".btn_pujarFitxers").on("click", function (e) {
        jQuery('.modal_pujar_fitxer').toggle('slow');
        jQuery('.carpeta_a_pujar').html('Pujar fitxers a la carpeta -> '+ jQuery('.btn_infoFitxers:first').attr('data_ruta'));
    });

    //Evnet quan apretem renombrar fitxers
    jQuery(".btn_renombrarFitxers").on("click", function (e) {
        //Mirem quans fitxers estan selecionats
        var fitxers_marcats = jQuery('input[name="chk[]"]:checked');
        if (fitxers_marcats.length == 1){
          Swal.fire({
              title: 'Quin nom li vols donar al fitxer?',
              input: 'text',
              showCancelButton: true,
              cancelButtonColor: '#d33',
              cancelButtonText: 'Cancel·lar',
              confirmButtonText: 'Canviar',
              confirmButtonColor: '#28B463',
              showLoaderOnConfirm: true,
              allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
              if (result.value) {
                var nouNom = result.value;
                var fitxers_marcats = jQuery('input[name="chk[]"]:checked');

                var data = {'action': 'renombrarCarpetaSeleccionada',
                        'valorNouNom' : nouNom,
                        'valorRutaOrigen' : fitxers_marcats[0].attributes.data_ruta.value
                      }
                jQuery.ajax({
                      type : "post",
                      url : ajax_object.ajax_url,
                      data : data,
                      success: function(response) {
                              var id_pagina = recuperarIdPagina();
                              actualitzar_cos_fitxers(jQuery('.btn_infoFitxers:first').attr('data_ruta'), id_pagina);
                              alertify.success("Renombrat!");
                      },
                      error: function(response){
                          console.log(response);
                      }
                  });
              }
              })
        }else {
            alertify.success("Error, S'ha de sel·leccionar únicament un element !!!");
        }

    });

    //Event quan apretem actualitzar fitxers
    jQuery(".btn_actualitzarFitxers").on("click", function (e) {
        var id_pagina = recuperarIdPagina();
        actualitzar_cos_fitxers(jQuery('.btn_infoFitxers:first').attr('data_ruta'), id_pagina);
    });


    jQuery(".close").on("click", function (e) {
        jQuery('.modal_pujar_fitxer').toggle('slow');
    });

    //Event quan apretem eliminar fitxers
    jQuery(".btn_eliminarFitxers").on("click", function (e) {
        var fitxers_marcats = jQuery('input[name="chk[]"]:checked');
        if (fitxers_marcats.length == 0){
            alertify.success("S'ha de sel·leccionar un element per elimina'l !!!")
        }else{
            Swal.fire({
                title: 'Estàs segur que vols eliminar els fitxers seleccionats?',
                text: "S'eliminaràn tots els fitxers seleccionats inclús les subcarpetes!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B463',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancel·lar',
                confirmButtonText: 'Si, eliminar!'
              }).then((result) => {
                if (result.value) {
                  var fitxers_marcats_arr = [];
                  for (var i=0; i<fitxers_marcats.length; i++){
                      fitxers_marcats_arr.push(fitxers_marcats[i].attributes.data_ruta.value);
                  }

                  var data = {'action': 'eliminarCarpetesSeleccionades',
                                'valorRutes' : fitxers_marcats_arr
                              }
                  jQuery.ajax({
                        type : "post",
                        url : ajax_object.ajax_url,
                        data : data,
                        success: function(response) {
                            var id_pagina = recuperarIdPagina();
                            actualitzar_cos_fitxers(jQuery('.btn_infoFitxers:first').attr('data_ruta'), id_pagina);
                            alertify.success("Eliminat!");
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });
                }
              })
            }
    });

    //Event quan apretem el botó de nova carpeta
    jQuery(".btn_afegirCarpeta").on("click", function (e) {
      Swal.fire({
          title: 'Quin nom li vols donar a la nova carpeta?',
          input: 'text',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancel·lar',
          confirmButtonText: 'Crear',
          confirmButtonColor: '#28B463',
          showLoaderOnConfirm: true,
          allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
          if (result.value) {
            var nouNom = result.value;

            var data = {'action': 'crearCarpetaNova',
                    'valorRutaCarpeta' : jQuery('.btn_infoFitxers:first').attr('data_ruta'),
                    'valorNouNom' : nouNom
                  }
            jQuery.ajax({
                  type : "post",
                  url : ajax_object.ajax_url,
                  data : data,
                  success: function(response) {
                          var id_pagina = recuperarIdPagina();
                          actualitzar_cos_fitxers(jQuery('.btn_infoFitxers:first').attr('data_ruta'), id_pagina);
                          alertify.success("Carpeta Creada!");
                  },
                  error: function(response){
                      console.log(response);
                  }
              });
          }
          })
    });

    //Event quan apretem el boto de info
    jQuery(".btn_infoFitxers").on("click", function (e) {
      Swal.fire({
        title: '<strong>Directori Actual</strong>',
        type: 'info',
        html: '<b>'+ jQuery('.btn_infoFitxers:first').attr('data_ruta') + '</b>'
      })
    });
    jQuery(".btn_infoFitxersAssignacio").on("click", function (e) {
      Swal.fire({
        title: '<strong>Directori Actual</strong>',
        type: 'info',
        html: '<b>'+ jQuery('.btn_infoFitxersAssignacio:first').attr('data_ruta') + '</b>'
      })
    });


    //Event de quan busquem un fitxer
    jQuery('.filtrar').keyup(function () {

	        var rex = new RegExp(jQuery(this).val(), 'i');

	        jQuery('.td_taula_documents').hide();
	        jQuery('.td_taula_documents').filter(function () {
	            return rex.test(jQuery(this).text());
	        }).show();
	    });

    //Event quan apretem direcotry btn_homeFitxers
    jQuery('.btn_homeFitxers').click(function () {
        if (jQuery('.btn_infoFitxersAssignacio').length == 0){
            var rutaCarpetaAccedir = jQuery('.btn_homeFitxers')[0].attributes.data_url.value;
        }else{
            var rutaCarpetaAccedir = jQuery('.btn_infoFitxersAssignacio')[0].attributes.data_ruta.value;
        }
        var id_pagina = recuperarIdPagina();

        actualitzar_cos_fitxers(rutaCarpetaAccedir, id_pagina);
    });

    if (jQuery('.btn_infoFitxersAssignacio:first').length == 1 && jQuery('.btn_homeFitxers').length == 0){
        jQuery('.btn_infoFitxers:first')[0].attributes.data_ruta.value = jQuery('.btn_infoFitxersAssignacio')[0].attributes.data_ruta.value;
    }

    //Evenet quan apretem el boto de anar a la ruta de l'assignacio
    jQuery('.btn_examinarInfoAssignacio').click(function() {
        var valor_ruta_carpeta = jQuery(this)[0].attributes.data_url.value;
        var id_pagina = recuperarIdPagina();
        actualitzar_cos_fitxers(valor_ruta_carpeta, id_pagina);
      });

    //Evenet quan apretem el boto de modificar la informacio de la assignacio
    jQuery('.btn_modificarInfoAssignacio').click(function() {
        var id_assignacio_pagina = jQuery(this)[0].attributes.data_id.value;
        var valor_ruta_carpeta = jQuery(this)[0].attributes.data_url.value;
        Swal.fire({
            title: 'Modifica la ruta assingada a la pàgina '+id_assignacio_pagina+':',
            input: 'text',
            inputValue:valor_ruta_carpeta,
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel·lar',
            confirmButtonText: 'Modificar',
            confirmButtonColor: '#28B463',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
            if (result.value) {
              var nouNom = result.value;

              var data = {'action': 'renmobrarAssignacioPagina',
                      'valorRutaCarpeta' : nouNom,
                      'valorIdAssignacio' : id_assignacio_pagina
                    }
              jQuery.ajax({
                    type : "post",
                    url : ajax_object.ajax_url,
                    data : data,
                    success: function(response) {
                            response = response.slice(0, -1);
                            alertify.success(response);
                            location.reload();
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }
            })
      });

    //Event quan apretem el boto de eliminar la assignacio
    jQuery(".btn_eliminarInfoAssignacio").on("click", function (e) {
        var id_assignacio_pagina = jQuery(this)[0].attributes.data_id.value;

        Swal.fire({
            title: 'Estàs seguir que vols eliminar l\'assignació?',
            text: "S'eliminarà l'assignació de la pàgina "+id_assignacio_pagina,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28B463',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel·lar',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.value) {
              jQuery(this).parent().parent().fadeOut('slow');
              var data = {'action': 'eliminarInfoAssignacio',
                            'valorIdAssignacio' : id_assignacio_pagina}

              jQuery.ajax({
                    type : "post",
                    url : ajax_object.ajax_url,
                    data : data,
                    success: function(response) {
                        alertify.success('Eliminat!');
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }
          })
    });
    //Carreguem el pluguin pujar archius
    carregar_pluguin_pujades();
}
function actualitzar_cos_fitxers(ruta, id_pagina){

    var data = {'action': 'entrarCarpetaSeleccionada',
            'valorRutaCarpeta' : ruta,
            'valorIdPagina' : id_pagina
          }

    jQuery.ajax({
          type : "post",
          url : ajax_object.ajax_url,
          data : data,
          success: function(response) {
                  response = response.slice(0, -1);
                  jQuery('.cos-carpetes').html(response);
                  comprobar_actualitzarEventsJS();
          },
          error: function(response){
              console.log(response);
          }
      });

}
//Funcio que retornara el id de Pagina
function recuperarIdPagina(){
  if (jQuery('.btn_infoFitxersAssignacio').length == 0){
      return id_pagina = 0;
  }else{
      return id_pagina = jQuery('.btn_infoFitxersAssignacio:first').attr('data_idPagina');
  }
}

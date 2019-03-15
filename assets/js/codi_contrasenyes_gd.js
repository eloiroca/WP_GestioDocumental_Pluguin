jQuery(document).ready(function(){
  //Fer que puguem aplicar botons despres de les crides ajax

  //Event al apretar el botó afegir contrasenya
  jQuery('.btn_afegirContrasenya').click(function() {
      jQuery('.fixat').toggle('slow').css({
         'display' : 'flex',
         'width' : '100% !important',
         'alignItems' : 'center'
      });
  });
//Event al enviar la contrasenya
jQuery('.btn_enviarContrasenya').click(function() {
    var usuari = jQuery( "[name='nom_usuari']" ).val();
    var contrasenya = jQuery( "[name='contrasenya_usuari']" ).val();
    var descripcio = jQuery( "[name='descripcio_contrasenya']" ).val();
    var tipus = jQuery( "[name='tipus_contrasenya']" ).val();
    var url = jQuery( "[name='url_contrasenya']" ).val();
    var comentari = jQuery( "[name='comentari_contrasenya']" ).val();

    if (usuari!="" && contrasenya!="" && descripcio!="" && tipus!="" && url!=""){

      if (jQuery( ".btn_enviarContrasenya" ).text() == "Actualitzar"){

          var data = {'action': 'modificarContrasenya',
                  'valorContrasenyaId' : jQuery(this)[0].attributes.data_id.value,
                  'valorUsuari' : usuari,
                  'valorContrasenya' : contrasenya,
                  'valorDescripcio' : descripcio,
                  'valorTipus' : tipus,
                  'valorUrl' : url,
                  'valorComentari' : comentari
                }

          jQuery.ajax({
                type : "post",
                url : ajax_object.ajax_url,
                data : data,
                success: function(response) {
                        alertify.success("Contrasenya Modificada");
                        location.reload();
                },
                error: function(response){
                    console.log(response);
                }
            });
      }else if (jQuery( ".btn_enviarContrasenya" ).text()=="Afegir") {
            var data = {'action': 'crearContrasenya',
                    'valorUsuari' : usuari,
                    'valorContrasenya' : contrasenya,
                    'valorDescripcio' : descripcio,
                    'valorTipus' : tipus,
                    'valorUrl' : url,
                    'valorComentari' : comentari
                  }

            jQuery.ajax({
                  type : "post",
                  url : ajax_object.ajax_url,
                  data : data,
                  success: function(response) {
                        console.log(response);
                          alertify.success("Contrasenya Afegida");
                          location.reload();
                  },
                  error: function(response){
                      console.log(response);
                  }
              });
      }
    }else{
        alertify.error("Has d'omplir tots els camps obligatoriament, excepte el comentari");
    }
  });
  //Event al eliminar la contrasenya
  jQuery('.btn_eliminarContrasenya').click(function() {
      Swal.fire({
          title: 'Estàs segur que vols eliminar la contrasenya?',
          text: "S'eliminarà la contrasenya i no es podrà recuperar!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28B463',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancel·lar',
          confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
          if (result.value) {
            jQuery(this).parent().parent().fadeOut('slow');
            var data = {'action': 'eliminarContrasenya',
                          'valorContrasenyaId' : jQuery(this)[0].attributes.data_id.value
                        }
            jQuery.ajax({
                  type : "post",
                  url : ajax_object.ajax_url,
                  data : data,
                  success: function(response) {
                      response = response.slice(0, -1);
                      alertify.success("Eliminada");
                  },
                  error: function(response){
                      console.log(response);
                  }
              });
          }
        })
  });
  //Event al cancelar la contrasenya
  jQuery('.btn_cancelarContrasenya').click(function() {
      jQuery('.fixat').toggle('slow');
  })
  //Event al buscar una contrasenya
  jQuery('.filtrar_contrasenya').keyup(function () {

        var rex = new RegExp(jQuery(this).val(), 'i');

        if (jQuery(this).val()==""){
            //Amaguem totes les contrasenyes si l'usuari no escriu res
            jQuery(".totes_les_contrasenyes").css('display', 'none');
            jQuery(".contrasenya_vista_previa").css('display', 'block');
        }else{
            jQuery(".contrasenya_vista_previa").css('display', 'none');
            jQuery(".totes_les_contrasenyes").css('display', 'block');
        }

        jQuery('.td_assignacio').hide();
        jQuery('.td_assignacio').filter(function () {
            return rex.test(jQuery(this).text());
        }).show();
    });
    //Event quan editem una contrasenya
    jQuery('.btn_modificarContrasenya').click(function () {
      var id_contrasenya = jQuery(this)[0].attributes.data_id.value;
      var data = {'action': 'editarContrasenya',
                    'valorContrasenyaId' : id_contrasenya
                  }
      jQuery.ajax({
            type : "post",
            url : ajax_object.ajax_url,
            data : data,
            success: function(response) {
                response = response.slice(0, -1);
                var contrasenya_dades = JSON.parse(response);

                var usuari = jQuery( "[name='nom_usuari']" ).val(contrasenya_dades[0].usuari);
                var contrasenya = jQuery( "[name='contrasenya_usuari']" ).val(contrasenya_dades[0].contrasenya);
                var descripcio = jQuery( "[name='descripcio_contrasenya']" ).val(contrasenya_dades[0].descripcio);
                var tipus = jQuery( "[name='tipus_contrasenya']" ).val(contrasenya_dades[0].tipo_contrasenya);
                var url = jQuery( "[name='url_contrasenya']" ).val(contrasenya_dades[0].url);
                var comentari = jQuery( "[name='comentari_contrasenya']" ).val(contrasenya_dades[0].comentari);
                jQuery( ".btn_enviarContrasenya" ).text("Actualitzar");
                jQuery( ".btn_enviarContrasenya" ).attr('data_id' , id_contrasenya);

                jQuery('.fixat').toggle('slow').css({
                   'display' : 'flex',
                   'width' : '100% !important',
                   'alignItems' : 'center'
                });
            },
            error: function(response){
                console.log(response);
            }
        });
    });
    //Event al apretar el boto de cancelar
    jQuery('.btn_cancelarContrasenya').click(function () {
        location.reload();
    });
    //Event de copiar al portapapeles les contrasenyes
    jQuery('.td_assignacio_info').click(function () {
        copiarAlPortapapers(jQuery(this));
    });
});

function copiarAlPortapapers(elemento) {
    var $temp = jQuery("<input>")
    jQuery("body").append($temp);
    $temp.val(jQuery(elemento).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

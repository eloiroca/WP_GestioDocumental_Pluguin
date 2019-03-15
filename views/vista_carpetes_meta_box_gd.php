<?php
    //Si a la pàgina ja se li ha assignat una carpeta carregarem el contingut d'aquella carpeta directament
    if (existeix_assignacio_pagina($post->ID)){

      if (! te_guardat_titol_pagina($post->ID)){
          guardar_titol_pagina($post->ID, $post->post_title);
      }
      $carpetaAssignada = recuperarCarpetaAssignada($post->ID);
?>
      <div id="parametres_pluguins">
        <p class="titol_parametres">Aquesta pàgina està assignada a una carpeta </p>
        <button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_infoFitxersAssignacio" data_idPagina="<?php echo $post->ID ?>" data_ruta="<?php echo $carpetaAssignada; ?>"><img class="imgOpcions" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-info.png'); ?>'></button>
        <p class="titol_parametres">Eliminar Assignació </p>
        <button type="button" name="button" class="btn btn-danger btn_navegaciofitxers btn_eliminarAssignacio" data_ruta="<?php echo $carpetaAssignada; ?>"><img class="imgOpcions" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar-assignacio.png'); ?>'></button>
      </div>
      <div class='cos-carpetes'><?php echo crear_cos_pluguin($carpetaAssignada, 'ocultar_tirarEndarrera_true'); ?></div>

      <script>
          jQuery('.btn_eliminarAssignacio').on("click", function (e) {
            Swal.fire({
                title: "Estàs seguir que vols eliminar l'assignació?",
                text: "S'eliminarà l'assignació d'aquesta pàgina a la carpeta actual!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28B463',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancel·lar',
                confirmButtonText: 'Si, eliminar!'
              }).then((result) => {
                if (result.value) {
                  var data = {'action': 'eliminarAssignacio',
                                'valorIdPagina' : <?php echo $post->ID ?>
                              }
                  jQuery.ajax({
                        type : "post",
                        url : ajax_object.ajax_url,
                        data : data,
                        success: function(response) {
                            location.reload();
                            alertify.success("Assignació Eliminada!");
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });
                }
              })
          });
      </script>

<?php
    }else{
?>
      <div id="parametres_pluguins">
        <p class="titol_parametres">Marcar una de les següents carpetes per assignar-la a la pàgina actual</p>
      </div>
      <div class='cos-carpetes'><?php echo crear_cos_pluguin("ruta_per_defecte", 'ocultar_tirarEndarrera_false'); ?></div>

      <script>
          //Fem que quan apreti publicar es guardi el ID de la pagina i la ruta que li ha assignat l'usuari
          $('#major-publishing-actions').children('#publishing-action').on("click", function (e) {

              var fitxers_marcats = $('input[name="chk[]"]:checked');
              if (fitxers_marcats.length == 0){
                  alertify.success("S'ha de sel·leccionar un directori per assigna'l a la pagina !!!")
              }else if(fitxers_marcats.length == 1){


                  var data = {'action': 'assignarCarpetaPagina',
                                'valorRutaAssignada' : fitxers_marcats[0].attributes.data_ruta.value,
                                'valorIdPagina' : <?php echo $post->ID; ?>
                  }

                  $.ajax({
                        type : "post",
                        url : ajax_object.ajax_url,
                        data : data,
                        success: function(response) {
                            response = response.slice(0, -1);
                            alertify.success(response);
                        },
                        error: function(response){
                            console.log(response);
                        }
                    });

                }
            });

      </script>
<?php
    }
?>

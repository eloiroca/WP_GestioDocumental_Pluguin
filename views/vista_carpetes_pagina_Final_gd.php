<div class="gridContainerCarpetes">
      <div id="parametres_pluguins">
        <p class="titol_parametres">Aquesta pàgina està assignada a una carpeta </p>
        <button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_infoFitxersAssignacio" data_idPagina="<?php echo $idPagina ?>" data_ruta="<?php echo $carpetaAssignada; ?>"><img class="imgOpcions" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-info.png'); ?>'></button>
        <p class="titol_parametres">Eliminar Assignació </p>
        <button type="button" name="button" class="btn btn-danger btn_navegaciofitxers btn_eliminarAssignacio" data_ruta="<?php echo $carpetaAssignada; ?>"><img class="imgOpcions" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar-assignacio.png'); ?>'></button>

      </div>
      <?php echo "<br><p class='versioAplicacio'>Versió ". obtenirVersio(); ?>
      <div class='cos-carpetes'><?php echo crear_cos_pluguin($carpetaAssignada, 'ocultar_tirarEndarrera_true'); ?></div>
</div>
      <script>
          var id_pagina = recuperarIdPagina();
          actualitzar_cos_fitxers(jQuery('.btn_infoFitxersAssignacio:first').attr('data_ruta'), id_pagina);
          jQuery('.gridContainerCarpetes').appendTo(jQuery('.post-'+<?php echo $idPagina ?>));

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
                                'valorIdPagina' :' <?php echo $idPagina ?>'
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

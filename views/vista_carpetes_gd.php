<?php



 ?>

 <div id="titol_vista_pluguin" class="panel panel-primary">
  <div class="panel-body">
			<div class="logo_col col-xs col-sm-fit logo_documental_pluguin">
					<img src="<?php echo plugins_url("gestiodocumentalpluguin/assets/img/logo_documental.png"); ?>" />
          <?php echo "<br><p class='versioAplicacio'>Versió ". obtenirVersio(); ?>
			</div>
  </div>
</div>

<div id="cos_vista_pluguin">
    <div id="contenedor_del_cos" class="col-md-12">
        <div id="cos_primerPerfil" class="panel panel-primary cos_primerPerfil_marges">
            <div class="panel-body cos-carpetes">
								<?php echo crear_cos_pluguin("ruta_per_defecte", 'ocultar_tirarEndarrera_false'); ?>
                <div class="panel-peu">

                </div>
						</div>
				</div>
        <div id="cos_primerPerfil_Assignacions" class="panel panel-primary panell_asossiacions cos_primerPerfil_marges">
            <div class="panel-body">
              <div id="parametres_pluguins">
                  <p class="titol_parametres">Carpetes assignades a pàgines</p>
              </div>

                <div class="th_assignacio row">
                    <div class="col-md-1">ID</div>
                    <div class="col-md-4">Titol</div>
                    <div class="col-md-5">Carpeta</div>
                    <div class="col-md-2">Opcions</div>
                </div>

                <?php
                    $numAssignacions = assignacions_total_bd();

                    for ($i=0;$i<$numAssignacions;$i++){
                      $valorColumna = valor_columnes_assignacions($i);
                ?>
                      <div class="td_assignacio row">
                          <div class="col-md-1 td_assignacio_info"><?php echo $valorColumna['id'] ?></div>
                          <div class="col-md-4 td_assignacio_info"><?php echo $valorColumna['titol'] ?></div>
                          <div class="col-md-5 td_assignacio_info"><p class='descripcio-arxiu'><?php echo $valorColumna['ruta'] ?></p></div>
                          <div class="col-md-2 td_assignacio_info">
                            <button class="btn btn-primary btn_fitxers btn_examinarInfoAssignacio" data_url="<?php echo $valorColumna['ruta'] ?>"><img height=19 src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png') ?>'></button>
                            <button class="btn btn-warning btn_fitxers btn_modificarInfoAssignacio" data_url="<?php echo $valorColumna['ruta'] ?>" data_id="<?php echo $valorColumna['id'] ?>"><img height=19 src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-renombrar.png') ?>'></button>
                            <button id="btn_eliminarPerfil" class="btn btn-danger btn_eliminarInfoAssignacio" data_id="<?php echo $valorColumna['id'] ?>"><img height=19 src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar-assignacio.png') ?>'></button>
                          </div>
                      </div>
                <?php
                    }
                ?>
                <div class="panel-peu">

                </div>
						</div>
				</div>
		</div>
</div>

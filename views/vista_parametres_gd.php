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
        <div id="cos_primerPerfil" class="panel panel-primary">
            <div class="panel-body">

                <div id="opcions_parametres">
                  <div id="parametres_pluguins">
                      <p class="titol_parametres">Mòduls Actius</p>
                  </div>

                  <form>
                      <div class="row">
                        <div class="col-md-3">
                          <input class="check_bonic" type="checkbox" id="documental" name="modul_documental" value="GestioDocumental">
                          <label for="documental">Mòdul GestioCarpetes</label>
                      </div>
                      <div class="col-md-3">
                          <input class="check_bonic" type="checkbox" id="contrasenyes" name="modul_contrasenyes" value="GestioContrasenyes">
                          <label for="contrasenyes">Mòdul GestioContrasenyes</label>
                    </div>
                    <div class="col-md-3">
                        <input class="check_bonic" type="checkbox" id="codi" name="modul_codi" value="GestioCodi">
                        <label for="codi">Mòdul GestioCodi</label>
                    </div>
                    <div class="col-md-3">
                        <input class="check_bonic" type="checkbox" id="backups" name="modul_backups" value="GestioBackups">
                        <label for="backups">Mòdul GestioBackups</label>
                    </div>
                    </div>
                  </form>

                  <script>
                  <?php
                      if (estat_modul("GestioDocumental")=="true"){
                          ?>jQuery('#documental').prop('checked', true);<?php
                      }
                      if (estat_modul("GestioContrasenyes")=="true") {
                          ?>jQuery('#contrasenyes').prop('checked', true);<?php
                      }
                      if (estat_modul("GestioCodi")=="true") {
                          ?>jQuery('#codi').prop('checked', true);<?php
                      }
                      if (estat_modul("GestioBackups")=="true") {
                          ?>jQuery('#backups').prop('checked', true);<?php
                      }
                  ?>
                  </script>

                </div>

                <?php if (estat_modul("GestioDocumental")=="true"){ ?>
								 <div id="opcions_parametres">
                  <div id="parametres_pluguins">
  										<p class="titol_parametres">Paràmetres Gestió Carpetes</p>
  								</div>

                  <ul style="margin-left: 15px;"><li class="li_boleta">Ruta Carpetes</li></ul>
                  <input id="rutaCarpetes" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreRutaDefecte(); ?>"/>

                  <ul style="margin-left: 15px; margin-top:10px;"><li class="li_boleta">Fitxers per fila</li></ul>
                  <div class='count-input space-bottom'> <a class='incr-btn' data-action='decrease' href='#'>–</a> <input id="fitxersFila" class='quantity' type='number' readonly name='quantity' value='<?php echo obtenirParametreFitxersPerFila(); ?>'/> <a class='incr-btn' data-action='increase' href='#'>&plus;</a> </div>
                  //Permetre la vista de carpetes encara que l'usuari no estigui loggejat
                </div>
               <?php } ?>

              <?php if (estat_modul("GestioContrasenyes")=="true"){ ?>
                <div id="opcions_parametres">
                  <div id="parametres_pluguins">
  										<p class="titol_parametres">Paràmetres Gestió Contrasenyes</p>
  								</div>
                  //Permetre la vista de contrasenyes encara que l'usuari no estigui loggejat
								</div>
              <?php } ?>
                <div class="panel-peu">
                    <button type="button" name="button" class="btn btn-success btn_guardarParametres">Guardar Canvis</button>
                </div>
						</div>
				</div>
		</div>
</div>

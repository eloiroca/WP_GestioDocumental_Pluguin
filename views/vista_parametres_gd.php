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
                  <ul style="margin-left: 15px;">
                    <li class="li_boleta">Habilitar Gestio Carpetes sense Loggejar-se
                      <input class="check_bonic" type="checkbox" id="backups" name="modul_backups" value="GestioBackups">
                      <label for="backups"></label>
                    </li>
                  </ul>
                </div>
               <?php } ?>

              <?php if (estat_modul("GestioContrasenyes")=="true"){ ?>
                <div id="opcions_parametres">
                  <div id="parametres_pluguins">
  										<p class="titol_parametres">Paràmetres Gestió Contrasenyes</p>
  								</div>
                  <ul style="margin-left: 15px;">
                    <li class="li_boleta">Habilitar Gestio Contrasenya sense Loggejar-se
                      <input class="check_bonic" type="checkbox" id="backups" name="modul_backups" value="GestioBackups">
                      <label for="backups"></label>
                    </li>
                  </ul>


								</div>
              <?php } ?>
              <?php if (estat_modul("GestioBackups")=="true"){ ?>
                <div id="opcions_parametres">
                  <div id="parametres_pluguins">
  										<p class="titol_parametres">Paràmetres Gestió Backups</p>
  								</div>

                  <br>

                  <div class="row">
                    <div class="col-md-4">
                      <div id="backups_tipus">
                          <p class="titol_backups">Backup BD</p>
                      </div>
                      <div class="dades_backups">
                      <p><i>Origen Taules: <span class="info_dades_backups"><input id="origenSQLBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreTaulesDefecte(); ?>"/></span></i></p>
                      <p><i>Desti: <span class="info_dades_backups"></span><input id="destiSQLBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreTaulesDestiDefecte(); ?>"/></i></p>

                      </div>
                    </div>
                    <div class="col-md-4">
                      <div id="backups_tipus">
                          <p class="titol_backups">Backup Arxiu Gestio Codi</p>
                      </div>
                      <p><i>Origen: <span class="info_dades_backups"><input id="origenCodiBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreCodiOrigenBackupDefecte(); ?>"/></span></i></p>
                      <p><i>Desti: <span class="info_dades_backups"></span><input id="destiCodiBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreCodiDestiBackupDefecte(); ?>"/></i></p>

                    </div>
                    <div class="col-md-4">
                      <div id="backups_tipus">
                          <p class="titol_backups">Backup PC Eloi</p>
                      </div>
                      <p><i>Origen: <span class="info_dades_backups"><input id="origenSQLBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value=""/></span></i></p>
                      <p><i>Desti: <span class="info_dades_backups"></span><input id="destiSQLBackup" type="text" class="form-control input_form" style="border: 1px solid black !important;" placeholder="Ruta per defecte ..." value=""/></i></p>
                    </div>
                  </div>




								</div>


              <?php } ?>
              <!--<div id="opcions_parametres">
                <div id="parametres_pluguins">
                    <p class="titol_parametres">Paràmetres Gesta Config</p>
                </div>

                <br>

                <div class="row">
                  <div class="col-md-4">
                    <div id="backups_tipus">
                        <p class="titol_backups">Fitxer de Configuració</p>
                    </div>
                    <div class="dades_backups">
                    <p><i><input id="inputGestaConfig" type="text" class="form-control input_form" style="border: 1px solid black !important; " placeholder="Ruta per defecte ..." value="<?php echo obtenirParametreGestaDefecte(); ?>"/></span></i></p>


                    </div>
                  </div>
                  <div class="col-md-4">
                    <div id="backups_tipus">
                        <p class="titol_backups">Servidor Actual</p>
                    </div>
                    <div class="dades_backups">
                      <select id="selectGestaServer" name="carlist" form="carform" class="form-control form-control-lg"  style="border: 1px solid black !important;font-size: 15px !important;height:37px !important;text-align:center;">
                         <?php //echo obtenirDadesFitxerConfig('Server') ?>
                       </select>
                     </div>

                  </div>

                  <div class="col-md-4">
                    <div id="backups_tipus">
                        <p class="titol_backups">Base de Dades Actual</p>
                    </div>
                    <div class="dades_backups">
                      <select id="selectGestaBD" name="aaa" form="carform" class="form-control form-control-lg" style="border: 1px solid black !important;font-size: 15px !important;height:37px !important;text-align:center;">
                         <?php //echo obtenirDadesFitxerConfig('BD') ?>
                       </select>

                     </div>
                  </div>
                </div>
              </div>-->


                <div class="panel-peu">
                    <button type="button" name="button" class="btn btn-success btn_guardarParametres">Guardar Canvis</button>
                </div>
						</div>
				</div>
		</div>
</div>

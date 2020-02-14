<?php



 ?>

 <div id="titol_vista_pluguin" class="panel panel-primary">
  <div class="panel-body">
			<div class="logo_col col-xs col-sm-fit logo_documental_pluguin">
					<img src="<?php echo plugins_url("gestiodocumentalpluguin/assets/img/logo_contrasenyes.png"); ?>" />
          <?php echo "<br><p class='versioAplicacio'>Versió ". obtenirVersio(); ?>
			</div>
  </div>
</div>

<div id="cos_vista_pluguin">
    <div id="contenedor_del_cos" class="col-md-12">
        <div id="cos_primerPerfil" class="panel panel-primary cos_primerPerfil_marges contra_taules">
           <div class="panell_contrasenyes">
             <div class="row col-md-12 panell_opcions">
                <div class="col-md-4">
                    <span class="span_ping"><img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-ping.png');?>'>Ping</span>
                </div>
                <div class="col-md-4">
                    <div class='div_contador_contrasenyes'><span class="span_cuantitat_contrassenyes"><?php echo obtenirContrasenyesTotals();?></span></div>
                </div>
                <div class="col-md-4 contenedor_notes">
                    <span class="span_notes">Notes<img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-notes.png');?>'><div class="notes_pendents"><?php echo obtenirNotesPendents();?></div></span>
                </div>
             </div>
             <div class="col-md-12 panell_opcions"><img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png');?>'>
             <input id="filtre_contrasenyes" class="filtrar_contrasenya" type="text" class="form-control" placeholder="Cerca contrasenyes, utlitza el caracter \ per buscar més informació ..."/>
             <img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png'); ?>'></div>

             <div class="row">
               <div class="th_assignacio row ">
                 <div class="col-md-1">Tipus</div>
                 <div class="col-md-2">Descripció</div>
                 <div class="col-md-2">Usuari</div>
                 <div class="col-md-2">Contrasenya</div>
                 <div class="col-md-2">URL</div>
                 <div class="col-md-2">Comentari</div>
                 <div class="col-md-1"><button type='button' name='button' class='btn btn-success btn_fitxers btn_afegirContrasenya'><img class='imgOpcions_contra' src="<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-afegirContra.png') ?>"></button></div>
               </div>
               <div class="contrasenya_vista_previa">
                  <?php echo vista_contrasenyes_gd("vista_previa") ?>
               </div>
               <div class="totes_les_contrasenyes">
                  <?php echo vista_contrasenyes_gd("vista_totes") ?>
               </div>

             </div>
             <div class="fixat">
               <div class="container-contact100" style="background-image: url(<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/fondo-formularis.jpg') ?>);">
              		<div class="wrap-contact100">
              			<form class="contact100-form validate-form">
              				<span class="contact100-form-title">
              					<img style="display:inline;" src="<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-afegirContra.png') ?>"/>Afegir Contrasenya <img style="display:inline;" src="<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-afegirContra.png') ?>"/>
              				</span>

              				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
              					<span class="label-input100">Usuari</span>
              					<input class="input100" type="text" name="nom_usuari" placeholder="Nom d'usuari" required>
              				</div>

              				<div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
              					<span class="label-input100">Contrasenya</span>
              					<input class="input100" type="text" name="contrasenya_usuari" placeholder="Contrasenya" required>
              				</div>

                      <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Tipus</span>
              					<input class="input100" type="text" name="tipus_contrasenya" placeholder="" required>
              				</div>

                      <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="label-input100">Descripcio</span>
              					<input class="input100" type="text" name="descripcio_contrasenya" placeholder="www.XXXX.xxx" required>
              				</div>

              				<div class="wrap-input100">
              					<span class="label-input100">URL</span>
              					<input class="input100" type="text" name="url_contrasenya" placeholder="https://" required>
              				</div>

                      <div class="wrap-input100">
              					<span class="label-input100">Comentari</span>
              					<input class="input100" type="text" name="comentari_contrasenya" placeholder="" >
              				</div>
                      </form>
              				<div class="container-contact100-form-btn">
              					<div class="wrap-contact100-form-btn">
              						<div class="contact100-form-bgbtn2"></div>
              						<button class="contact100-form-btn btn_cancelarContrasenya">
              							Cancelar
              						</button>
              					</div>

                        <div class="wrap-contact100-form-btn">
              						<div class="contact100-form-bgbtn"></div>
              						<button class="contact100-form-btn btn_enviarContrasenya">Afegir</button>
              					</div>
              				</div>

              		</div>

              	</div>
          </div>


           </div>
				</div>
		</div>
</div>

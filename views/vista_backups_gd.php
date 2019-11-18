
<div id="titol_vista_pluguin" class="panel panel-primary">
  <div class="panel-body">
			<div class="logo_col col-xs col-sm-fit logo_documental_pluguin">
					<img src="<?php echo plugins_url("gestiodocumentalpluguin/assets/img/logo_backups.png"); ?>" />
          <?php echo "<br><p class='versioAplicacio'>Versió ". obtenirVersio(); ?>
			</div>
  </div>
</div>

<div id="cos_vista_pluguin">
    <div id="contenedor_del_cos" class="col-md-12">
        <div id="cos_primerPerfil" class="panel panel-primary cos_primerPerfil_marges contra_taules">
             <div class="row">
               <div class="col-md-12 panell_opcions">
                 <div class="row">
                   <div class="col-md-6">
                     <div id="backups_tipus">
                         <p class="titol_backups">Backup BD</p>
                     </div>
                     <div class="dades_backups">
                       <p><i>Origen Taules:<br><span class="info_dades_backups"><?php echo obtenirParametreTaulesDefecte(); ?></span></i></p>
                       <p><i>Desti:<br><span class="info_dades_backups"><?php echo obtenirParametreTaulesDestiDefecte(); ?></span></i></p>
                       <p><i>Última Còpia:<br><span class="info_dades_backups"><?php echo obtenirUltimaCopia('sql'); ?></span></i></p>
                       <button type="button" class="btn btn-primary btn-lg btn-block boto_backup boto_backup_bd">Realitzar</button>

                       <div class="progress">
                         <div class="progress-bar progress-bar-striped progress-bar-animated progress_bd" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                       </div>
                     </div>
                     <?php echo crear_cos_pluguin(obtenirParametreTaulesDestiDefecte(), 'ocultar_barra_navegacio',); ?>
                   </div>
                   <div class="col-md-6">
                     <div id="backups_tipus">
                         <p class="titol_backups">Backup Arxiu Gestio Codi</p>
                     </div>
                     <div class="dades_backups">
                     <p><i>Origen:<br><span class="info_dades_backups"><?php echo obtenirParametreCodiOrigenBackupDefecte(); ?></span></i></p>
                     <p><i>Desti:<br><span class="info_dades_backups"><?php echo obtenirParametreCodiDestiBackupDefecte(); ?></span></i></p>
                     <p><i>Última Còpia:<br><span class="info_dades_backups"><?php echo obtenirUltimaCopia('codi'); ?></span></i></p>
                     <button type="button" class="btn btn-primary btn-lg btn-block boto_backup boto_backup_codi">Realitzar</button>
                     <div class="progress">
                       <div class="progress-bar progress-bar-striped progress-bar-animated progress_codi" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                     </div>
                   </div>
                   <?php echo crear_cos_pluguin(obtenirParametreCodiDestiBackupDefecte(), 'ocultar_barra_navegacio'); ?>
                   </div>

                 </div>
               </div>
             </div>
				</div>
		</div>
</div>

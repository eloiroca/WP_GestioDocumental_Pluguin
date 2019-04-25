<?php



 ?>


 <div id="titol_vista_pluguin" class="panel panel-primary">
  <div class="panel-body">
			<div class="logo_col col-xs col-sm-fit logo_documental_pluguin">
					<img src="<?php echo plugins_url("gestiodocumentalpluguin/assets/img/icono-codi.png"); ?>" />
          <?php echo "<br><p class='versioAplicacio'>Versió ". obtenirVersio(); ?>
			</div>
  </div>
</div>

<div id="cos_vista_pluguin">
    <div id="contenedor_del_cos" class="col-md-12">
        <div id="cos_primerPerfil" class="panel panel-primary cos_primerPerfil_marges contra_taules">
           <div class="panell_contrasenyes">

             <div class="row">
               <div class="col-md-12 panell_opcions">
                  <button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_guardarFitxers float-right"><img class="imgOpcions" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-guardar.png'); ?>'></button>

               </div>
               <hr class="separador">
             </div>

             <div class="row">
               <form id='formulari_codi' action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST">
                  <textarea name="codi" id="myTextarea" style="height: 200%;"><?php	$archivo = plugin_dir_path( __DIR__ ).'/assets/php/codi.php';	$abrir = fopen($archivo, "r"); $contenido = fread($abrir, filesize($archivo)); fclose($abrir); echo $contenido;?></textarea>
            	 </form>


             </div>
           </div>
				</div>
		</div>
</div>
<script>
  //Instancia de CodeMirror
  var editor = CodeMirror.fromTextArea(document.getElementById("myTextarea"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true
      });
</script>

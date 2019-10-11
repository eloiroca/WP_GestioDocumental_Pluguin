<?php

  add_action( 'wp_ajax_guardarFitxerCodi', 'guardarFitxerCodi' );
  function guardarFitxerCodi() {
      $valorFormulari = $_POST['valorFormulari'];

      $archivo = plugin_dir_path( __DIR__ ).'/assets/php/codi.php';

      $file = fopen($archivo, "w");
			fwrite($file, stripslashes(html_entity_decode($valorFormulari)));
			fclose($file);
  }
?>

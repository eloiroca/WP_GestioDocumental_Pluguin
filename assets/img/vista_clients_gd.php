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
                  <div class="row programes-compsa">
                      <div class="col-md-6"><img class="" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/logo_caratula_gesta.png');?>'></div>
                      <div class="col-md-6"><img class="" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/logo_caratula_compta.jpg');?>'></div>
                  </div>
                  <div class="col-md-12 panell_opcions"><img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png');?>'>
                  <input id="filtre_contrasenyes" class="filtrar_contrasenya" type="text" class="form-control" placeholder="Cerca clients, utlitza el caracter \ per buscar més informació ..."/>
                  <img class="img_buscar" src='<?php echo plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png'); ?>'></div>

                  <?php
                      $clients = recuperarClients();

                      foreach ($clients as $client) {
                        //echo '<div class="client_llistat" data_id="69169">'.$client->nom.'<input type="checkbox" class="check_completat"></div>';
                        // code...




                  ?>

                  <div class="limiter">
                    		<div class="container-table100">
                    			<div class="wrap-table100">

                    				<div class="table100 ver5 m-b-110">
                    					<table data-vertable="ver5">
                    						<thead>
                    							<tr class="row100 head">
                                    <th class="column100 column1" data-column="column1">Nif</th>
                    								<th class="column100 column1" data-column="column2">Nom</th>
                    								<th class="column100 column2" data-column="column3">Email</th>
                    								<th class="column100 column5" data-column="column4">Comentari</th>
                    								<th class="column100 column6" data-column="column5">Informe</th>
                                    <th class="column100 column6" data-column="column6"><?php echo "<a class='href_contrasenya' href='#' target='_blank'><img class='img_web' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-afegir-empresa.png' )."></a>";?></th>
                    							</tr>
                    						</thead>
                    						<tbody>
                    							<tr class="row100" v-for="usuari of dadesUSUARISBD">
                    								<td class="column100 column1" data-column="column1"><?php echo $client->nif ?></td>
                    								<td class="column100 column2" data-column="column2"><?php echo $client->nom ?></td>
                    								<td class="column100 column3" data-column="column3"><?php echo $client->email ?></td>
                    								<td class="column100 column4" data-column="column4"><?php echo $client->comentari ?></td>
                    								<td class="column100 column5" data-column="column5"><?php echo "<a class='href_contrasenya' href='".admin_url()."admin.php?page=gestio-menu-clients-concret&id_client=".$client->id."' target='_blank'><img class='img_web' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-informe.png' )."></a>";?></td>
                                    <td class="column100 column6" data-column="column6">eliminar, editar</td>
                    							</tr>

                    						</tbody>
                    					</table>
                    				</div>
                    			</div>
                    		</div>
                    	</div>


<?php
}
?>


                </div>
						</div>
				</div>
		</div>
</div>

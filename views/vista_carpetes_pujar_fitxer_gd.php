<div class='modal_pujar_fitxer'>
    <p class='close'>x</p>
    <div class="contenedor_modal_pijar_fitxer">
      <main role="main" class="container">

      <div id="parametres_pluguins" style="margin-top:15px;">
          <h6 class="carpeta_a_pujar"></h6>
      </div>

    <div class="row">
      <div class="col-md-6 col-sm-12">

        <!-- Our markup, the important part here! -->
        <div id="drag-and-drop-zone" class="dm-uploader p-5">
          <h3 class="mb-5 mt-5 text-muted">Arrastra o puja fitxers aquí</h3>
          <h5 class="mb-5 mt-5 text-muted">Màxim <?php echo isa_convert_bytes_to_specified(wp_max_upload_size(), 'G', 2)."GB"; ?> </h5>
          <div class="btn btn-primary btn-block mb-5">
              <span>Obrir explorador de fitxers</span>
              <input type="file" title='Click to add Files' />
          </div>
        </div><!-- /uploader -->

      </div>
      <div class="col-md-6 col-sm-12">
        <div class="card h-100">
          <div class="card-header">
            Llista fitxers pujats
          </div>

          <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
            <li class="text-muted text-center empty">No s'han pujat fitxers.</li>
          </ul>
        </div>
      </div>
    </div><!-- /file list -->

    <div class="log_arxius_pujats">


          <div class="card-header">
            Log arxius pujats
          </div>

          <ul class="list-group list-group-flush" id="debug">
            <li class="list-group-item text-muted empty">Carregant plugin....</li>
          </ul>


    </div>
  </main>
    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Estat: <span class="text-muted">Esperant</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
              role="progressbar"
              style="width: 0%"
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
    </div>

    </div>

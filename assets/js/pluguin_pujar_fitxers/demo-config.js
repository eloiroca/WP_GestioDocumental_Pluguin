function carregar_pluguin_pujades(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   *
   * UI functions ui_* can be located in: demo-ui.js
   */

   var ruta_a_pujar = jQuery('.btn_infoFitxers:first').attr('data_ruta');
  jQuery('#drag-and-drop-zone').dmUploader({ //
    url: ajax_object.archiu_pujarFitxersPluguin_url+'?ruta='+ruta_a_pujar,
    maxFileSize: 90000000000000000000000000000000, // 3 Megs
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Pluguin Iniciat ☻', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('Tots els fitxers han estat pujats');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('Nou fitxer afegit #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Començant a pujar el fitxer #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadCanceled: function(id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Cancelat per l\'usuari');
      ui_multi_update_file_progress(id, 0, 'warning', false);
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
      ui_add_log('Pujada del fitxer #' + id + ' Completada', 'success');
      ui_multi_update_file_status(id, 'success', 'Pujada completada');
      ui_multi_update_file_progress(id, 100, 'success', false);
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Aquest navegador no soporta aquest pluguin', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('El fitxer \'' + file.name + '\' no pot ser pujat: excedeix la mida maxima permesa', 'danger');
    }
  });
};

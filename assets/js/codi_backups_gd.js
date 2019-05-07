jQuery(document).ready(function(){

    jQuery('.boto_backup_eloi').click(function() {
        jQuery('.progress_pc_eloi').css('display', 'block');
        /*
        var data = {'action': 'guardarFitxerCodi',
                      'valorFormulari' : contingut
                    }
        jQuery.ajax({
              type : "post",
              url : ajax_object.ajax_url,
              data : data,

              success: function(response) {
                console.log(response);
                alertify.success("Canvis Guardats Correctament!!!");
              },
              error: function(response){
                  console.log(response);
              }
          });
          */
    });
    jQuery('.boto_backup_codi').click(function() {
        jQuery('.progress_codi').css('display', 'block');

        var data = {'action': 'guardarFitxerCodi_backup'}
        jQuery.ajax({
              type : "post",
              url : ajax_object.ajax_url,
              data : data,

              success: function(response) {
                console.log(response);
                alertify.success("Canvis Guardats Correctament!!!");
                jQuery('.progress_codi').css('display', 'none');
                location.reload();
              },
              error: function(response){
                  console.log(response);
              }
          });

    });
    jQuery('.boto_backup_bd').click(function() {
        jQuery('.progress_bd').css('display', 'block');

        var data = {'action': 'realitzar_backup_db'}
        jQuery.ajax({
              type : "post",
              url : ajax_object.ajax_url,
              data : data,

              success: function(response) {
                console.log(response);
                if (response == true){
                   alertify.success("Canvis Guardats Correctament!!!");
                   jQuery('.progress_bd').css('display', 'none');
                   location.reload();
                }else {
                   alertify.error("Hi ha hagut algun error, revisa els parametres de configuració!!!");
                }
              },
              error: function(response){
                  //console.log(response);
              }
          });

    });
});

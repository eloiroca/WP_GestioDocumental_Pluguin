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
    jQuery('.boto_backup_bd').click(function() {
        jQuery('.progress_bd').css('display', 'block');
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
});

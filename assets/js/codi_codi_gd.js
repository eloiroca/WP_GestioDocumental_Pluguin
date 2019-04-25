jQuery(document).ready(function(){

    jQuery('.btn_guardarFitxers').click(function() {

        editor.save();
        var contingut = editor.getValue();

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
    });

});

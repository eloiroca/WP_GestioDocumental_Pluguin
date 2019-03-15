<?php
    //Funcio per contruir el cos de les contrasenyes
    function crear_cos_contrasenyes_pluguin(){
        echo "cos d eles contrasenyes com a compsa pero sense el codi";
    }

    //Funcio que retornara les files de les contrasenyes
    function vista_contrasenyes_gd($tipus){
        global $wpdb;
        if($tipus == "vista_previa"){
          $contrasenyes = $wpdb->get_results( "SELECT id, tipo_contrasenya, descripcio, usuari, contrasenya, comentari, url FROM ( SELECT id, tipo_contrasenya, descripcio, usuari, contrasenya, comentari, url, @rn := IF(@prev = tipo_contrasenya, @rn + 1, 1) AS rn, @prev := tipo_contrasenya FROM gd_pluguin_contrasenyes JOIN (SELECT @prev := NULL, @rn := 0) AS vars ORDER BY tipo_contrasenya DESC ) AS T1 WHERE rn <= 2");
        }elseif ($tipus == "vista_totes") {
          $contrasenyes = $wpdb->get_results( "SELECT * from gd_pluguin_contrasenyes");
        }

        $td="";
        for ($i=0;$i<count($contrasenyes);$i++){
            $td .= "<div class='td_assignacio row '>
                      <div class='col-md-1 td_assignacio_info'>".$contrasenyes[$i]->tipo_contrasenya."</div>
                      <div class='col-md-2 td_assignacio_info'>".$contrasenyes[$i]->descripcio."</div>
                      <div class='col-md-2 td_assignacio_info user_camp'>".$contrasenyes[$i]->usuari."</div>
                      <div class='col-md-2 td_assignacio_info user_camp'>".$contrasenyes[$i]->contrasenya."</div>
                      <div class='col-md-1 td_assignacio_info'><a class='href_contrasenya' href=".$contrasenyes[$i]->url." target='_blank'><img class='img_web' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-web.png' )."></a></div>
                      <div class='col-md-3 td_assignacio_info'>".$contrasenyes[$i]->comentari."</div>
                      <div class='col-md-1 td_assignacio_info'>
                          <button type='button' name='button' class='btn btn-warning btn_fitxers btn_modificarContrasenya' data_id=".$contrasenyes[$i]->id."><img class='imgOpcions_contra mida_contra' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-renombrar.png')."></button>
                          <button type='button' name='button' class='btn btn-danger btn_fitxers btn_eliminarContrasenya' data_id=".$contrasenyes[$i]->id."><img class='imgOpcions_contra mida_contra' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar.png')."></button>
                      </div>
                  </div>";
        }
        return $td;
    }

    //Funcio que creara una contrasenya nova
    add_action( 'wp_ajax_crearContrasenya', 'crearContrasenya' );
    function crearContrasenya(){
        global $wpdb;
        $wpdb->get_results( "insert into gd_pluguin_contrasenyes (tipo_contrasenya, descripcio, usuari, contrasenya, url, comentari) values ('".$_POST['valorTipus']."','".$_POST['valorDescripcio']."','".$_POST['valorUsuari']."','".$_POST['valorContrasenya']."','".$_POST['valorUrl']."','".$_POST['valorComentari']."')" );
    }
    //Funcio que eliminara una contrasenya
    add_action( 'wp_ajax_eliminarContrasenya', 'eliminarContrasenya' );
    function eliminarContrasenya(){
        global $wpdb;
        $wpdb->get_results( "delete from gd_pluguin_contrasenyes where id=".$_POST['valorContrasenyaId']);
    }
    //Funcio que tornara les dades d'una contrasenya
    add_action( 'wp_ajax_editarContrasenya', 'editarContrasenya' );
    function editarContrasenya(){
        //echo $_POST['valorContrasenyaId'];
        global $wpdb;
        $contrasenyes = $wpdb->get_results( "SELECT * from gd_pluguin_contrasenyes where id=".$_POST['valorContrasenyaId']);

        print json_encode($contrasenyes);
    }
    //Funcio que editara la contrasenya
    add_action( 'wp_ajax_modificarContrasenya', 'modificarContrasenya' );
    function modificarContrasenya(){
        //echo $_POST['valorContrasenyaId'];
        global $wpdb;
        //echo $_POST['valorTipus'];
        $contrasenyes = $wpdb->get_results( "update gd_pluguin_contrasenyes set tipo_contrasenya='".$_POST['valorTipus']."', usuari='".$_POST['valorUsuari']."', contrasenya='".$_POST['valorContrasenya']."', descripcio='".$_POST['valorDescripcio']."', url='".$_POST['valorUrl']."', comentari='".$_POST['valorComentari']."' where id=".$_POST['valorContrasenyaId']);

    }


?>

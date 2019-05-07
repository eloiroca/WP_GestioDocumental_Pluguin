<?php

    //Funcio per guardar el parametre de la parametre_ruta_arrel_carpetes
    add_action( 'wp_ajax_guardarParametresBD', 'guardarParametresBD' );
    function guardarParametresBD() {
      $valorParametreRuta = $_POST['valorParametreRuta'];
      $valorParametreFitxersFila = $_POST['valorParametreFitxersPerFila'];
      $valorEstatsModuls = $_POST['valorParametreEstatModuls'];
      $valorParametreSqlOrigen = $_POST['valorParametreSqlOrigen'];
      $valorParametreSqlDesti = $_POST['valorParametreSqlDesti'];
      $valorParametreCodiOrigen = $_POST['valorParametreCodiOrigen'];
      $valorParametreCodiDesti = $_POST['valorParametreCodiDesti'];


      global $wpdb;

      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreFitxersFila."' where nom = 'parametre_mostrar_fitxers_per_fila'");
      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorEstatsModuls['GestioDocumental']."' where nom = 'parametre_estat_modul_GestioDocumental'");
      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorEstatsModuls['GestioContrasenyes']."' where nom = 'parametre_estat_modul_GestioContrasenyes'");
      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorEstatsModuls['GestioCodi']."' where nom = 'parametre_estat_modul_GestioCodi'");
      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorEstatsModuls['GestioBackups']."' where nom = 'parametre_estat_modul_GestioBackups'");
      if ($valorParametreSqlOrigen!=''){$wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreSqlOrigen."' where nom = 'parametre_SqlOrigen_backup'");}
      if ($valorParametreSqlDesti!=''){$wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreSqlDesti."' where nom = 'parametre_SqlDesti_backup'");}
      if ($valorParametreCodiOrigen!=''){$wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreCodiOrigen."' where nom = 'parametre_CodiOrigen_backup'");}
      if ($valorParametreCodiDesti!=''){$wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreCodiDesti."' where nom = 'parametre_CodiDesti_backup'");}

      if (is_dir($valorParametreRuta)){
        //Ens connectem a la base de dades i guardem el parametre.
        $wpdb->get_results("update gd_pluguin_parametres set valor = '".$valorParametreRuta."' where nom = 'parametre_ruta_arrel_carpetes'");
        echo true;
      }else{
        $wpdb->get_results("update gd_pluguin_parametres set valor = '.' where nom = 'parametre_ruta_arrel_carpetes'");
        echo false;
      }
    	wp_die();
    }

    add_action( 'wp_function_comprobar_dadesPerDefecte', 'comprobar_dadesPerDefecte' );
    //ComprobacioDadesPerDefecte
    function comprobar_dadesPerDefecte($versio){
      //Comprobarem que s'hagin creat les taules corresponents per poder utilitzar el pluguin
      global $wpdb;
      //Crear taula parametres
      $wpdb->get_results( "CREATE TABLE IF NOT EXISTS gd_pluguin_parametres ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, nom VARCHAR(255) NOT NULL, valor VARCHAR(255) default '.' NOT NULL )" );
      //Crear taula carpetes assignades
      $wpdb->get_results( "CREATE TABLE IF NOT EXISTS gd_pluguin_carpetesAssignades ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, id_pagina INT(25) NOT NULL, url VARCHAR(255), ruta_assignada VARCHAR(255) NOT NULL)" );
      //Crear taula contrasenyes
      $wpdb->get_results( "CREATE TABLE IF NOT EXISTS gd_pluguin_contrasenyes ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, tipo_contrasenya VARCHAR(255) NOT NULL, descripcio VARCHAR(255) NOT NULL, usuari VARCHAR(255) NOT NULL, contrasenya VARCHAR(255) NOT NULL, url VARCHAR(255), comentari VARCHAR(255))" );
      //S'hi no hi ha entrades de parametres creem els de per defecte
      $numParametres = $wpdb->get_row( "select count(id) numIds from gd_pluguin_parametres" );
      if ($numParametres->numIds == 0){

          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_versio_pluguin','".$versio."')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_ruta_arrel_carpetes','.')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_mostrar_fitxers_per_fila','5')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_estat_modul_GestioDocumental','true')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_estat_modul_GestioContrasenyes','false')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_estat_modul_GestioCodi','false')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_estat_modul_GestioBackups','false')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_SqlOrigen_backup','gd_pluguin_parametres,gd_pluguin_contrasenyes,gd_pluguin_carpetesassignades')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_SqlDesti_backup','C:\\\Users\\\Eloi\\\Desktop\\\Backups GD\\\Base de Dades')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_CodiOrigen_backup','".str_replace('\\', '/', plugin_dir_path( __DIR__ )).'assets/php/codi.php'."')" );
          $wpdb->get_results( "insert into gd_pluguin_parametres (nom, valor) values ('parametre_CodiDesti_backup','C:\\\Users\\\Eloi\\\Desktop\\\Backups GD\\\Codi')" );


      }
      //Actualitzem la versio sempre que la canviem
      $wpdb->get_results("update gd_pluguin_parametres set valor = '".$versio."' where nom = 'parametre_versio_pluguin'");
    }
    //Funcio que retornara la versio actual
    function obtenirVersio(){
        global $wpdb;
        $versio = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom = 'parametre_versio_pluguin'" );
        return $versio->valor;
    }

    //Funcio per crear una nova carpeta
    add_action( 'wp_ajax_crearCarpetaNova', 'crearCarpetaNova' );
    function crearCarpetaNova() {
        $nom_fitxer = $_POST['valorNouNom'];
        $nom_fitxer = eliminar_SignesIncompatibles($nom_fitxer);

        $ruta_on_crearCarpeta = $_POST['valorRutaCarpeta'];
        mkdir($ruta_on_crearCarpeta."/".$nom_fitxer, 0700);
    }

    //Funcio per entrar en una carpeta seleccionada
    add_action( 'wp_ajax_entrarCarpetaSeleccionada', 'entrarCarpetaSeleccionada' );
    function entrarCarpetaSeleccionada() {
        $carpeta = $_POST['valorRutaCarpeta'];
        $ruta = multiexplode(array("/","//","\\\\"),$carpeta);

        $rutaFinal = '';
        for ($i=0; $i<count($ruta); $i++){
            $rutaFinal.=$ruta[$i]."\\";
        }
        $rutaFinal = substr($rutaFinal, 0, -1);

        //Comprobarem si s'ha d'ocultar el home a la carpeta que accedeix l'usuari //Si a la carpeta que intenta anar es la de Home es deshabilitaran els botons de Home i Tirar endarrra
        if ($_POST['valorIdPagina'] != 0){
            $carpetaAssignadaPagina = recuperarCarpetaAssignada($_POST['valorIdPagina']);
            $rutaCarpetaAssignada = multiexplode(array("/","//","\\\\"),$carpetaAssignadaPagina);

            $rutaFinalCarpetaAssignada = '';
            for ($i=0; $i<count($rutaCarpetaAssignada); $i++){
                $rutaFinalCarpetaAssignada.=$rutaCarpetaAssignada[$i]."\\";
            }
            $rutaFinalCarpetaAssignada = substr($rutaFinalCarpetaAssignada, 0, -1);
            if ($rutaFinal == $rutaFinalCarpetaAssignada){
                echo crear_cos_pluguin($rutaFinal, 'ocultar_tirarEndarrera_true');
            }else{
                echo crear_cos_pluguin($rutaFinal, 'ocultar_tirarEndarrera_false');
            }

        }else{
            echo crear_cos_pluguin($rutaFinal, 'ocultar_tirarEndarrera_false');
        }
    }

    //Funcio per comproba el signes per poder escriure noms de fitxers al windows
    function eliminar_SignesIncompatibles($nomFitxer){
        $parametresWindowsNoPermesos = array('\\','?','"','<','>','|','*',':',':','/');
        $parametresRemplas = array(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ');
        $nom_fitxer = str_replace($parametresWindowsNoPermesos, $parametresRemplas ,$nomFitxer);
        return $nom_fitxer;
    }

    //Fucncio per guardar a la base de dades la carpeta assignada a la pagina
    add_action( 'wp_ajax_assignarCarpetaPagina', 'assignarCarpetaPagina' );
    function assignarCarpetaPagina() {
        global $wpdb;
        $id = $_POST['valorIdPagina'];
        $rutaAssignada = $_POST['valorRutaAssignada'];
        //Si ja existeix la actualitzarem i sino la crearem
        $assignacions = $wpdb->get_row( "select count(id) numIds from gd_pluguin_carpetesAssignades where id_pagina=".$id);

        if(! existeix_assignacio_pagina($id)){
            $wpdb->get_results( "insert into gd_pluguin_carpetesAssignades (id_pagina, ruta_assignada) values ('$id','$rutaAssignada')" );
            echo "Assignació Creada";
        }else {
            $wpdb->get_results( "update gd_pluguin_carpetesAssignades set ruta_assignada = '$rutaAssignada' where id_pagina = $id" );
            echo "Assignació Actualitzada";
        }
    }
    //Funcio que retornara si existeix una assignacio d'una pagina
    function existeix_assignacio_pagina($id){
        global $wpdb;
        $assignacions = $wpdb->get_row( "select count(id) numIds from gd_pluguin_carpetesAssignades where id_pagina=".$id);
        if($assignacions->numIds == 1){
            return true;
        }else{
            return false;
        }
    }
    add_action( 'wp_ajax_recuperarCarpetaAssignadaPagina', 'recuperarCarpetaAssignadaPagina' );
    function recuperarCarpetaAssignadaPagina(){
        echo recuperarCarpetaAssignada($_POST['valorIdPagina']);
    }
    //Funcio que recupera la carpeta a la qual esta assignada la pagina
    function recuperarCarpetaAssignada($id){
        global $wpdb;
        $assignacio = $wpdb->get_row( "select ruta_assignada from gd_pluguin_carpetesAssignades where id_pagina=".$id);
        return $assignacio->ruta_assignada;
    }
    //Funcio per eliminar lassignacio d'una pagina
    add_action( 'wp_ajax_eliminarAssignacio', 'eliminarAssignacio' );
    function eliminarAssignacio(){
        $id = $_POST['valorIdPagina'];
        global $wpdb;
        $assignacio = $wpdb->get_row( "delete from gd_pluguin_carpetesAssignades where id_pagina=".$id);

    }
    //Funcio que retornara true si ja te la pagina guardada
    function te_guardat_titol_pagina($id){
        global $wpdb;
        $assignacio = $wpdb->get_row( "select id, url from gd_pluguin_carpetesAssignades where id_pagina=".$id);
        if ($assignacio->url == ''){
            return false;
        }else{return true;}
    }
    //Funcio que anira guardan els titols de les pagines
    function guardar_titol_pagina($id, $titol){
        global $wpdb;
        $wpdb->get_results( "update gd_pluguin_carpetesAssignades set url='$titol' where id_pagina=".$id);
    }
    //Funcio per renombrar una carpeta seleccionada
    add_action( 'wp_ajax_renombrarCarpetaSeleccionada', 'renombrarCarpetaSeleccionada' );
    function renombrarCarpetaSeleccionada() {
        $nom_fitxer = $_POST['valorNouNom'];
        $rutaVella = $_POST['valorRutaOrigen'];

        $nom_fitxer = eliminar_SignesIncompatibles($nom_fitxer);

        $rutaArr = multiexplode(array("/","//","\\"),$rutaVella);
        $posicio = count($rutaArr)-1;

        //Si es un archiu conservarem l'extenció que té per evitar
        if (! is_dir($rutaVella)){
            $nom_fitxer_arr = explode('.', $rutaArr[$posicio]);
            $extencio = $nom_fitxer_arr[1];
            unset($rutaArr[$posicio]);
            $rutaFinal = implode("/", $rutaArr)."/".$nom_fitxer.'.'.$extencio;

            rename($rutaVella, $rutaFinal);
        }else{
            unset($rutaArr[$posicio]);
            $rutaFinal = implode("/", $rutaArr)."/".$nom_fitxer;

            rename($rutaVella, $rutaFinal);
        }
    }

    //Funcio per eliminar les carpetes seleccionades per l'usuari
    add_action( 'wp_ajax_eliminarCarpetesSeleccionades', 'eliminarCarpetesSeleccionades' );
    function eliminarCarpetesSeleccionades() {
        $rutes = $_POST['valorRutes'];
        for ($i=0; $i<count($rutes); $i++){
            DeleteFolderFiles($rutes[$i]);
        }
    }
    /*******************************************/
    /**
    * Loescht Dateien und Ordner innerhalb eines Ordners
    *
    * @param string $file Pfad zum Ordner, welcher geloescht werden soll
    * @return nix
    */
    function DeleteFolderFiles($file) {

        // Dateiberechtigung auf Vollzugriff stellen
        chmod($file,0777);

        // Pruefen ob es ein Ordner ist
        if (is_dir($file)) {

            // Resource oeffnen
            $resource = opendir($file);

            // Rekursiv durch den Ordner durchgehen
            while($filename = readdir($resource)) {

                // uebergeordnete, welche zur Navigation dienen, werden ignoriert
                if ($filename != "." && $filename != "..") {

                    // Datei innerhalb des Ordners loeschen
                    DeleteFolderFiles($file."/".$filename);
                }
            }

            // Resource schliessen
            closedir($resource);

            // Ordner loeschen
            rmdir($file);
        } else {
            // Wenn es sich nicht um einen Ordner handelt -> Datei loeschen
            unlink($file);
        }
    }

    //Funcio que elimina subdirectoris i directoris
      function rrmdir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    rrmdir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }

    function obtenirParametreFitxersPerFila(){
      global $wpdb;
      $valorParametre = $wpdb->get_row("select valor from gd_pluguin_parametres where nom='parametre_mostrar_fitxers_per_fila'");
      return (int) $valorParametre->valor;
    }

    function obtenirParametreRutaDefecte(){
        global $wpdb;
        $valorParametre = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom='parametre_ruta_arrel_carpetes'" );
        return $valorParametre->valor;
    }

    function obtenirParametreTaulesDefecte(){
        global $wpdb;
        $valorParametre = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom='parametre_SqlOrigen_backup'" );
        return $valorParametre->valor;
    }

    function obtenirParametreTaulesDestiDefecte(){
        global $wpdb;
        $valorParametre = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom='parametre_SqlDesti_backup'" );
        return $valorParametre->valor;
    }

    function obtenirParametreCodiOrigenBackupDefecte(){
        global $wpdb;
        $valorParametre = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom='parametre_CodiOrigen_backup'" );
        return $valorParametre->valor;
    }

    function obtenirParametreCodiDestiBackupDefecte(){
        global $wpdb;
        $valorParametre = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom='parametre_CodiDesti_backup'" );
        return $valorParametre->valor;
    }

    function multiexplode ($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
    function foto_segons_extencio($fitxer){
        $extencions_arr = array("pdf","txt","xls","iso","sql","doc","docx","php","js","php","exe","zip",
        "rar","mrt","jpg","png","gif","jpeg","mp3","mp4");

        $fitxerArr = explode(".", $fitxer);

        for ($i=0;$i<count($extencions_arr);$i++){
            if ($extencions_arr[$i] == end($fitxerArr)){
              return plugins_url( 'gestiodocumentalpluguin/assets/img/icono-'.$extencions_arr[$i].'.png' );
            }
        }
        if (! in_array(end($fitxerArr), $extencions_arr)){
            return plugins_url( 'gestiodocumentalpluguin/assets/img/icono-arxiu.png' );
        }
    }

    //Ruta per obtenir la ruta anterior de les carpetes
    function obtenirRutaAnterior($ruta){
        $rutaAnterior = explode('\\',$ruta);
        $posicio = count($rutaAnterior)-1;
        unset($rutaAnterior[$posicio]);

        $rutaFinal = '';
        for ($i=0; $i<count($rutaAnterior); $i++){
            $rutaFinal.=$rutaAnterior[$i]."\\";
        }
        $rutaFinal = substr($rutaFinal, 0, -1);
        return $rutaFinal;
    }

    //Crearem el Cos
    function crear_cos_pluguin($ruta, $ocultar_tirarEndarrera){
        $RutaPerDefecte = obtenirParametreRutaDefecte();

        if ($ruta=='ruta_per_defecte'){
            $directori_base = $RutaPerDefecte;
            $directori_anterior = obtenirRutaAnterior($directori_base);

        }else{
            $directori_base = $ruta;
            $directori_anterior = obtenirRutaAnterior($directori_base);
        }

        $cos = '<div class="row"><div class="col-md-3 panell_opcions">';
        if ($directori_base == $RutaPerDefecte){
            $cos .= '<button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_infoFitxers" data_ruta="'.$RutaPerDefecte.'"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-info.png').'></button>';
        }elseif ($ocultar_tirarEndarrera == 'ocultar_tirarEndarrera_true') {

            $cos .= '<button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_infoFitxers" data_ruta="'.$RutaPerDefecte.'"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-info.png').'></button>';
        }else{
            $cos .= '<button type="button" name="button" class="btn btn-success btn_navegaciofitxers btn_homeFitxers" data_url="'.$RutaPerDefecte.'"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-home.png').'></button>
            <button type="button" name="button" class="btn btn-success btn_navegaciofitxers btn_tirarEndarrera" data_url="'.$directori_anterior.'"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-tornar.png').'></button>
            <button type="button" name="button" class="btn btn-primary btn_navegaciofitxers btn_infoFitxers" data_ruta="'.$directori_base.'"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-info.png').'></button>';
        }

        $cos .= '</div>';

        //Incluim la vista de pujar fitxers
        include plugin_dir_path( __DIR__ ).'/views/vista_carpetes_pujar_fitxer_gd.php';


        $cos.='<div class="col-md-5 panell_opcions"><img class="img_buscar" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png').'>
        <input id="filtrar" class="filtrar" type="text" class="form-control" placeholder="Escriu el nom d\'algun element ..."/>
        <img class="img_buscar" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-buscar.png').'></div>';


        $cos.='<div class="col-md-4 panell_opcions"><button type="button" name="button" class="btn btn-primary btn_fitxers btn_actualitzarFitxers"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-actualitzar.png').'></button>
        <button type="button" name="button" class="btn btn-primary btn_fitxers btn_afegirCarpeta"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-afegirCarpeta.png').'></button>
        <button type="button" name="button" class="btn btn-success btn_fitxers btn_pujarFitxers"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-pujar.png').'></button>
        <button type="button" name="button" class="btn btn-warning btn_fitxers btn_renombrarFitxers"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-renombrar.png').'></button>
        <button type="button" name="button" class="btn btn-danger btn_fitxers btn_eliminarFitxers"><img class="imgOpcions" src='.plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar.png').'></button>



        </div></div>';

        $archius = scandir($directori_base);

        $cos .= "<table class='taula_documents'><hr class='separador'><tr class='tr_taula_documents'>".buscar_archius_directori($directori_base, $archius)."</tr></table>";

        return $cos;
    }

    //Funcio que obtindra els arxius
    function buscar_archius_directori($ruta, $fitxers){
        $estructura_directori = "";
        $contadorTr = obtenirParametreFitxersPerFila();
        foreach ($fitxers as $key => $fitxer) {

            if (is_dir($ruta."/".$fitxer) && $fitxer!='.' && $fitxer!='..'){

              $estructura_directori .= "<td class='element-directori td_taula_documents' data_type='directori' data_name='$fitxer' data_url='$ruta'><label class='container'><input type='checkbox' name='chk[]' data_ruta='".$ruta."/".$fitxer."'><span class='checkmark'></span></label><img class='foto-arxiu' src='".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-carpeta.png' )."'><p class='descripcio-arxiu'>".$fitxer ."</p></td>";
              $contadorTr --;
              if ($contadorTr == 0) {
                $estructura_directori .= "</tr><tr class='tr_taula_documents'>";
                $contadorTr = obtenirParametreFitxersPerFila();
              }
            }
        }

        foreach ($fitxers as $key => $fitxer) {
          if (! is_dir($ruta."/".$fitxer)){

              $estructura_directori .= "<td class='element-directori td_taula_documents' data_type='fitxer' data_name='$fitxer' data_url='$ruta'><label class='container'><input type='checkbox' name='chk[]' data_ruta='".$ruta."/".$fitxer."'><span class='checkmark'></span></label><img class='foto-arxiu' src='".foto_segons_extencio($fitxer)."'><p class='descripcio-arxiu'>".$fitxer ."</p></td>";
              $contadorTr --;
              if ($contadorTr == 0) {
                $estructura_directori .="</tr><tr class='tr_taula_documents'>";
                $contadorTr = obtenirParametreFitxersPerFila();
              }
          }

        }

        return $estructura_directori;
    }
    /*add_action('add_meta_boxes', 'add_meta_boxes_post_type_switcher',10,2);
    function add_meta_boxes_post_type_switcher($post_type,$post) {
      global $pagenow;
      if ($pagenow=='post-new.php') {
        require_once(ABSPATH . 'wp-admin/includes/template.php');

        add_meta_box('post_type_switcher','Marcar Carpeta Especifica Pàgina',
                     'post_type_switcher',$post_type,'','high');
      }
    }
    function post_type_switcher($post,$metabox) {
      $post_types = get_post_types();
      $new_post_url = admin_url('post-new.php');

    }*/

    function isa_convert_bytes_to_specified($bytes, $to, $decimal_places = 1) {
    $formulas = array(
        'K' => number_format($bytes / 1024, $decimal_places),
        'M' => number_format($bytes / 1048576, $decimal_places),
        'G' => number_format($bytes / 1073741824, $decimal_places)
    );
    return isset($formulas[$to]) ? $formulas[$to] : 0;
}

if (estat_modul("GestioDocumental")=="true"){
    add_action( "add_meta_boxes", "se20892273_add_meta_boxes_entry" );
    add_action( "add_meta_boxes_page", "se20892273_add_meta_boxes_page" );
}

// Register Your Meta box
function se20892273_add_meta_boxes_page( $post )
{
    add_meta_box(
       'assignar_carpeta_meta_box', // this is HTML id
       'Assignar carpeta a la pàgina actual',
       'assignar_carpeta_meta_box', // the callback function
       'page', // register on post type = page
       'side', //
       'core'
    );
}
// Register Your Meta box
function se20892273_add_meta_boxes_entry( $post )
{
    add_meta_box(
       'assignar_carpeta_meta_box', // this is HTML id
       'Assignar carpeta a la pàgina actual',
       'assignar_carpeta_meta_box', // the callback function
       'post', // register on post type = page
       'side', //
       'core'
    );
}
function assignar_carpeta_meta_box( $post ){
    //Carreguem la vista del meta box
    include plugin_dir_path( __DIR__ ).'views/vista_carpetes_meta_box_gd.php';
}

add_action( "save_post_page", "se20892273_save_post_page" );
//add_action( "save_post_entry", "se20892273_save_post_page" );
function se20892273_save_post_page( $post_ID )
{
    if (estat_modul("GestioDocumental")=="true"){
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
            return $post_ID ;

        if( isset( $_POST['input_name'] ))
        {
            update_post_meta( $post_ID, '_w4_template', $_POST['input_name'] );
        }
    }
}

//Funcio que pintara la carpeta assignada a la Pagina final, es a dir a la WEB
add_action('wp_footer', 'pintarCosPluguinPaginaFinal');
function pintarCosPluguinPaginaFinal() {
  if (estat_modul("GestioDocumental")=="true"){
      $idPagina = get_the_ID();
      if (existeix_assignacio_pagina($idPagina)){
          $carpetaAssignada = recuperarCarpetaAssignada($idPagina);
          $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          $actual_link_explode2 = explode('/', $actual_link);
          $actual_link_explode3 = explode('/?', $actual_link);
          $actual_link_explode3 = substr($actual_link_explode3[0], 0, 2);

          if (!in_array("category", $actual_link_explode2) && $actual_link_explode3 != 's=') {
              include plugin_dir_path( __DIR__ ).'views/vista_carpetes_pagina_Final_gd.php';
          }

      }
  }
}

function body_classs( $class = '' ) {
    // Separates classes with a single space, collates classes for body element
    echo 'class="' . join( ' ', get_body_class( $class ) ) . '"';
}

//Funcio que retornara el valor total de assignacions que hi ha a la web
function assignacions_total_bd(){
    global $wpdb;
    $assignacions = $wpdb->get_row( "select count(id) numeroAssig from gd_pluguin_carpetesAssignades");
    return $assignacions->numeroAssig;
}
//Funcio que retornara la informacio de la columna que es demana
function valor_columnes_assignacions($posicio){

  global $wpdb;
  $ass = $wpdb->get_row( "select * from gd_pluguin_carpetesAssignades order by id desc limit ".$posicio.",1");
  return $arrayName = array('id' =>$ass->id_pagina, 'titol'=> $ass->url, 'ruta' => $ass->ruta_assignada);
}
//Funcio per renombrar l'assignacio de la pagina
add_action( 'wp_ajax_renmobrarAssignacioPagina', 'renmobrarAssignacioPagina');
function renmobrarAssignacioPagina(){

    $id_pagina = $_POST['valorIdAssignacio'];
    $nova_ruta_assignacio = $_POST['valorRutaCarpeta'];

    if (is_dir($nova_ruta_assignacio)){
        global $wpdb;
        $wpdb->get_row( "update gd_pluguin_carpetesAssignades set ruta_assignada='".$nova_ruta_assignacio."' where id_pagina = ".$id_pagina."");
        echo "Modificat!";
    }else{
      echo "Aquesta carpeta no existeix o no es correcta, revisa-la!";
    }
}
//Funcio que eliminara la informacio de l'assignacio a la taula d'assignacions
add_action( 'wp_ajax_eliminarInfoAssignacio', 'eliminarInfoAssignacio');
function eliminarInfoAssignacio(){
    $id_pagina = $_POST['valorIdAssignacio'];
    echo $id_pagina;
    global $wpdb;
    $wpdb->get_row( "delete from gd_pluguin_carpetesAssignades where id_pagina = ".$id_pagina."");
    echo "aaa";
}
//Funcio per saber si un modul esta actiu o no
function estat_modul($nomModul){
    global $wpdb;
    $estat = $wpdb->get_row( "select valor from gd_pluguin_parametres where nom = 'parametre_estat_modul_".$nomModul."'");
    return $estat->valor;
}
?>

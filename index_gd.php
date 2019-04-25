<?php
/*
Plugin Name: GestioDocumentalPluguin
Plugin URI:
Description: Pluguin que augmentara les funcionalitats de la web documental
Version: 1.0.0
Author: EloiRoca
Author URI:
License:
License URI:
*/
$versio = "1.2.7";
include 'controladors\functions_carpetes_gd.php';
include 'controladors\functions_contrasenyes_gd.php';
include 'controladors\functions_codi_gd.php';
//Encuarem els estils, JS, etc dins del wordpress

function encuar_estils_pluguin(){
    $versio = "1.2.7";

    wp_enqueue_style( 'style-compsaonline', plugins_url( 'gestiodocumentalpluguin/assets/css/estil_gd.css'), array(), $versio);
    wp_enqueue_style( 'style-modals', plugins_url( 'gestiodocumentalpluguin/assets/css/formularis_modals.css'), array(), $versio);
    wp_enqueue_style( 'style-pluguin-pujarFitxers1', plugins_url( 'gestiodocumentalpluguin/assets/css/jquery.dm-uploader.min.css'), array(), $versio);
    wp_enqueue_style( 'style-pluguin-pujarFitxers2', plugins_url( 'gestiodocumentalpluguin/assets/css/styles_pujarFitxer.css'), array(), $versio);
    wp_enqueue_style( 'style_pluguin_bootstrap', plugins_url( 'gestiodocumentalpluguin/assets/css/bootstrap.css'), array(), $versio);

    wp_register_style( 'style-fonts', 'https://fonts.googleapis.com/css?family=Montserrat', null, null, true );
    wp_enqueue_style('style-fonts');

    //ALERTES DEL PLUGUIN
    wp_enqueue_style( 'style-alertyfy', plugins_url( 'gestiodocumentalpluguin/assets/css/alertify.css'), array(), $versio);
    wp_enqueue_script( 'js-alertyfy', plugins_url( '/assets/js/alertify.js', __FILE__ ), array('jquery'), $versio);
    wp_register_script( 'js-sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@8', null, null, true );
    wp_enqueue_script('js-sweetalert');

    //CODEMIRROR EDITOR ONLINE FITXERS
    wp_enqueue_style( 'style-codemirror1', plugins_url( 'gestiodocumentalpluguin/assets/js/codemirror-5.40.0/doc/docs.css'), array(), $versio);
    wp_enqueue_style( 'style-codemirror2', plugins_url( 'gestiodocumentalpluguin/assets/js/codemirror-5.40.0/lib/codemirror.css'), array(), $versio);
    wp_enqueue_script( 'js-codemirror7', plugins_url( '/assets/js/codemirror-5.40.0/lib/codemirror.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror6', plugins_url( '/assets/js/codemirror-5.40.0/mode/clike/clike.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror1', plugins_url( '/assets/js/codemirror-5.40.0/addon/edit/matchbrackets.js', __FILE__ ), array('jquery'), $versio);

    wp_enqueue_script( 'js-codemirror2', plugins_url( '/assets/js/codemirror-5.40.0/mode/htmlmixed/htmlmixed.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror3', plugins_url( '/assets/js/codemirror-5.40.0/mode/xml/xml.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror4', plugins_url( '/assets/js/codemirror-5.40.0/mode/javascript/javascript.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror5', plugins_url( '/assets/js/codemirror-5.40.0/mode/css/css.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'js-codemirror8', plugins_url( '/assets/js/codemirror-5.40.0/mode/php/php.js', __FILE__ ), array('jquery'), $versio);


    //Importarem el jQuery per poder utilitzar el fitxer
    //wp_enqueue_script( 'ajax-script-jquery', plugins_url( '/assets/js/jquery.min.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'ajax-script', plugins_url( '/assets/js/codi_carpetes_gd.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'ajax-script-2', plugins_url( '/assets/js/codi_contrasenyes_gd.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'ajax-script-3', plugins_url( '/assets/js/codi_codi_gd.js', __FILE__ ), array('jquery'), $versio);

    //Importarem els Scripts de Pujar Fitxers
    wp_enqueue_script( 'ajax-script-fitxers1', plugins_url( '/assets/js/pluguin_pujar_fitxers/jquery.dm-uploader.min.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'ajax-script-fitxers2', plugins_url( '/assets/js/pluguin_pujar_fitxers/demo-ui.js', __FILE__ ), array('jquery'), $versio);
    wp_enqueue_script( 'ajax-script-fitxers3', plugins_url( '/assets/js/pluguin_pujar_fitxers/demo-config.js', __FILE__ ), array('jquery'), $versio);

    //Per poder utilitzar variables globals amb jQuery
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'visorarchiu_url' => plugins_url('/gestiodocumentalpluguin/visorarchiu.php'), 'archiu_pujarFitxersPluguin_url' => plugins_url('/gestiodocumentalpluguin/assets/js/pluguin_pujar_fitxers/backend/upload.php') ));
}

add_action('wp_enqueue_scripts', 'encuar_estils_pluguin',10);
add_action('admin_enqueue_scripts', 'encuar_estils_pluguin',10);
//if (get_admin_page_title()=="Funcionalitats"){

do_action( 'wp_enqueue_scripts' );
//S'hi es la primera vegada que executa el pluguin activarem les taules a la BD
comprobar_dadesPerDefecte($versio);

//Funcio que creara els menus i submenu dins del panel dadministracio del WP
function crear_menu_pluguin(){
  add_menu_page('GestioDocumental', 'GestioDocumental', 'manage_options', 'gestio-menu', 'crear_menu_general',plugins_url( 'gestiodocumentalpluguin/assets/img/icon.png' ));
  if (estat_modul("GestioDocumental")=="true"){add_submenu_page( 'gestio-menu', 'GestioCarpetes', 'GestioCarpetes', 'manage_options', 'gestio-menu-carpetes', 'crear_menu_carpetes');}
  if (estat_modul("GestioContrasenyes")=="true"){add_submenu_page( 'gestio-menu', 'GestioContrasenyes', 'GestioContrasenyes', 'manage_options', 'gestio-menu-contrasenyes', 'crear_menu_contrasenyes');}
  if (estat_modul("GestioCodi")=="true"){add_submenu_page( 'gestio-menu', 'GestioCodi', 'GestioCodi', 'manage_options', 'gestio-menu-codi', 'crear_menu_codi');}
  if (estat_modul("GestioBackups")=="true"){add_submenu_page( 'gestio-menu', 'GestioBackups', 'GestioBackups', 'manage_options', 'gestio-menu-backups', 'crear_menu_carpetes');}
}
add_action('admin_menu', 'crear_menu_pluguin');


function crear_menu_carpetes(){
  include 'views/vista_carpetes_gd.php';
}

function crear_menu_contrasenyes(){
  include 'views/vista_contrasenyes_gd.php';
}

function crear_menu_codi(){
    include 'views/vista_codi_gd.php';
}

function crear_menu_general(){
    include 'views/vista_parametres_gd.php';
}

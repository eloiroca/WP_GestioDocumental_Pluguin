<?php
    //Funcio que retornara un array dels clients

    function recuperarClients(){
        global $wpdb;
        $clients = $wpdb->get_results( "select * from gd_pluguin_clients");

        return $clients;
    }

    //Funcio que retornara les dades del client en questió

    function recuperarClient($id_client){
      global $wpdb;
      $client = $wpdb->get_results( "select * from gd_pluguin_clients where id =".$id_client);

      return $client;
    }

?>

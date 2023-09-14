<?php

  function info_ultima_copia($var){

    $carpetes_copies = "\\\\server2008\\Fitxers\\ELOI\\";
    $carpetes_copies_existents = array();
    print_r(scandir($carpetes_copies));
      /*$sortida ="";
      for ($i=0;$i<1;$i++){
        for ($j=1;$j<12;$j++){
            for ($k=1;$k<31;$k++){
                 $j = str_pad($j, 2, "0", STR_PAD_LEFT);
                 $k = str_pad($k, 2, "0", STR_PAD_LEFT);
                 $sortida = $carpetes_copies."CS ".$k.".".$j.".2019";

                 //echo $sortida."<br>";
                 if (file_exists ('\\\\server2008\\Fitxers\\ELOI\\CS 11.02.2019')){
                   echo "coincideix<br>";
                    $sortida = explode("\\", $sortida);
                    array_push($carpetes_copies_existents, end($sortida));
                 }
            }
        }
      }*/
      //print_r($carpetes_copies_existents);
      //echo end($carpetes_copies_existents);
  }
  add_action( 'wp_ajax_realitzar_backup_db', 'realitzar_backup_db' );
  function realitzar_backup_db(){
    //aa
    //MySQL server and database
    $dbhost = 'localhost:3307';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'gestiodocumentalbd';
    $tables = obtenirParametreTaulesDefecte();

    backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables);

  }
  //Core function
  function backup_tables($host, $user, $pass, $dbname, $tables = '*') {
      $link = mysqli_connect($host,$user,$pass, $dbname);

      // Check connection
      if (mysqli_connect_errno())
      {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit;
      }
      mysqli_query($link, "SET NAMES 'utf8'");

      //get all of the tables
      if($tables == '*')
      {
          $tables = array();
          $result = mysqli_query($link, 'SHOW TABLES');
          while($row = mysqli_fetch_row($result))
          {
              $tables[] = $row[0];
          }
      }
      else
      {
          $tables = is_array($tables) ? $tables : explode(',',$tables);
      }

      $return = '';
      //cycle through
      foreach($tables as $table)
      {
          $result = mysqli_query($link, 'SELECT * FROM '.$table);
          $num_fields = mysqli_num_fields($result);
          $num_rows = mysqli_num_rows($result);

          $return.= 'DROP TABLE IF EXISTS '.$table.';';
          $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
          $return.= "\n\n".$row2[1].";\n\n";
          $counter = 1;

          //Over tables
          for ($i = 0; $i < $num_fields; $i++)
          {   //Over rows
              while($row = mysqli_fetch_row($result))
              {
                  if($counter == 1){
                      $return.= 'INSERT INTO '.$table.' VALUES(';
                  } else{
                      $return.= '(';
                  }

                  //Over fields
                  for($j=0; $j<$num_fields; $j++)
                  {
                      $row[$j] = addslashes($row[$j]);
                      $row[$j] = str_replace("\n","\\n",$row[$j]);
                      if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                      if ($j<($num_fields-1)) { $return.= ','; }
                  }

                  if($num_rows == $counter){
                      $return.= ");\n";
                  } else{
                      $return.= "),\n";
                  }
                  ++$counter;
              }
          }
          $return.="\n\n\n";
      }

      //save file
      $hoy = getdate();
      $hoy['hours']=$hoy['hours']+1;
      $fileName = obtenirParametreTaulesDestiDefecte().'\db-backup-'.$hoy['mday'].'-'.$hoy['month'].'-'.$hoy['year'].' '.$hoy['hours'].'-'.$hoy['minutes'].'.sql';
      $handle = fopen($fileName,'w+');
      fwrite($handle,$return);
      if(fclose($handle)){
         echo true;
         exit;
      }
    }

    add_action( 'wp_ajax_guardarFitxerCodi_backup', 'guardarFitxerCodi_backup' );
    function guardarFitxerCodi_backup(){
        echo "string";
        $origen = obtenirParametreCodiOrigenBackupDefecte();
        $desti = obtenirParametreCodiDestiBackupDefecte().'\codi.php';

        echo $origen;
        echo $desti;
        if (!copy($origen, $desti)) {
            echo "Error al copiar $fichero...\n";
        }

    }
    function obtenirUltimaCopia($var){
      if ($var == 'sql') {
          $data = strtotime('+2 hour', strtotime(date("d F Y H:i:s",filemtime(obtenirParametreTaulesDestiDefecte()))));
          echo date("d F Y H:i:s", $data);
      }elseif ($var == 'codi') {
          $data = strtotime('+2 hour', strtotime(date("d F Y H:i:s",filemtime(obtenirParametreCodiDestiBackupDefecte().'\codi.php'))));
          echo date("d F Y H:i:s", $data);
      }

    }
?>

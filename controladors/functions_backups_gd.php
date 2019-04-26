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
?>

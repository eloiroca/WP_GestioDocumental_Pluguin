<?php
    $id = $_REQUEST['id'];
    $url = $_REQUEST['url'];

    $enlace = $url."\\".$id;

    $finfo = finfo_open(FILEINFO_MIME_TYPE); // devuelve el tipo mime de su extensión
    finfo_file($finfo, $enlace);
    $tipo = finfo_file($finfo, $enlace);
    finfo_close($finfo);
    header ("Content-Disposition: attachment; filename=".$id." ");
    header ("Content-Type: ".$tipo."");
    //header ("Content-Type: application/octet-stream");
    header ("Content-Length: ".filesize($enlace));
    readfile($enlace);
?>

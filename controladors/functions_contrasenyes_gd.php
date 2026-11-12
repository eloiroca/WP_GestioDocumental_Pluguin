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
                      <div class='col-md-2 td_assignacio_info domini_camp'>".$contrasenyes[$i]->descripcio."</div>
                      <div class='col-md-2 td_assignacio_info user_camp'>".$contrasenyes[$i]->usuari."</div>
                      <div class='col-md-2 td_assignacio_info user_camp contra'>".$contrasenyes[$i]->contrasenya."</div>
                      <div class='col-md-2 td_assignacio_info'><a class='href_contrasenya' href=".$contrasenyes[$i]->url." target='_blank'><img class='img_web' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-web.png' )."></a><img class='img_web href_dns' url='".$contrasenyes[$i]->url."' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-security.png' )."></div>
                      <div class='col-md-2 td_assignacio_info comentari_camp'>".$contrasenyes[$i]->comentari."</div>
                      <div class='col-md-1 td_assignacio_info'>
                          <button type='button' name='button' class='btn btn-warning btn_fitxers btn_modificarContrasenya' data_id=".$contrasenyes[$i]->id."><img class='imgOpcions_contra mida_contra' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-renombrar.png')."></button>
                          <button type='button' name='button' class='btn btn-danger btn_fitxers btn_eliminarContrasenya' data_id=".$contrasenyes[$i]->id."><img class='imgOpcions_contra mida_contra' src=".plugins_url( 'gestiodocumentalpluguin/assets/img/icono-eliminar.png')."></button>
                      </div>
                  </div>";
        }
        return $td;
    }
    //Funcio que retornara els tipus de contrasenya ja existents que tenim a la BD
    function obtenirTipusContrasenyaExistents(){
        global $wpdb;
        $tipusExistents = $wpdb->get_results( "SELECT tipo_contrasenya FROM ( SELECT id, tipo_contrasenya, descripcio, usuari, contrasenya, comentari, url, @rn := IF(@prev = tipo_contrasenya, @rn + 1, 1) AS rn, @prev := tipo_contrasenya FROM gd_pluguin_contrasenyes JOIN (SELECT @prev := NULL, @rn := 0) AS vars ORDER BY tipo_contrasenya DESC ) AS T1 WHERE rn <= 1" );
        return $tipusExistents;
    }
    //Funcio que retornara el numero de contrasenyes que tenim a la BD
    function obtenirContrasenyesTotals(){
        global $wpdb;
        $numContrasenyes = $wpdb->get_row( "select count(id) numIds from gd_pluguin_contrasenyes" );
        echo "Nº ".$numContrasenyes->numIds;
    }

    //Funcio que creara una contrasenya nova
    add_action( 'wp_ajax_crearContrasenya', 'crearContrasenya' );
    function crearContrasenya(){
        global $wpdb;
        $wpdb->get_results( "insert into gd_pluguin_contrasenyes (tipo_contrasenya, descripcio, usuari, contrasenya, url, comentari) values ('".$_POST['valorTipus']."','".$_POST['valorDescripcio']."','".$_POST['valorUsuari']."','".$_POST['valorContrasenya']."','".$_POST['valorUrl']."','".$_POST['valorComentari']."')" );
    }
    //Funcions per comprovar si la web es vulnerable a PHP2SHELL
    if (!defined('PHP2SHELL_VULNERABLE_THROUGH')) {
        define('PHP2SHELL_VULNERABLE_THROUGH', [
            '5.4' => 45, '5.5' => 38, '5.6' => 40,
            '7.0' => 33, '7.1' => 33, '7.2' => 34, '7.3' => 33, '7.4' => 33,
            '8.0' => 30, '8.1' => 34, '8.2' => 34, '8.3' => 35, '8.4' => 26, '8.5' => 11,
        ]);
    }

    if (!function_exists('php2shell_assess_version')) {
        function php2shell_assess_version(string $version): string
        {
            if (!preg_match('/^(\d+)\.(\d+)\.(\d+)([-+~].*)?$/', $version, $match)) return 'unknown';
            $branch = ((int)$match[1]) . '.' . ((int)$match[2]);
            $vulnerableThrough = PHP2SHELL_VULNERABLE_THROUGH;
            if (!array_key_exists($branch, $vulnerableThrough)) return 'unknown';
            if ((int)$match[3] <= $vulnerableThrough[$branch]) return 'vulnerable';
            if (!empty($match[4]) && preg_match('/(?:^|[-+~.])(?:dev|alpha|beta|rc)/i', $match[4])) return 'unknown';
            return 'ok';
        }
    }

    if (!function_exists('php2shell_is_public_address')) {
        function php2shell_is_public_address(string $ip): bool
        {
            return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
        }
    }

    if (!function_exists('php2shell_resolve_public_host')) {
        function php2shell_resolve_public_host(string $host): bool
        {
            if (filter_var($host, FILTER_VALIDATE_IP)) return php2shell_is_public_address($host);
            $records = @dns_get_record($host, DNS_A | DNS_AAAA);
            if (!$records) return false;
            $ips = [];
            foreach ($records as $record) {
                if (!empty($record['ip'])) $ips[] = $record['ip'];
                if (!empty($record['ipv6'])) $ips[] = $record['ipv6'];
            }
            return count($ips) > 0 && !in_array(false, array_map('php2shell_is_public_address', $ips), true);
        }
    }

    if (!function_exists('php2shell_check_website')) {
        function php2shell_check_website(string $input): array
        {
            $input = trim($input);
            if ($input === '' || preg_match('/[\x00-\x20\x7f]/', $input)) throw new RuntimeException('Introduce una URL válida, sin espacios.');
            if (!preg_match('~^https?://~i', $input)) $input = 'https://' . $input;
            $url = parse_url($input);
            if (!$url || empty($url['host']) || !in_array(strtolower($url['scheme'] ?? ''), ['http', 'https'], true)) {
                throw new RuntimeException('Usa una dirección válida que empiece por http:// o https://.');
            }
            if (isset($url['user']) || isset($url['pass']) || isset($url['fragment'])) throw new RuntimeException('No se admiten credenciales ni fragmentos en la URL.');
            $host = trim($url['host'], '[]');
            if (!php2shell_resolve_public_host($host)) throw new RuntimeException('No se pudo resolver el dominio público. Por seguridad, no se permiten direcciones locales o privadas.');

            $target = $input;
            $headers = [];
            $statusCode = null;
            foreach (['HEAD', 'GET'] as $method) {
                $context = stream_context_create(['http' => [
                    'method' => $method,
                    'timeout' => 10,
                    'ignore_errors' => true,
                    'follow_location' => 0,
                    'max_redirects' => 0,
                    'header' => "User-Agent: PHP Security Patch Checker/1.0\r\nConnection: close\r\n",
                ], 'ssl' => ['verify_peer' => true, 'verify_peer_name' => true]]);
                $response = @get_headers($target, true, $context);
                if ($response === false) throw new RuntimeException('No se pudo conectar con el sitio. Comprueba la URL y que el servidor esté accesible.');
                $statusLine = is_array($response) ? ($response[0] ?? '') : '';
                if (preg_match('/\s(\d{3})\b/', (string)$statusLine, $code)) $statusCode = (int)$code[1];
                $headers = is_array($response) ? $response : [];
                if (!in_array($statusCode, [405, 501], true) || $method === 'GET') break;
            }

            $advertised = [];
            foreach (['X-Powered-By', 'Server'] as $name) {
                $value = $headers[$name] ?? $headers[strtolower($name)] ?? null;
                foreach ((array)$value as $header) {
                    if (preg_match_all('/\bPHP[ \/]([^\s,;)]+)/i', (string)$header, $matches)) {
                        foreach ($matches[1] as $version) $advertised[] = $version;
                    }
                }
            }
            $version = null;
            $status = 'unknown';
            foreach ($advertised as $candidate) {
                $candidateStatus = php2shell_assess_version($candidate);
                if ($version === null || $candidateStatus === 'vulnerable' || $status === 'ok') {
                    $version = $candidate;
                    $status = $candidateStatus;
                }
                if ($status === 'vulnerable') break;
            }
            return ['status' => $status, 'version' => $version, 'http_code' => $statusCode];
        }
    }

    //Funcio que mirara si la URL es vulnerable a PHP2SHELL
    add_action( 'wp_ajax_preguntarDNS', 'comprovarPHP2Shell' );
    add_action( 'wp_ajax_comprovarPHP2Shell', 'comprovarPHP2Shell' );
    function comprovarPHP2Shell(){
      $domini = isset($_POST['valorUrl']) ? trim((string)$_POST['valorUrl']) : '';
      if ($domini === '' || $domini === '#'){
          echo json_encode([
              'ok' => false,
              'domain' => $domini,
              'error' => "No es pot consultar perque no hi ha URL d'aquesta contrasenya"
          ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
          wp_die();
      }

      try {
          $result = php2shell_check_website($domini);
          echo json_encode([
              'ok' => true,
              'domain' => $domini,
              'result' => $result
          ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
      } catch (Throwable $e) {
          echo json_encode([
              'ok' => false,
              'domain' => $domini,
              'error' => $e->getMessage()
          ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
      }
      wp_die();
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
    //Funcio que afegira una tasca
    add_action( 'wp_ajax_afegirTascaBD', 'afegirTasca' );
    function afegirTasca(){
        global $wpdb;
        $wpdb->get_results( "insert into gd_pluguin_notes (id, descripcio, hora, estat) values ('".$_POST['tascaID']."','".$_POST['tasca']."','".date("Y-m-d H:i:s")."','0')" );
    }

    //Funcio que obtindra les notes
    add_action( 'wp_ajax_obtenirNotes', 'obtenirNotes' );
    function obtenirNotes(){
        global $wpdb;
        $notes = $wpdb->get_results( "select * from gd_pluguin_notes where estat=0 " );

        for($i = 0; $i<count($notes); $i++){
          echo '<div class="tasca_programada" data_id="'.$notes[$i]->id.'">'.htmlspecialchars($notes[$i]->descripcio).'<input type="checkbox" class="check_completat"></div>';
        }
    }
    //Funcio que obtindra les notes pendents
    add_action( 'wp_ajax_obtenirNotesPendents', 'obtenirNotesPendents' );
    function obtenirNotesPendents(){
        global $wpdb;
        $notesPendents = $wpdb->get_results( "select count(id) numeronotes from gd_pluguin_notes where estat=0" );

        echo $notesPendents[0]->numeronotes;
    }
    //Funcio per completar una tasca
    add_action( 'wp_ajax_completarTascaBD', 'completarTascaBD' );
    function completarTascaBD(){
        global $wpdb;
        $wpdb->get_results( "update gd_pluguin_notes set estat = 1 where id = ".$_POST['notaID']);
    }
?>

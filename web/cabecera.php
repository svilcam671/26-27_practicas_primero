<?php 

error_reporting(0); //mostrar todos los errores

define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo
date_default_timezone_set('Europe/Madrid');

if (MODO_TRABAJO=="produccion")
    error_reporting(0);
    else 
        error_reporting(E_ALL);  

spl_autoload_register(function ($clase){
    $ruta=RUTABASE."/scripts/clases/";
    $fichero=$ruta."$clase.php";
    
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});

include(RUTABASE."/aplicacion/plantilla/plantilla.php");

//creo todos los objetos que necesita mi aplicación
include_once(dirname(__FILE__) . "/scripts/librerias/validacion.php");

// array donde se guardaran los puntos
$puntos = [
];

/**
 * Funcion para cargar los puntos que halla guardados en el fichero de puntos del navegador y ip del cliente que utiliza la aplicacion en el array de puntos
 * La funcion esta creada en cabecera para que se cargue de forma automatica al abrir una pagina de la aplicacion
 *
 * @param array $puntos recibe el array de puntos por referencia para poder modificarlo y añadir los puntos del archivo
 * @return bool devuelve false si no se ha podido leer el fichero o true si todo ha ido bien
 */
function cargarPuntos(array &$puntos):bool {

    // creo la ruta del fichero
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/ficheros/".nombreFichero();

    // compruebo que existe el fichero
    if (!file_exists($ruta)) {
        return false;
    }

    // abro el fichero para leerlo
    $fic = fopen($ruta, "r");

    // si no se ha abierto el fichero salgo
    if (!$fic) {
        return false;
    }

    // recorro el array de puntos quitando los puntos que hay actualmente
    foreach($puntos as $punto => $valor) {
        unset($puntos[$punto]);
    }

    // voy leyendo el fichero linea a linea
    while($linea=fgets($fic)) {

        // quito espacios y divido la linea en un array por el separador
        $linea=trim($linea);
        $datos=explode(";",$linea);

        // si tengo los 4 datos que forman el punto los guardo en una variable cada uno sin espacios y compruebo que sean datos validos
        if (count($datos) === 4) {

            $x = trim($datos[0]);
            $y = trim($datos[1]);
            $color = trim($datos[2]);
            $grosor = trim($datos[3]);
            if ((validaExpresion($x, "/^\d+$/", 0)) && (validaExpresion($y, "/^\d+$/", 0)) && (validaExpresion($grosor, "/^\d+$/", 0))) {

                try {
                    // creo el punto con los datos validos y lo guardo en el array
                    $punto = new Punto(intval($x), intval($y), $color, intval($grosor));
                    $puntos[] = $punto;
                }
                catch (Exception $e) {

                }

            }
        }
    }

    // cierto la lectura del fichero
    fclose($fic);
    return true;
}

/**
 * Funcion para obtener una cadena compuesta de la direccion ip del cliente y el nombre del navegador, sustituyendo los puntos por barras bajas.
 *
 * @return string devuelve una cadena con formato XX_XX_XX_XX_navegador
 */
function nombreNavegador(): string {
    $ip = $_SERVER["REMOTE_ADDR"];
    $ip = preg_replace('/\./', '_', $ip);

    $navegador = "otro";
    $agente = $_SERVER["HTTP_USER_AGENT"];

    if (stripos($agente, "firefox") !== false) {
        $navegador = "firefox";
    }
    else if (stripos($agente, "edg") !== false) {
        $navegador = "edge";
    }
    else if (stripos($agente, "opr") !== false) {
        $navegador = "opera";
    }
    else if (stripos($agente, "chrome") !== false) {
        $navegador = "chrome";
    }
    else if (stripos($agente, "safari") !== false) {
        $navegador = "safari";
    }

    return $ip."_".$navegador;
}

/**
 * Funcion que devuelve una cadena con el nombre del fichero, compuesta por el prefijo "puntos_", seguido de la cadena con la IP y navegador y terminado en ".dat"
 *
 * @return string devuelve una cadena con el nombre del fichero
 */
function nombreFichero(): string {
    return "puntos_".nombreNavegador().".dat";
}

// cargar el fichero al abrir una pagina de la app
cargarPuntos($puntos);
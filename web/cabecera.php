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

$puntos = [
];

function cargarPuntos(array &$puntos) {

    $ruta = $_SERVER["DOCUMENT_ROOT"]."/ficheros/".nombreFichero();

    if (!file_exists($ruta)) {
        return false;
    }

    $fic = fopen($ruta, "r");

    if (!$fic) {
        return false;
    }

    foreach($puntos as $punto => $valor) {
        unset($puntos[$punto]);
    }

    while($linea=fgets($fic)) {

        $linea=trim($linea);
        $datos=explode(";",$linea);

        if (count($datos) === 4) {

            $x = trim($datos[0]);
            $y = trim($datos[1]);
            $color = trim($datos[2]);
            $grosor = trim($datos[3]);
            if ((validaExpresion($x, "/^\d+$/", 0)) && (validaExpresion($y, "/^\d+$/", 0)) && (validaExpresion($grosor, "/^\d+$/", 0))) {

                try {
                    $punto = new Punto(intval($x), intval($y), $color, intval($grosor));
                    $puntos[] = $punto;
                }
                catch (Exception $e) {

                }

            }
        }
    }

    fclose($fic);
    return true;
}

function nombreNavegador() {
    $ip = $_SERVER["REMOTE_ADDR"];
    $ip = preg_replace('/[^A-Za-z0-9]/', '_', $ip);

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

function nombreFichero() {
    return "puntos_".nombreNavegador().".dat";
}

cargarPuntos($puntos);
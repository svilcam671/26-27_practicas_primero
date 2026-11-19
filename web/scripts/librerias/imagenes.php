<?php

function imagen(array $puntos): GdImage {

    $imagen = imagecreatetruecolor(500, 500);
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    imagefill($imagen, 0,0, $blanco);
    imagerectangle($imagen,0,0,499,499, $negro);

    return $imagen;

}

function nombreImagen(): string {

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

    return "imagen_".$ip."_".$navegador.".jpg";

}
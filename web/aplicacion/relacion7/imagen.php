<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");

header('Content-Type:'.'image/jpeg');
header('Content-Disposition: attachment; filename="'.nombreImagen().'"');

imagejpeg(crearImagen($puntos));


function crearImagen(array $puntos): GdImage {

    $imagen = imagecreatetruecolor(500, 500);
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    imagefill($imagen, 0,0, $blanco);
    imagerectangle($imagen,0,0,499,499, $negro);

    foreach ($puntos as $punto) {

        dibujarPunto($imagen, $punto);
    }

    return $imagen;

}

function nombreImagen(): string {

    return "imagen_".nombreNavegador().".jpg";

}

function dibujarPunto(GdImage $imagen, Punto $punto):void {

    $rgb = Punto::COLORES[$punto->getColor()]["rgb"];
    $color = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);
    $diametro = $punto->getGrosor()*5;

    imagefilledellipse($imagen, $punto->getX(), $punto->getY(), $diametro, $diametro, $color);

}

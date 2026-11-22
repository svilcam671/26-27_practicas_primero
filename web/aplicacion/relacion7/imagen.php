<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");

// cabecera para descargar la imagen 
header('Content-Type:'.'image/jpeg');
header('Content-Disposition: attachment; filename="'.nombreImagen().'"');

// creo la imagen
imagejpeg(crearImagen($puntos));

/**
 * Funcion para crear la imagen. Crea una imagen de 500x500 en color blanco con un borde negro.
 * Dibuja cada pounto que tengamos guardado en la imagen.
 *
 * @param array $puntos recibe el array con los puntos guardados
 * @return GdImage devuelve un objeto gd con la imagen creada
 */
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

/**
 * Funcion que devuelve una cadena con nombre de la imagen
 *
 * @return string devuelve una cadena con el nombre de la imagen, que consiste en el prefijo "imagen_" + la ip y navegador + ".jpg"
 */
function nombreImagen(): string {

    return "imagen_".nombreNavegador().".jpg";

}

/**
 * Funcion para dibujar un punto en una imagen. Obtiene el rgb guardado del punto para crear el color, el valor entero correspondiente al grosor seleccionado
 * y crea un circulo en las coordenadas del punto del color indicado
 *
 * @param GdImage $imagen recibe el objeto imagen
 * @param Punto $punto recibe el objeto punto con los datos
 * @return void
 */
function dibujarPunto(GdImage $imagen, Punto $punto):void {

    $rgb = Punto::COLORES[$punto->getColor()]["rgb"];
    $color = imagecolorallocate($imagen, $rgb[0], $rgb[1], $rgb[2]);
    $diametro = $punto->getGrosor()*5;

    imagefilledellipse($imagen, $punto->getX(), $punto->getY(), $diametro, $diametro, $color);

}

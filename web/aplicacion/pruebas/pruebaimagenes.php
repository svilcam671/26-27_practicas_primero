<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Prueba imagenes",
    ],
];
//$usuario = getenv("MYSQL_USER");

$nombreFichero= RUTABASE."/imagenes/pruebaimagen.jpg";
$crear = false;

if ($crear) {

    $imagen = imagecreatetruecolor(250,250);

    // genero el color azul
    $azul = imagecolorallocate($imagen, 0,0,255);
    
    //rellena un rectangulo
    imagefilledrectangle($imagen, 10, 10, 240, 240, $azul);

    //dibujo una linea blanca
    $blanco = imagecolorallocate($imagen, 255,255,255);
    imagefilledrectangle($imagen, 100, 100, 100, 10, $blanco);

    imagejpeg($imagen, $nombreFichero);

}

if (isset($_GET["descargar"])) {
    $imagen=imagecreatefromjpeg($nombreFichero);
    $color = imagecolorallocate($imagen, 255,255,255);
    imagestring($imagen,2,10,150,"marca agua",$color);
    header('Content-Disposition:attachment;filename="imagen.jpg"');
    imagejpeg($imagen);
    exit;
}

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("cargar página", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {
    
}

//vista
function cuerpo(){
?>


    <img src="/imagenes/pruebaimagen.jpg" alt="imagen">
    <a href="?descargar">descargar</a>


<?php   
}

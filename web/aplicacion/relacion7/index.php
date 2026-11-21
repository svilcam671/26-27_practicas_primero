<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE"=> "/index.php",
        "ADICIONAL" => " >> "
        ],
        [
        "TEXTO"=> "Indice R7",
        "ADICIONAL" => " >> "
    ],
];

$datos = [
    "x" => 0,
    "y" => 0,
    "color" => "",
    "grosor" => 0

];


$errores = [];
$volveracrear = false;
cargarPuntos($puntos);


$enviado = isset($_POST["guardar"]);

if ($enviado) {

    $datos["x"] = isset($_POST["x"])?trim($_POST["x"]):"";

    if (validaExpresion($datos["x"], '/^\d+$/', "0")) {
        $numeroX = intval($datos["x"]);
        $validaX = validaEntero($numeroX,0,500,0);
    }
    else {
        $validaX = false;
    }

    if (!$validaX) {
        $errores["x"] = "* El valor de X debe estar entre 0 y 500";
    }

    $datos["y"] = isset($_POST["y"])?trim($_POST["y"]):"";

    if (validaExpresion($datos["y"], '/^\d+$/', "0")) {
        $numeroY = intval($datos["y"]);
        $validaY = validaEntero($numeroY,0,500,0);
    }
    else {
        $validaY = false;
    }

    if (!$validaY) {
        $errores["y"] = "* El valor de Y debe estar entre 0 y 500";
    }

    $datos["color"] = isset($_POST["color"])?trim($_POST["color"]):"";

    if (!validaRango($datos["color"], Punto::COLORES, 2)) {
        $errores["color"] = "* Se debe indicar un color valido";
    }

    $datos["grosor"] = isset($_POST["grosor"])?trim($_POST["grosor"]):"";

    if (!validaRango($datos["grosor"], Punto::GROSORES, 2)) {
        $errores["grosor"] = "* Se debe indicar un grosor valido";
    }


    if (count($errores) === 0) {
        try {
            $puntos[] = new Punto(intval($datos["x"]), intval($datos["y"]), $datos["color"], intval($datos["grosor"]));
            $volveracrear = true;
        }
        catch (Exception $e) {
            $errores["error"] = $e->getMessage();
        }
    }
}

if ($volveracrear || !file_exists(ruta())) {
    guardarImagen($puntos);
    guardarPuntos($puntos);
} 

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 7", $barra);
cuerpo($datos, $errores, $puntos); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $datos, array $errores, array $puntos){
?>
    <h2>Crear punto</h2>

    <?php formulario($datos, $errores); ?>

    <h2>TextArea con los puntos</h2>

    <?php textArea($puntos); ?>

    <h2>Imagen</h2>

    <img src="/imagenes/puntos/<?php echo nombreImagen() ?>" alt="Imagen">


<?php
}

function formulario(array $datos, array $errores) {
?>
    
    <form action="index.php" method="post">

        <label for="x">Punto X</label>
        <input type="text" name="x" id="x" value="<?php echo $datos["x"] ?>">
        <?php if (isset($errores["x"])) {

            echo '<span class="error">'.$errores["x"].'</span>';

        }             
        ?>
        <br>
        <label for="y">Punto Y</label>
        <input type="text" name="y" id="y" value="<?php echo $datos["y"] ?>">
        <?php if (isset($errores["y"])) {

            echo '<span class="error">'.$errores["y"].'</span>';

        }             
        ?>
        <br><br>
        <select name="color" id="color">

            <?php

                foreach(Punto::COLORES as $clave => $valor) {
                    ?> <option value="<?php echo $clave ?>" <?php echo ($clave === $datos["color"])?"selected":"" ?>><?php echo $valor["nombre"] ?></option> <?php
                }

        ?> </select>
        <?php if (isset($errores["color"])) {

            echo '<span class="error">'.$errores["color"].'</span>';

        }             
        ?>
        <br><br>
        <?php
                foreach(Punto::GROSORES as $clave => $valor) {
                    ?>  
                        <input type="radio" name="grosor" id="<?php echo $valor ?>" value="<?php echo $clave ?>" <?php echo ($clave == $datos["grosor"])?"checked":"" ?>>
                        <label for="<?php echo $valor ?>"><?php echo $valor ?></label>
                    
                    <?php
                }
            
            ?>
        <?php if (isset($errores["grosor"])) {

            echo '<span class="error">'.$errores["grosor"].'</span>';

        }             
        ?>
        
        <br><br>
        <input type="submit" name="guardar" value="Guardar">
        <?php if (isset($errores["error"])) {

            echo '<span class="error">'.$errores["error"].'</span>';

        }             
        ?>

    </form>
  
<?php
}

function textArea(array $puntos) {  
?>
        
    <textarea name="puntos" id="puntos" rows="10" cols="40"><?php foreach($puntos as $punto) {echo $punto."\n"; }?></textarea>

<?php
}

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

function ruta():string {

    return $_SERVER["DOCUMENT_ROOT"]."/imagenes/puntos/".nombreImagen();
}

function guardarImagen(array $puntos): bool {

    $carpeta = $_SERVER["DOCUMENT_ROOT"]."/imagenes/puntos";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }

    $correcto = imagejpeg(crearImagen($puntos), ruta());

    return $correcto;
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

function guardarPuntos(array $puntos) {

    $ruta = $_SERVER["DOCUMENT_ROOT"]."/ficheros";
    
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }

    $ruta.="/".nombreFichero();
    $fic = fopen($ruta, "w");

    if (!$fic) {
        return false;
    }

    foreach($puntos as $punto) {
        fputs($fic,$punto."\n");
    }

    fclose($fic);

    return true;
}

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
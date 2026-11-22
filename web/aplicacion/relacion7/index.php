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

$enviado = isset($_POST["guardar"]);
$eliminar = isset($_POST["eliminar"]);
$subir = isset($_POST["subir"]);

if ($enviado) {

    $datos["x"] = isset($_POST["x"])?trim($_POST["x"]):"";

    $valorX = $datos["x"];
    if (validaExpresion($valorX, '/^\d+$/', "0")) {
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

    $valorY = $datos["y"];
    if (validaExpresion($valorY, '/^\d+$/', "0")) {
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

if ($eliminar) {
    $borrar = isset($_POST["borrar"])?trim($_POST["borrar"]):"";

    if (validaExpresion($borrar, '/^\d+$/', "") && validaRango($borrar, $puntos, 2)) {
        unset($puntos[$borrar]);
        $volveracrear = true;
    }
    else {
        $errores["borrar"] = "* Punto elegido para borrar no valido.";
    }
}

if ($subir) {

    if (!isset($_FILES["archivo"]) || $_FILES["archivo"]["error"] !== 0) {
        $errores["subir"] = "* Archivo seleccionado no valido";
    }
    else {

        $arrayNombreArchivo = explode(".", $_FILES["archivo"]["name"]);
        $extension = $arrayNombreArchivo[count($arrayNombreArchivo)-1];

        if (mb_strtolower($extension) !== "txt") {

            $errores["subir"] = "* La extension debe ser txt";
        }
        else {

            $arrayArchivo = file($_FILES["archivo"]["tmp_name"]);

            foreach ($arrayArchivo as $linea) {

                $linea = trim($linea);

                $partes=explode(";",$linea);

                if (count($partes) === 4) {

                    $x = trim($partes[0]);
                    $y = trim($partes[1]);
                    $color = trim($partes[2]);
                    $grosor = trim($partes[3]);
                    if ((validaExpresion($x, "/^\d+$/", 0)) && (validaExpresion($y, "/^\d+$/", 0)) && (validaExpresion($grosor, "/^\d+$/", 0))) {

                        if ((validaEntero($x, 0, 500, 0)) && (validaEntero($y, 0, 500, 0))) {

                            try {
                                $punto = new Punto(intval($x), intval($y), $color, intval($grosor));
                                $puntos[] = $punto;
                                $volveracrear = true;
                            }
                            catch (Exception $e) {

                            }

                        }

                    }
                }

            }

        }

    }

}

if ($volveracrear || !file_exists(ruta())) {
    guardarImagen($puntos);
    guardarPuntos($puntos);
}

if ($eliminar && !isset($errores["borrar"])) {
    header("Location: index.php");
    exit;
}

if ($subir && !isset($errores["subir"])) {
    header("Location: index.php");
    exit;
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

    <h2>Borrar puntos</h2>

    <?php  
        if (count($puntos) > 0) {
            formularioBorrar($puntos, $errores);
        }
        else {
            ?><p>No hay puntos para borrar</p><?php
        }
    
    ?>

    <h2>Descargar imagen</h2>
    <a href="imagen.php">Descargar</a>

    <h2>Subir fichero</h2>
    <?php formularioSubir($errores) ?>
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

function formularioBorrar(array $puntos, array $errores) {
?>    
    <form action="index.php" method="post">
        <select name="borrar" id="borrar">
            <?php  

                foreach($puntos as $clave => $valor) {

                    ?> 
                        <option value="<?php echo $clave ?>"><?php echo $valor ?></option>
                    
                    <?php

                }
            ?>
        </select>
        <input type="submit" name="eliminar" value="Borrar">
    </form>

    <?php if (isset($errores["borrar"])) {

            echo '<span class="error">'.$errores["borrar"].'</span>';

        }             
    ?>
    
<?php
}

function formularioSubir(array $errores) {
?>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo" id="archivo">
        <br><br>
        <input type="submit" name="subir" value="Subir archivo">
    </form>

    <br>
    <?php  
        if (isset($errores["subir"])) {

            echo '<span class="error">'.$errores["subir"].'</span>';

        } 
    ?>

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
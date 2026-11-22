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

// array asociativo para los datos del punto que llegan del formulario
$datos = [
    "x" => 0,
    "y" => 0,
    "color" => "",
    "grosor" => 0

];

// array asociativo donde guardo los errores
$errores = [];

// variable de control para guardar los puntos y imagen
$volveracrear = false;

// recupero el envio de los formularios
$enviado = isset($_POST["guardar"]);
$eliminar = isset($_POST["eliminar"]);
$subir = isset($_POST["subir"]);

// si se ha mandado el formulario de crear un punto compruebo cada dato y si no es correcto guardo un error
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


    // si no hay errores creo un nuevo punto y lo guardo en el array de puntos. Pongo la variable de control a true
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

// si se ha mandado el formulario de borrar compruebo que se ha mandado un punto para borrar valido, si lo es lo borro del array de puntos y pongo la 
// variable de control a true para volver a guardar los puntos y la imagen. Si no guardo un error
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

// si se ha mandado el formulario de subir compruebo que se ha mandado un archivo correcto, si no guardao un error.
if ($subir) {

    if (!isset($_FILES["archivo"]) || $_FILES["archivo"]["error"] !== 0) {
        $errores["subir"] = "* Archivo seleccionado no valido";
    }
    else {

        // saco un array con el nombre del archivo partiendolo por los "." que tenga. 
        $arrayNombreArchivo = explode(".", $_FILES["archivo"]["name"]);

        // me quedo con la ultima posicion que sera la extension
        $extension = $arrayNombreArchivo[count($arrayNombreArchivo)-1];

        // compruebo que sea txt, si no lo es guardo un error
        if (mb_strtolower($extension) !== "txt") {

            $errores["subir"] = "* La extension debe ser txt";
        }
        else {

            // guardo un array con las lineas del archivo
            $arrayArchivo = file($_FILES["archivo"]["tmp_name"]);

            // recorro el array de las lineas
            foreach ($arrayArchivo as $linea) {

                // le quito los espacios y la divido en partes para sacar los valores
                $linea = trim($linea);
                $partes=explode(";",$linea);

                // si hay 4 partes guardo cada valor y compruebo que sean correctos
                if (count($partes) === 4) {

                    $x = trim($partes[0]);
                    $y = trim($partes[1]);
                    $color = trim($partes[2]);
                    $grosor = trim($partes[3]);
                    if ((validaExpresion($x, "/^\d+$/", 0)) && (validaExpresion($y, "/^\d+$/", 0)) && (validaExpresion($grosor, "/^\d+$/", 0))) {

                        if ((validaEntero($x, 0, 500, 0)) && (validaEntero($y, 0, 500, 0))) {

                            // si es correcto creo un nuevo punto, lo agrego al array de puntos y pongo la variable de control a true
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

// si la variable de control esta en true o no existe la imagen vuelvo a crear la imagen y el archivo con los puntos
if ($volveracrear || !file_exists(ruta())) {
    guardarImagen($puntos);
    guardarPuntos($puntos);
}

// si se ha mandado el formulario de crear punto y no hay errores vuelvo a recargar la pagina (evito el problema de que si recargo manual despues de 
// agregar un punto se vuelve a crear el mismo punto repetido cada vez)
if ($enviado && count($errores) === 0) {
    header("Location: index.php");
    exit;
}

// si se ha mandado el formulario de borrar un punto y no hay errores vuelvo a recargar la pagina
if ($eliminar && !isset($errores["borrar"])) {
    header("Location: index.php");
    exit;
}

// si se ha mandado el formulario de subir archivo y no hay errores vuelvo a recargar la pagina
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
    <!-- muestro el formulario de crear puntos -->
    <h2>Crear punto</h2>
    
    <?php formulario($datos, $errores); ?>

    <!-- Muestro el textarea con los puntos del array -->
    <h2>TextArea con los puntos</h2>

    <?php textArea($puntos); ?>

    <!-- muestro la imagen con los puntos que tenemos guardados dibujados -->
    <h2>Imagen</h2>

    <img src="/imagenes/puntos/<?php echo nombreImagen() ?>" alt="Imagen">

    <!-- muestro el formulario de borrar puntos en caso de que tengamos puntos en el array, si no muestro un texto diciendo que no hay puntos -->
    <h2>Borrar puntos</h2>

    <?php  
        if (count($puntos) > 0) {
            formularioBorrar($puntos, $errores);
        }
        else {
            ?><p>No hay puntos para borrar</p><?php
        }
    
    ?>

    <!-- muestro el enlace para descargar la imagen llamando a imagen.php -->
    <h2>Descargar imagen</h2>
    <a href="imagen.php">Descargar</a>

    <!-- muestro el formulario para subir un archivo txt con puntos -->
    <h2>Subir fichero</h2>
    <?php formularioSubir($errores) ?>
<?php
}

/**
 * Funcion para crear el formulario de los puntos y mandar los datos recogidos.
 * En caso de fallo se muestra un error al lado del campo y se mantienen los datos validos.
 *
 * @param array $datos recibe el array con los datos guardados
 * @param array $errores recibe el array con los errores guardados
 * @return void
 */
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

/**
 * Funcion para crear el textarea con los puntos que tenemos en el array
 *
 * @param array $puntos recibe el array de puntos con los puntos guardados
 * @return void
 */
function textArea(array $puntos) {  
?>     
    <textarea name="puntos" id="puntos" rows="10" cols="40"><?php foreach($puntos as $punto) {echo $punto."\n"; }?></textarea>
<?php
}

/**
 * Funcion para crear el formulario de borrar un punto. Tiene un select que se rellena automaticamente con los puntos que tengamos en el array.
 * En caso de fallo muestra un error.
 *
 * @param array $puntos recibe el array con los puntos guardados
 * @param array $errores recibe el array con los errores
 * @return void
 */
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

/**
 * Funcion para crear el formulario de subir un fichero txt con puntos. Muestra un error en caso de fallo
 *
 * @param array $errores recibe el array con los errores
 * @return void
 */
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

/**
 * Funcion que devuelve una cadena con la ruta de la imagen
 *
 * @return string devuelve una cadena con la ruta de la imagen
 */
function ruta():string {

    return $_SERVER["DOCUMENT_ROOT"]."/imagenes/puntos/".nombreImagen();
}

/**
 * Funcion que comprueba que existe el directorio donde se guardan las imagenes con los puntos, si no existe lo crea.
 * Llama a la funcion para crear la imagen y la guarda en la ruta
 *
 * @param array $puntos recibe el array con los puntos
 * @return void
 */
function guardarImagen(array $puntos): void {

    $carpeta = $_SERVER["DOCUMENT_ROOT"]."/imagenes/puntos";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }

    imagejpeg(crearImagen($puntos), ruta());
}

/**
 * Funcion para guardar en un fichero los puntos del array.
 *
 * @param array $puntos recibe el array con los puntos guardados
 * @return void
 */
function guardarPuntos(array $puntos) {

    // creo la ruta
    $ruta = $_SERVER["DOCUMENT_ROOT"]."/ficheros";
    
    // si no existe el directorio lo creo
    if (!file_exists($ruta)) {
        mkdir($ruta);
    }

    // actualizo la ruta para que apunte al fichero de los datos de los puntos
    $ruta.="/".nombreFichero();

    // abro el flujo para escribir los datos
    $fic = fopen($ruta, "w");

    // si no se puede abrir devuelvo false
    if (!$fic) {
        return false;
    }

    // recorro el array de puntos y coloca cada uno en una linea del fichero
    foreach($puntos as $punto) {
        fputs($fic, $punto."\n");
    }

    // cierro el flujo
    fclose($fic);

    return true;
}
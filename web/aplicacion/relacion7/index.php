<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/imagenes.php");
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
        }
        catch (Exception $e) {
            $errores["error"] = $e->getMessage();
        }
    }
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

    <h2>Text area con los puntos</h2>

    <?php textArea($puntos); ?>
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
        
    <textarea name="puntos" id="puntos" rows="10" cols="40"><?php foreach($puntos as $clave) {echo $clave."\n"; }?></textarea>

<?php
}

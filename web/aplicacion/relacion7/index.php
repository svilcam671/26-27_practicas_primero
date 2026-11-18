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

$enviado = isset($_POST["enviar"]);

if ($enviado) {

    $datos["x"] = isset($_POST["x"])?trim($_POST["x"]):"";

    if (!validaEntero($datos["x"], 0, 500, 0)) {
        $errores["x"] = "* El valor de X debe estar entre 0 y 500";
    }

    $datos["y"] = isset($_POST["y"])?trim($_POST["y"]):"";

    if (!validaEntero($datos["y"], 0, 500, 0)) {
        $errores["y"] = "* El valor de X debe estar entre 0 y 500";
    }

    $datos["color"] = isset($_POST["color"])?trim($_POST["color"]):"";

    if (!validaRango($datos["color"], Punto::COLORES, 2)) {
        $errores["color"] = "* Se debe indicar un color valido";
    }

    $datos["grosor"] = isset($_POST["grosor"])?trim($_POST["grosor"]):"";
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 5", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo()
{
?>

<?php
}


function formulario() {
?>
    
    <form action="index.php" method="post">

        <label for="x">Punto X</label>

    </form>
  
<?php
}

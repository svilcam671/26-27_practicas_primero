<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE"=> "/index.php",
        "ADICIONAL" => " >> "
        ],
        [
        "TEXTO"=> "Indice R5",
        "ADICIONAL" => " >> "
    ],
];


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

    <h1><a href="./pruebas.php">Pruebas de las validaciones</a></h1>
    <h2>Relación 5</h2>

    <?php

        
        try {

         
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }

    ?>


<?php
}

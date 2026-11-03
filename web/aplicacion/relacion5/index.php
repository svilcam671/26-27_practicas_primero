<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/val_normal.php");
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
   <h2>Prueba Ejercicio 1</h2>
    <?php

        try {

            $numero = 5;
            echo "El número $numero esta dentro del rango 1 a 10?: ";
            echo \VALNORMAL\validaEntero($numero, 1, 10, 8)?"True":"False";
            $numero = 11;
            echo "<br>El número $numero esta dentro del rango 1 a 10?: ";
            echo \VALNORMAL\validaEntero($numero, 1, 10, 8)?"True":"False";
            echo "<br>Nuevo valor: $numero";
         
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }

    ?>

    <h2>Prueba Ejercicio 2</h2>
    <?php

    ?>

<?php
}

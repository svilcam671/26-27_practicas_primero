<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/libreria.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE"=> "/index.php",
        "ADICIONAL" => " >> "
        ],
        [
        "TEXTO"=> "Indice R3",
        "ADICIONAL" => " >> "
    ],
];

// ejercicio 1
$array = array();
$numero = 0;



//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 3", $barra);
cuerpo($array, $numero); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $array, int $numero)
{
?>
   <h2>Prueba Ejercicio 1</h2>

    <?php

        // llamo a la funcion dentro de un if y si me devuelve true muestro que todo ha ido bien y los elementos del array
        if (cuentaVeces($array, "1pos", 1, $numero)) {
            echo "TRUE -> todo ha ido bien<br>";
            print_r($array);
            echo "<br>";
        }
        else {
            echo "FALSE -> se ha detectado un error<br>";
        }

        // muestro el numero de llamadas
        echo "Llamada numero: $numero <br>";

        // llamo a la funcion dentro de un if y si me devuelve true muestro que todo ha ido bien y los elementos del array
        if (cuentaVeces($array, "2daw", 2, $numero)) {
            echo "TRUE -> todo ha ido bien<br>";
            print_r($array);
            echo "<br>";
        }
        else {
            echo "FALSE -> se ha detectado un error<br>";
        }

        // muestro el numero de llamadas
        echo "Llamada numero: $numero <br>";

        // llamo a la funcion dentro de un if y si me devuelve true muestro que todo ha ido bien y los elementos del array
        if (cuentaVeces($array, "otra", 3, $numero)) {
            echo "TRUE -> todo ha ido bien<br>";
            print_r($array);
            echo "<br>";
        }
        else {
            echo "FALSE -> se ha detectado un error<br>";
        }
        
        // muestro el numero de llamadas
        echo "Llamada numero: $numero <br>";

    ?>

<?php
}

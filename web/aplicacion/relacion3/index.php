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

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 3", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo()
{
// ejercicio 1
$array = array();
$numero = 0;
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

    <h2>Prueba Ejercicio 2</h2>
    <?php
    $cadenaBien = generarCadena();
        if ($cadenaBien) {
            echo "La cadena se ha generado correctamente: $cadenaBien";
        }
        else {
            echo "FALSE -> Ha habido algun problema";
        }

    echo "<br>";

    $cadenaMal = generarCadena(0);
        if ($cadenaMal) {
            echo "La cadena se ha generado correctamente: $cadenaMal";
        }
        else {
            echo "FALSE -> Ha habido algun problema";
        }

    ?>

    <h2>Prueba Ejercicio 3</h2>
    <?php
    
    echo "Prueba Suma (Operando 1) para los numeros 3,4,5,6,7 = ".operaciones(1,3,4,5,6,7);
    echo "<br>Prueba Resta (Operando 2) para los numeros 100,5,6,7,34 = ".operaciones(2,100,5,6,7,34);
    echo "<br>Prueba Multiplicacion (Operando 3) para los numeros 4,2,3,5,2 = ".operaciones(3,4,2,3,5,2);
    echo "<br>Prueba resta de la suma de los pares con los impares (Operando diferente) para los numeros 3,4,5,6,7,8 = ".operaciones(5,3,4,5,6,7,8);
    
    ?>

    <h2>Prueba Ejercicio 4</h2>
    <?php
    
    $valor = 5;
    echo "Los tres parametros: ".devuelve($valor,6,7)." y valor del primer parametro: $valor";
    echo "<br>Primer parametro unicamente: ".devuelve($valor)." y valor del primer parametro: $valor";
    echo "<br>Primer y segundo parametro: ".devuelve($valor,8)." y valor del primer parametro: $valor";
    echo "<br>Primer y ultimo parametro: ".devuelve($valor, num3: 8)." y valor del primer parametro: $valor";
    ?>

    <h2>Prueba Ejercicio 5</h2>
    <?php
    
    $res = hacerOperacion("dividir",7,6);

    if ($res === false) {
        echo "Error: False";
    }
    echo "<br>Suma: ".hacerOperacion("suma",7,6);
    echo "<br>Resta: ".hacerOperacion("resta",7,6);
    echo "<br>Multiplicacion: ".hacerOperacion("multiplicacion",7,6);

    ?>

<?php
}

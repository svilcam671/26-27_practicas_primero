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
        "TEXTO"=> "Indice R2",
        "ENLACE" => "/aplicacion/relacion2/index.php",
        "ADICIONAL" => " >> "
    ],
    [
        "TEXTO"=> "Ejercicio2",
        "ADICIONAL" => " >> "
    ],
];
//datos

inicioCabecera("Ejercicio 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2  cadena 'Está la niña en casa'", $barra );
cuerpo();
finCuerpo();
// *******************************************

//vista
function cabecera() {

}

//vista
function cuerpo() {

$cadena = "Está la niña en casa";
$cadBytes = strlen($cadena);
$cadMB = mb_strlen($cadena, "UTF-8");

?>
    <!-- Mostrar cada carácter en una línea separada y con tantos espacios en blanco como me indica la posición del carácter mostrado-->
    <h2>Mostrar cada carácter en una línea separada</h2>
    <pre>
    <?php 
        
        // prueba [] que no funciona
        /*for ($i = 0; $i < $cadBytes; $i++) {
            echo str_repeat(" ",$i).$cadena[$i]."\n";
        }*/

        // prueba substr que no funciona
        /*for ($i = 0; $i < $cadBytes; $i++) {
            echo str_repeat(" ",$i).substr($cadena, $i, 1)."\n";
        }*/
        
        for ($i = 0; $i < $cadMB; $i++) {
            echo str_repeat(" ",$i).mb_substr($cadena, $i, 1,"UTF-8")."\n";
        }
    ?>
    </pre>

    <h2>Mostrar la cadena en orden inverso</h2>
    <pre>
    <?php

        // hay que empezar el bucle en 1 para el indice negativo
        for ($i = 1; $i <= $cadMB; $i++) {
            
            // indice negativo como pide el enunciado para leer la cadena al reves
            $caracter = mb_substr($cadena, -$i, 1, "UTF-8");

            // averiguamos si es par o impar
            if (($i - 1) % 2 == 0) {
                $c = mb_strtoupper($caracter, "UTF-8");
            }
            else {
                $c = mb_strtolower($caracter, "UTF-8");
            }

            // pintamos los espacios y el caracter
            echo str_repeat(" ",$i-1).$c."\n";

        }
    ?>
    </pre>

<?php
}
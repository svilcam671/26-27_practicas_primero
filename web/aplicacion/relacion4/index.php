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
        "TEXTO"=> "Indice R4",
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
?>
   <h2>Prueba Ejercicio 1</h2>

    <?php


    ?>

    <h2>Prueba Ejercicio 2</h2>
    <?php



    ?>

    <h2>Prueba Ejercicio 3</h2>
    <?php

    
    ?>

    <h2>Prueba Ejercicio 4</h2>
    <?php
  
    ?>

    <h2>Prueba Ejercicio 5</h2>
    <?php
   

    ?>

    <h2>Prueba Ejercicio 6</h2>
    <?php
    

    ?>

    <h2>Prueba Ejercicio 7</h2>
    <?php
  


    ?>

<?php
}

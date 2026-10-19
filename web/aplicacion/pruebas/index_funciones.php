<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/mis_funciones.php");

//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE"=> "/index.php",
        "ADICIONAL" => " >> "
        ],
        [
        "TEXTO"=> "pruebas",
        "ENLACE"=> "/aplicacion/pruebas/index.php",
        "ADICIONAL" => " >> "
    ],
    [
        "TEXTO"=> "Indice funciones",
        "ADICIONAL" => " >> "
    ],
];

$numero = doble(25);
// comprobacion 
if ($numero === false) {
    // hay un error lo resuelvo
    $numero = 25;
}

if ($numero = doble($numero)) {
    //exit;
}

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION PRUEBA FUNCIONES", $barra);
cuerpo($numero); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(int $n)
{

    echo "El doble del numero es $n".PHP_EOL;
    echo "el numero $n es el doble de otro".PHP_EOL;

}

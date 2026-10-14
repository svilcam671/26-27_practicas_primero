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

?>
    <!-- Mostrar cada carácter en una línea separada y con tantos espacios en blanco como me indica la posición del carácter mostrado-->
    <h2>Mostrar cada carácter en una línea separada</h2>
    
<?php
}
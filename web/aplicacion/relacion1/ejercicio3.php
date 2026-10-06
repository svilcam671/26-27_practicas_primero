<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//datos
//- Hacer lo anterior creando y rellenando el array usando varias sentencias. 
// a) Crear una variable de tipo array.
$array = [];

// b) Rellenar las posiciones 1, 16, 54 con valores cualquiera
$array[1] = mt_rand(1,100);
$array[16] = mt_rand(1,100);
$array[54] = mt_rand(1,100);

// c) Añadir el valor 34 al final
array_push($array,34);

//d) Añadir los valores “cadena”, true, 1.345 en las posiciones “uno”, “dos” y “tres”
$array["uno"] = "cadena";
$array["dos"] = true;
$array["tres"] = 1.345;

//e) Rellenar la posición “ultima” con el array (1,34,”nueva”);
$array["ultima"] = array(1,34,"nueva");

//- Hacer lo anterior usando una sola sentencia con array;
$array2 = array(
    1 => mt_rand(1,100),
    16 => mt_rand(1,100),
    54 => mt_rand(1,100),
    55 => 34,
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => array(1,34,"nueva")
);

//- Hacer lo anterior usando una sola sentencia con []
$array3 = [
    1 => mt_rand(1,100),
    16 => mt_rand(1,100),
    54 => mt_rand(1,100),
    55 => 34,
    "uno" => "cadena",
    "dos" => true,
    "tres" => 1.345,
    "ultima" => [1,34,"nueva"]
];

inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3 Array");
cuerpo($array, $array2, $array3);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo(array $array,array $array2,array $array3) {
?>

    <h2>Primer array con diferentes sentencias</h2>
    <?php

        foreach ($array as $elem => $valor) {
            if (is_array($valor)) {
                
                foreach ($valor as $a) {
                echo $a."<br>";
                }

            }
            echo $elem."<br>";
        }
        
    ?>

    <h2>Segundo array con una sola sentencia</h2>
    <?php

        foreach ($array2 as $elem => $valor) {
            if (is_array($valor)) {
                
                foreach ($valor as $a) {
                echo $a."<br>";
                }

            }
            echo $elem."<br>";
        }
        
    ?>

    <h2>Tercer array con una sola sentencia con []</h2>
    <?php

        foreach ($array3 as $elem => $valor) {
            if (is_array($valor)) {
                
                foreach ($valor as $a) {
                echo $a."<br>";
                }

            }
            echo $elem."<br>";
        }
        
    ?>

<?php
}
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//datos
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

inicioCabecera("Ejercicio 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3 Array");
cuerpo($array);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo(array $array) {
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

    <h2>Segundo array con una sola sentencia<h2>

<?php
}
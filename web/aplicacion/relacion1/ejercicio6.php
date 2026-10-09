<?php

use function PHPSTORM_META\type;

include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$vector=array("primera" =>12.56, 24=>true, 67 =>23.76);

//datos

inicioCabecera("Ejercicio 6");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 6 uso de foreach con diferentes funciones");
cuerpo($vector);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo($vector) {

?>
    <h1>Simular el funcionamiento de foreach ($array as $indice => $valor) usando las funciones de recorrido </h1>
    
    <?php

        while(key($vector)!=null) {
            echo "Clave: ".key($vector)." con valor: ";

            if (current($vector) == "boolean") {
                echo (current($vector)?"true":"false")."<br>";
            }
            else {
                echo current($vector)."<br>";
            }
            
            next($vector);
        }
    ?>

    <h1>Simular el funcionamiento de foreach usando las funciones array_keys y array_values para mostrar tanto los índices como los valores del array anterior.</h1>
    
    <?php

        $claves = array_keys($vector);
        $valores = array_values($vector);

        for ($i = 0; $i < count($claves); $i++) {
            echo "Clave: ".$claves[$i]." con valor: ";

            if ($valores[$i] == "boolean") {
                echo ($valores[$i]?"true":"false")."<br>";
            }
            else {
                echo $valores[$i]."<br>";
            }
        }
    ?>

<?php
}
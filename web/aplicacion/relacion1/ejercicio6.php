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

        foreach ($vector as $indice => $valor) {

        };

    ?>

<?php
}
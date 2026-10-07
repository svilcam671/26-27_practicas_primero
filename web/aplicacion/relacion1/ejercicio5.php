<?php

use function PHPSTORM_META\type;

include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$vector=array();
$vector[1]="esto es una cadena";
$vector["posi1"]=25.67;
$vector[]=false;
$vector["ultima"]=array(2,5,96);
$vector[56]=23;

//datos

inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4 Array con bucles for");
cuerpo($vector);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo(array $vector) {

    for ($i = 0; $i<count($vector);$i++) {

        echo "Posicion ".$i." contenido: ";

        if (gettype($vector[$i]) == []) {

            foreach($vector[$i] as $elem) {

                echo $elem.", ";
            }
        }
        else if (gettype($vector[$i]) == "integer") {
            
            echo "Entero con valor ".intval($vector[$i]).", en binario ".decbin($vector[$i]);
        }
        else if (gettype($vector[$i]) == "integer") {
            
            echo "Entero con valor ".intval($vector[$i]).", en binario ".decbin($vector[$i]);
        }
    }


?>

    

<?php
}
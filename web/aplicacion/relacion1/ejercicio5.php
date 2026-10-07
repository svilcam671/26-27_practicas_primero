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

    foreach ($vector as $pos => $valor) {
        
        $tipo = gettype($valor);

        echo "posicion ".$pos." contenido ($tipo) ";
        
        if ($tipo == "array") {
            echo "<br>";
            foreach ($valor as $elem) {
                echo "- ".$elem."<br>";
            }
        }
        else if ($tipo == "integer") {
            echo "Entero con valor ".$valor. ", en binario ".decbin($valor)."<br>";

        }
        else if ($tipo == "double") {
            echo $valor." que al cuadrado es ".pow($valor,2)."<br>";
        }
        else if ($tipo == "string") {
            echo "-".$valor."-<br>";
        }
        else if ($tipo == "boolean") {
            $val = $valor?"true":"false";
            $opuesto = !$valor?"true":"false";
            echo $val." y su opuesto ".$opuesto."<br>";
        }

    }


?>

    

<?php
}
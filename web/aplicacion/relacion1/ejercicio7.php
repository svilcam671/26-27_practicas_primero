<?php

use function PHPSTORM_META\type;

include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$dias = array(
    "Monday" => "Lunes",
    "Tuesday" => "Martes",
    "Wednesday" => "Miercoles",
    "Thursday" => "Jueves",
    "Friday" => "Viernes",
    "Saturday" => "Sabado",
    "Sunday" => "Domingo"
);

//datos

inicioCabecera("Ejercicio 7");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 7 Mostrar el funcionamiento de las fechas");
cuerpo($dias);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo($dias) {

?>
    <h2>Fechas con Date</h2>
    <?php
    echo "Fecha actual en el formato “d/m/Y”: ".date("d/m/Y")."<br>";
    //echo "fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”".strftime("%A, %d de %B de %Y");
    echo "Fecha actual en el formato “dia d, mes mmmm, año yyyy, dia de la semana dd”: dia ".date("d").", mes ".date("m").", año ".date("Y").", dia de la semana ".$dias[date("l")]."<br>";
    echo "Hora actual en el formato “hh:mm:ss”: ".date("H:i:s")."<br>";
    echo "Tres apartados anteriores para la fecha 29/3/2024 a 12:45: "

    ?>

<?php
}
<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//datos
const FILAS = 5;
$arrayFor = [];
$arrayconst = [];

inicioCabecera("Ejercicio 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4 Array con bucles for");
cuerpo($arrayFor, $arrayconst);
finCuerpo();
// *******************************************

//vista
function cabecera() {

}



//vista
function cuerpo(array $arrayFor, array $arrayconst) {
?>

    <h2>Generar array y mostrarlo con foreach</h2>
    <?php
        for ($i = 1; $i <= 5; $i++) {
           
            $fila = [];
            for ($j = 1; $j <= $i; $j++) {

                $fila[] = $i;

            }
            $arrayFor[]=$fila;

        }

        foreach ($arrayFor as $elem) {
            if (is_array($elem)) {
                
                foreach ($elem as $n) {
                echo $n;
                }

            }
            echo "<br>";
        }

    ?>
    
    <h2>Generar array y mostrarlo con foreach con constante FILAS</h2>
    <?php
        for ($i = 1; $i <= FILAS; $i++) {
           
            $fila = [];
            for ($j = 1; $j <= $i; $j++) {

                $fila[] = $i;

            }
            $arrayconst[]=$fila;

        }

        foreach ($arrayconst as $elem) {
            if (is_array($elem)) {
                
                foreach ($elem as $n) {
                echo $n;
                }

            }
            echo "<br>";
        }

    ?>

<?php
}
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
        "TEXTO"=> "Indice R4",
        "ADICIONAL" => " >> "
    ],
];

// Ejercicio 1
//$violin = new InstrumentoBase("Instrumento de cuerda",5);
//$piano = new InstrumentoBase("Instrumento que consiste en un teclado",12);
$viento = new InstrumentoViento("plastico",2);

// Ejercicio 4
$arrayFlauta1 = [
    "material" => "madera",
    "edad" => "7"
];

$arrayFlauta2 = [
    "material" => "madera",
];
$arrayFlauta3 = [];

$flauta1 = Flauta::CrearDesdeArray($arrayFlauta1);
$flauta2 = Flauta::CrearDesdeArray($arrayFlauta2);
$flauta3 = Flauta::CrearDesdeArray($arrayFlauta3);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 4", $barra);
cuerpo($viento, $flauta1, $flauta2, $flauta3); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(InstrumentoViento $viento, Flauta $flauta1, Flauta $flauta2, Flauta $flauta3)
{
?>
   <h2>Prueba Ejercicio 1</h2>
    <?php

        /*try {

            echo "Violin: $violin";
            echo "<br> Piano: $piano";
            echo "<br> Flauta: $viento";

            $flauta->envejecer();

            echo "<br> Flauta: $viento";

            $violin->hola;
            
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }*/

        echo "Pruebas hechas pero comentadas al ser una clase abstracta.";

    ?>

    <h2>Prueba Ejercicio 2</h2>
    <?php

        echo "Definida la interfaz IFabricable, se implementara y probara en ejercicios posteriores."

    ?>

    <h2>Prueba Ejercicio 3</h2>
    <?php

        try {

            echo "Instrumento: $viento";

            $viento->envejecer();

            echo "<br> Instrumento: $viento";

            echo "<br>".$viento->sonido();
            echo "<br>".$viento->afinar();
            
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }
    
    ?>

    <h2>Prueba Ejercicio 4</h2>
    <?php
  
        try {

            echo "Flauta1: $flauta1";
            echo "<br> Flauta2: $flauta2";
            echo "<br> Flauta3: $flauta3";

            echo "<br>".$flauta1->metodoFabricacion();
            echo "<br>".$flauta1->metodoReciclado();

            $flauta1->envejecer();
            $flautaClone = clone $flauta1;

            echo "<br> Flauta Clonada: $flautaClone";
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }

    ?>

    <h2>Prueba Ejercicio 5</h2>
    <?php
   

    ?>

    <h2>Prueba Ejercicio 6</h2>
    <?php
    

    ?>

    <h2>Prueba Ejercicio 7</h2>
    <?php
  


    ?>

<?php
}

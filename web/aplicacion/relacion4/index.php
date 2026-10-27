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
$violin = new InstrumentoBase("Instrumento de cuerda",5);
$piano = new InstrumentoBase("Instrumento que consiste en un teclado",12);
$flauta = new InstrumentoBase("Instrumento de viento que permite tocar notas soplando", 2);

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 3", $barra);
cuerpo($violin, $piano, $flauta); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo($violin, $piano, $flauta)
{
?>
   <h2>Prueba Ejercicio 1</h2>
    <?php

        try {

            echo "Violin: $violin";
            echo "<br> Piano: $piano";
            echo "<br> Flauta: $flauta";

            $flauta->envejecer();

            echo "<br> Flauta: $flauta";

            $violin->hola;
            
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: $e</strong>";
        }

    ?>

    <h2>Prueba Ejercicio 2</h2>
    <?php



    ?>

    <h2>Prueba Ejercicio 3</h2>
    <?php

    
    ?>

    <h2>Prueba Ejercicio 4</h2>
    <?php
  
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

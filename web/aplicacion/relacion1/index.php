<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>
    Ejercicios Relacion 1
    <br><br>
    <a href="./ejercicio1.php">Ejercicio 1</a>
    <br><br>
    <a href="./ejercicio2.php">Ejercicio 2</a>
    <br><br>
    <a href="./ejercicio3.php">Ejercicio 3</a>
    <br><br>
    <a href="./ejercicio4.php">Ejercicio 4</a>
    <br><br>
    <a href="">Ejercicio 5</a>
    <br><br>
    <a href="">Ejercicio 6</a>
    <br><br>
    <a href="">Ejercicio 7</a>

<?php
}

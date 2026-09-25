<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas basicas");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

//vista
function cuerpo()
{
?>
    <br><br>Esto es html
    <a href="../aplicacion/pruebas/index.php">a</a>
    <?php
        echo "asasdasd";
    ?>

<?php
}

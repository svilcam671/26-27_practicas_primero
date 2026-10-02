<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

//$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("Mi Aplicacion");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{

    ?>
    <!-- Esto va en el head -->
    <?php

}

//vista
function cuerpo()
{
?>
    <br><br>
    Hola, estás en Index.php
    Modificacion
    <a href="../aplicacion/pruebas/index.php">a</a>
<?php
}

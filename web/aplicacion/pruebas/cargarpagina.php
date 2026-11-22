<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "pruebas",
        "ENLACE" => "/aplicacion/pruebas/cargarpagina.php",
    ],
    [
        "TEXTO" => "cargar pagina",
    ]
];
//$usuario = getenv("MYSQL_USER");

$datos = [];
//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("cargar página", $barra);
cuerpo($datos);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo(array $datos)
{
    $id = 15;
    if(isset($_REQUEST["id"])){
        $id=intval($_REQUEST["id"]);
    }

    //Compruebo que el id es correcto
    $datos["id"] = $id;
    $nombre = "";
        if(isset($_REQUEST["nombre"])){
        $id=mb_trim(($_REQUEST["nombre"]));
    }

    //valido nombre
    $datos["nombre"] = $nombre;
?>  
    <br><br>
    <h2>Primera forma: enlace</h2>
    <a href="<?="otrapagina.php?id=$id&nombre='vicente'"?>">Enlace a otra página</a>
    <br><br>
    <form method="GET" action="otrapagina.php?id=<?= $id+5 ?>">
        <input type="hidden" name="id" value="<?= $id ?>">

        <select name="id">
            <option value="1">Primero</option>
            <option value="2">Segundo</option>
            <option value="3">Tercero</option>
        </select>
        <label>nombre:</label>
        <input type="text" name="nombre">
        <br><br>
        <input type="submit" name="enviar" value="Enviar">
        <input type="submit" name="borrado" value="E1">
        <input type="submit" name="insertar" value="E3">
        
    </form>

<?php

   
}

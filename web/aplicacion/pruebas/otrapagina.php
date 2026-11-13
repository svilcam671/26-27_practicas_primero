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
        "ENLACE" => "/aplicacion/pruebas/index.php",
    ],
    [
        "TEXTO" => "otra página",
    ]
];
//$usuario = getenv("MYSQL_USER");

$datos = [];

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("otra página", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo()
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
    <h1>Esta es la página cargada</h1>
    
<?php
    echo "se ha recibido un id {$datos['id']} y nombre {$datos['nombre']}";
}

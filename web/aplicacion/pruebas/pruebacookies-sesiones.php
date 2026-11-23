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
        "TEXTO" => "Cookies",
    ]
];
//$usuario = getenv("MYSQL_USER");

//setcookie("numero", mt_rand(1,100), time()+60*60*24*2);
$valor = 0;
//$valor = $_COOKIE["numero"];

session_start();

//$_SESSION["nombre"] = "Sergio";

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("Cookies", $barra);
cuerpo($valor);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo(int $valor){
?>  

    <br><br>
    
<?php
    echo "Leido la cookie con valor $valor";

}

<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/validacion.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE"=> "/index.php",
        "ADICIONAL" => " >> "
        ],
        [
        "TEXTO"=> "Indice R5",
        "ADICIONAL" => " >> "
    ],
];

$datos = [
    "nombre" => "",
    "contrasenia" => "",
    "fechaNacimiento" => "",
    "carnetDia" => "",
    "carnetMes" => "",
    "carnetAnio" => "",
    "hora" => "",
    "estado" => 0,
    "estudios" => 0,
    "hermanos" => 0,
    "sueldo" => 0

];
$errores = [];
$enviado = isset($_POST["enviar"]);

if ($enviado) {

    // recuperar nombre del formulario, si es valido quitar los espacios y convertir a mayusculas, si no, guardamos cadena vacia
    $datos["nombre"] = isset($_POST["nombre"])?trim($_POST["nombre"]):"";
    $datos["nombre"] = mb_strtoupper($datos["nombre"]);

    // validar nombre que sea menor de 25 caracteres y qe no empiece por H.
    if (!validaCadena($datos["nombre"], 25, "")) {
        $errores["nombre"] = "* El nombre no puede tener más de 25 caracteres.";
    }
    else if (!validaExpresion($datos["nombre"], "/^[^H]/", "")) {
        $errores["nombre"] = "* El nombre no puede estar vacío ni empezar por 'H'.";
    }

    // recuperar contraseña del formulario
    $datos["contrasenia"] = isset($_POST["contrasenia"])?$_POST["contrasenia"]:"";

    // validar la contraseña con la expresion regular que se pide
    if (!validaExpresion($datos["contrasenia"], '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$_\-;<>@])[A-Za-z\d$_\-;<>@]{8,15}$/', "")) {
        $errores["contrasenia"] = "* La contraseña debe ser entre 8 y 15 caracteres e incluir al menos una mayuscula, una minuscula, una cifra y un caracter especial (\$_-;<>@).";
    }

    // recuperar fecha de nacimiento del formulario
    $datos["fechaNacimiento"] = isset($_POST["fechaNacimiento"])?trim($_POST["fechaNacimiento"]):"";

    // validar que la fecha sea correcta
    if (!validaFecha($datos["fechaNacimiento"], "")) {
        $errores["fechaNacimiento"] = "* Se debe introducir una fecha de nacimiento válida y con formato DD/MM/AAAA";
    }

    // recuperar los datos de la fecha (dia, mes, año) del formulario
    $datos["carnetDia"] = isset($_POST["carnetDia"])?trim($_POST["carnetDia"]):"";
    $datos["carnetMes"] = isset($_POST["carnetMes"])?trim($_POST["carnetMes"]):"";
    $datos["carnetAnio"] = isset($_POST["carnetAnio"])?trim($_POST["carnetAnio"]):"";

    // creo la cadena con los 3 datos
    $fechaCarnet = $datos["carnetDia"]."/". $datos["carnetMes"]."/".$datos["carnetAnio"];

    // valido que sea correcta
    if (validaFecha($fechaCarnet, "")) {
        $partes = explode("/", $fechaCarnet);
        $datos["carnetDia"] = $partes[0];
        $datos["carnetMes"] = $partes[1];
        $datos["carnetAnio"] = $partes[2];
    }
    else {
        $errores["fechaCarnet"] = "* La fecha del carnet no es válida.";
        $datos["carnetDia"] = "";
        $datos["carnetMes"] = "";
        $datos["carnetAnio"] = "";
    }

}


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION RELACION 5", $barra);
cuerpo($datos, $errores); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $datos, array $errores)
{
?>

    <h1><a href="./pruebas.php">Pruebas de las validaciones</a></h1>
    <h2>Relación 5</h2>

    <?php

        
        try {
            
            formulario($datos, $errores);
        }
        catch (Exception $e) {
            echo "<br><strong>ERROR: ".$e->getMessage()."</strong>";
        }

    ?>


<?php
}

function formulario(array $datos, array $errores) {
?>

    <form action="index.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datos["nombre"];?>">
        <br>
        <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia" id="contrasenia" value="<?php echo $datos["contrasenia"];?>">
        <br>
        <label for="fechaNacimiento">Fecha de nacimiento:</label>
        <input type="text" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $datos["fechaNacimiento"];?>" placeholder="dd/mm/aaaa">
        <br>
        <label for="carnetDia">Fecha de carnet:</label>
        <input type="text" name="carnetDia" id="carnetDia" value="<?php echo $datos["carnetDia"];?>" size="2" placeholder="dd">
        <input type="text" name="carnetMes" id="carnetMes" value="<?php echo $datos["carnetMes"];?>" size="2" placeholder="mm">
        <input type="text" name="carnetAnio" id="carnetAnio" value="<?php echo $datos["carnetAnio"];?>" size="4" placeholder="aaaa">
        <br>

        <input type="submit" name="enviar" value="Enviar">
        <br>

        <?php

            if (isset($errores["nombre"])) {
                echo $errores["nombre"]."<br>";
            }

            if (isset($errores["contrasenia"])) {
                echo $errores["contrasenia"]."<br>";
            }

            if (isset($errores["fechaNacimiento"])) {
                echo $errores["fechaNacimiento"]."<br>";
            }

            if (isset($errores["fechaCarnet"])) {
                echo $errores["fechaCarnet"]."<br>";
            }

        ?>
    </form>
<?php
}

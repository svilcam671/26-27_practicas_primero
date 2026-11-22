<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//$usuario = getenv("MYSQL_USER");

//datos básicos

$datos = [
    ["nombre", "vicente", 16],
    ["noemi", "ordenador", 1234, 12],
];

if (!escribirAichero("datos.txt", $datos)) {
    paginaError("No se han podido guardar los datos");
    exit;
}

$datos[] = ["c2daw"];

if (!leerDeFichero("datos.txt", $datos)) {
    paginaError("No se han podido guardar los datos");
    exit;
}

//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION PRUEBA FICHEROS");
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera()
{
?>
    <!--Esto es un comentario HTML-->
<?php
    //Esto va en el head y es un comentario de PHP
}

//vista
function cuerpo()
{
?>


    <!-- El tipo de codificación de datos, enctype, se DEBE especificar como
a continuación-->
    <form enctype="multipart/form-data" action="__URL__" method="POST">
        <!--MAX_FILE_SIZE debe preceder al campo de entrada de archivo-->
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <!-- El nombre del elemento de entrada determina el nombre en el array
$_FILES -->
        Enviar este archivo:
        <input name="archivo"type="file" />
        <input type="submit" value="Enviar fichero" />
    </form>


<?php
}

/**
 * funcion para escribir en un fichero
 * @param string $nombre nombre del fichero
 * @param mixed $datos valores
 * @return bool devuelve si ejecuta correctamente o hay algún error
 */
function escribirAichero(string $nombre, array $datos): bool
{
    //ruta en la que se guardará el fichero
    $ruta = RUTABASE . "/ficheros/";
    //si no existe la ruta se crea
    if (!file_exists($ruta))
        mkdir($ruta);
    $ruta .= $nombre;

    if (!isset($datos)) {
        return false;
    }
    //se abre el fichero para escritura
    //si existe se borra el contenido
    $fic = fopen($ruta, "w");
    if (!$fic)
        return false;
    //se recorre el array con los datos
    foreach ($datos as $fila) {
        $linea = "";
        foreach ($fila as $columna) {
            $linea .= $columna . ",";
        }
        $linea .= "\r\n";
        //se escribe en el fichero una linea
        fputs($fic, $linea);
    }
    //se cierra el fichero
    fclose($fic);
    return true;
}

/**
 * funcion para leer de un fichero
 * @paramstring $nombre nombre del fichero
 * @parammixed $datos valores
 * @returnbool devuelve si ejecuta correctamente o hay algún error
 */
function leerDeFichero(string $nombre, array &$datos): bool
{
    //ruta en la que se guardará el fichero
    $ruta = RUTABASE . "/ficheros/";
    //si no existe la ruta se crea
    if (!file_exists($ruta))
        mkdir($ruta);
    $ruta .= $nombre;
    //se abre el fichero para lectura
    //debe existir
    $fic = fopen($ruta, "r");
    if (!$fic)
        return false;
    //borro el contenido del array
    foreach ($datos as $pos => $valor) {
        unset($datos[$pos]);
    }
    //leo el fichero linea a linea
    while ($linea = fgets($fic)) {
        $linea = str_replace("\r", "", $linea);
        $linea = str_replace("\n", "", $linea);
        if ($linea != "") {
            $linea = explode(",", $linea);
            $datos[] = $linea;
        }
    }
    //se cierra el fichero
    fclose($fic);
    return true;
}

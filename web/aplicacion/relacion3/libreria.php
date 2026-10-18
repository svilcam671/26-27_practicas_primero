<?php

/**
 * Función que recibe un array, una cadena, un numero y un contador. Añade al array en la posicion indicada en la cadena el número. Cada vez que se llame a la función se devuelve en el contador el numero de llamada actual.
 *
 * @param array $array El array que llega como parametro donde se añadira el numero en la posicion indicada
 * @param string $cadena La cadena que indica la posicion del array donde ira el primer numero
 * @param integer $num1 El numero que se asignara a la posicion indicada por la cadena en el array
 * @param integer $num2 Variable donde se devolvera el numero de la llamada actual
 * @return boolean Devuelve true si se ha añadido de forma correcta, en caso de que no se cumplan las condiciones devuelve false
 */
function cuentaVeces(array &$array, string $cadena, int $num1, int &$num2): bool {

    // variable static que mantiene el valor
    static $cont = 0;
    $cont++;
    
    // Aunque la llamada sea invalida actualizo el contador de llamadas 
    $num2 = $cont;

    if ($cadena === "2daw" || $cadena === "primera" || $cadena === "") {
        return false;
    }

    $array[$cadena] = $num1;


    return true;

}


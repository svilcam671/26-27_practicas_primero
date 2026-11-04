<?php
namespace VALNORMAL;

/**
 * 
 * Funcion para validar que un numero entero pasado como variable por referencia sea correcto o no. Es correcto si esta comprendido entre los valores minimo y maximo indicados, en cuyo caso se devolvera true.
 * En caso contrario se devolvera false y se asignara como valor a la variable el valor por defecto que llega a la funcion.
 * @param int $var variable pasada por referencia que contiene un numero con el que comprobaremos si es correcto, en caso contrario se reasignara con el valor por defecto
 * @param int $min valor minimo del rango para comprobar si el numero que contiene la variable pasada por referencia es correcto o no
 * @param int $max valor maximo del rango para comprobar si el numero que contiene la variable pasada por referencia es correcto o no
 * @param int $defecto valor por defecto que tomara la variable pasada por referencia en caso de que no cumpla la condicion de estar en el rango entre el valor minimo y maximo
 * @return bool devuelve true si el valor numerico de la variable pasada por referencia esta comprendido dentro del rango del minimo y maximo y false en caso contrario
 */
function validaEntero(int &$var, int $min, int $max, int $defecto): bool {

    $correcto = false;
    
    if ($var >= $min && $var <= $max) {
        $correcto = true;
    }
    else {
        $var = $defecto;

    }
    return $correcto;
}

/**
 * 
 * Funcion para validar que un numero real pasado como variable por referencia sea correcto o no. Es correcto si esta comprendido entre los valores minimo y maximo indicados, en cuyo caso se devolvera true.
 * En caso contrario se devolvera false y se asignara como valor a la variable el valor por defecto que llega a la funcion.
 * @param float $var variable pasada por referencia que contiene un numero con el que comprobaremos si es correcto, en caso contrario se reasignara con el valor por defecto
 * @param float $min valor minimo del rango para comprobar si el numero que contiene la variable pasada por referencia es correcto o no
 * @param float $max valor maximo del rango para comprobar si el numero que contiene la variable pasada por referencia es correcto o no
 * @param float $defecto valor por defecto que tomara la variable pasada por referencia en caso de que no cumpla la condicion de estar en el rango entre el valor minimo y maximo
 * @return bool devuelve true si el valor numerico de la variable pasada por referencia esta comprendido dentro del rango del minimo y maximo y false en caso contrario
 */
function validaReal(float &$var, float $min, float $max, float $defecto):bool {

    $correcto = false;
    
    if ($var >= $min && $var <= $max) {
        $correcto = true;
    }
    else {
        $var = $defecto;

    }
    return $correcto;

}

/**
 * Funcion para validar una fecha. Se comprobara que la fecha indicada cumpla un patron con una expresion regular y ademas comprobara que, aunque l fecha
 * cumpla el formato, sea una fecha valida. En caso de que sea correcto se devuelve valor true y se sanea la fecha para que tenga un el formato correcto.
 * En caso contrario se devuelve el valor por defecto y false.
 * @param string $var Se recibe la fecha que se va a validar y sanear en una variable pasada por referencia
 * @param string $defecto En caso de que no sea una fecha valida se le asigna el valor por defecto
 * @return bool Se devuelve true si la fecha es valida, en caso contario se devuelve false
 */
function validaFecha(string &$var, string $defecto):bool {
    
    $correcto = false;

    if ((preg_match("/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/", $var, $matches) === 1) && (checkdate(intval($matches[2]), intval($matches[1]), intval($matches[3])))) {

        $correcto = true;
            
        $var = sprintf("%02d/%02d/%04d", $matches[1], $matches[2], $matches[3]);
    
    }
    else {
        $var = $defecto;
    }

    return $correcto;
}

/**
 * Funcion para validar una hora en formato HH:mm:ss mediante una expresion regular. En caso de ser una hora valida se devuelve saneada en la variable pasada por referencia y un true.
 * En caso contrario se devuelve una hora por defecto en la variable y false.
 * @param string $var Hora guardada en una variable pasada por referencia
 * @param string $defecto Hora por defecto en caso de que la hora dada no sea correcta
 * @return bool se devuelve true si la hora dada es valida, en caso contrario se devolvera false
 */
function validaHora(string &$var, string $defecto):bool { 

    $correcto = false;

    if (preg_match("/^([01]?\d|2[0-3]):([0-5]?\d):([0-5]?\d)$/", $var, $matches) === 1) {

        $correcto = true;
            
        $var = sprintf("%02d:%02d:%02d", $matches[1], $matches[2], $matches[3]);
    
    }
    else {
        $var = $defecto;
    }

    return $correcto;
}
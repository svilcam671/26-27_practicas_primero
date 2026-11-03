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
    
    $var = $defecto;
    return $correcto;
    
}
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

/**
 * Funcion que puede recibir por parametro un numero entero positivo y genera una cadena de caracteres aleatoria. Los caracteres validos que compondran
 * la cadena son mayusculas, minusculas y numeros.
 *
 * @param integer|null $num Puede recibir un numero para indicar la longitud de la cadena o si no se indica tendrá valor por defecto 10.
 * @return string|false Si todo va bien devuelve una cadena de la longitud indicada. En caso de indicar 0 o un numero negativo devuelve false.
 */
function generarCadena(?int $num = 10): string|false {

    if ($num <= 0) {
        return false;
    }

    $caracteresValidos = array_merge(range('A','Z'),range('a','z'),range("0","9"));
    $cadena = "";

    for ($i = 0; $i < $num; $i++) {
            $cadena .= $caracteresValidos[mt_rand(0,count($caracteresValidos)-1)];
    }

    return $cadena;
}

/**
 * Funcion que recibe al menos tres parametros. El primero indica el tipo de operacion mientras que el resto son los operandos.
 * 1. Suma de todos los operandos
 * 2. Al primer operado se le resta el resto de operandos
 * 3. Multiplicacion de todos los operandos
 * Cualquier otro valor sumas las posiciones pares e impares y las resta
 *
 * @param integer $numOp Indica el tipo de operacion
 * @param integer $num1 primer operando
 * @param integer $num2 segundo operando
 * @param integer ...$resto resto de operandos si los hay
 * @return integer Devuelve el resultado de la operacion
 */
function operaciones(int $numOp, int $num1, int $num2, int ...$resto): int {

    $resultado = 0;

    // Si el operando es 1 hago la suma
    if ($numOp === 1) {

        // sumo los dos operandos fijos primero
        $resultado += $num1+$num2;

        // recorro el resto de parametros y se los sumo al resultado
        foreach($resto as $n) {
            $resultado += $n;
        }
    }
    // Si el operando es 2 hago la resta
    else if ($numOp === 2) {

        // primero resto el operando 2 al operando 1
        $resultado = $num1-$num2;

        // recorro el array y voy restando el resto de operandos
        foreach($resto as $n) {
            $resultado -= $n;
        }
    }
    // Si el operando es 3 hago la multiplicacion
    else if ($numOp === 3) {

        // multiplico los 2 operandos indicados
        $resultado = $num1*$num2;

        // recorro el array y voy multiplicando
        foreach($resto as $n) {
            $resultado = $resultado*$n;
        }
    }
    else {

        // variable para sumar pares, impares y un contador
        $pares = $num2;
        $impares = $num1;
        $cont = 1;

        // recorro el array y voy sumando pares e impares
        foreach($resto as $n) {
            
            if ($cont%2==0) {
                $pares+=$n;
            }
            else {
                $impares+=$n;
            }
            $cont++;
        }

        // resto a los pares los impares
        $resultado = $pares-$impares;

    }

    return $resultado;


}
<?php
include_once(RUTABASE . "/scripts/librerias/validacion.php");
/**
 * Clase punto para crear puntos
 */
class Punto {

    /**
     * Constante publica con colores 
     */
    const COLORES = [
        "black" => ["nombre" => "negro", "rgb" => [0,0,0]],
        "red" => ["nombre" => "rojo", "rgb" => [255,0,0]],
        "green" => ["nombre" => "verde", "rgb" => [0,255,0]],
        "blue" => ["nombre" => "azul", "rgb" => [0,0,255]],
        "yellow" => ["nombre" => "amarillo", "rgb" => [255,255,0]],
        "purple" => ["nombre" => "morado", "rgb" => [157,0,255]],
    ];

    /**
     * Constate publica con el grosor
     */
    const GROSORES = [
        1 => "fino",
        2 => "medio",
        3 => "grueso"
    ];

    // propiedades privadas de clase
    private int $_x;
    private int $_y;
    private string $_color;
    private int $_grosor;

    /**
     * Constructor de punto al que le llegan como parametro la coordenada X, la Y, el color y el grosor del punto.
     * Comprueba mediante el uso de los setters que sean valores validos, de lo contrario lanza una excepcion.
     *
     * @param integer $x entero con el valor de la coordenada X
     * @param integer $y entero con el valor de la coordenada Y
     * @param string $color cadena con el nombre del color
     * @param integer $grosor entero con el valor del grosor
     */
    public function __construct(int $x, int $y, string $color, int $grosor){

        if (!$this->setX($x)) {
            throw new Exception("Se debe indicar un entero entre 0 y 20000");
        }

        if (!$this->setY($y)) {
            throw new Exception("Se debe indicar un entero entre 0 y 20000");
        }

        if (!$this->setColor($color)) {
            throw new Exception("Se debe indicar un color valido");
        }

        if (!$this->setGrosor($grosor)) {
            throw new Exception("Se debe indicar un grosor valido");
        }
        
    }

    /**
     * Redefinicion de toString para sacar una cadena con formato "x ; y ; color ; grosor"
     * Se usara para escribir en el fichero el punto
     *
     * @return string devuelve una cadena con el formato "x ; y ; color ; grosor"
     */
    public function __toString(): string{
        
        return $this->getX()." ; ".$this->getY()." ; ".$this->getColor()." ; ".$this->getGrosor();
    }


    // metodos getter y setter
	public function getX() : int {
		return $this->_x;
	}

	public function setX(int $value):bool {

        $correcto = false;
        if (validaEntero($value, 0, 20000, 0)) {
            $this->_x = $value;
            $correcto = true;
        }

        return $correcto;
	}

	public function getY() : int {
		return $this->_y;
	}

	public function setY(int $value):bool {
		$correcto = false;
        if (validaEntero($value, 0, 20000, 0)) {
            $this->_y = $value;
            $correcto = true;
        }

        return $correcto;
	}

	public function getColor() : string {
		return $this->_color;
	}

	public function setColor(string $value):bool {
		$correcto = false;

        if (validaRango($value, self::COLORES, 2)) {
            $this->_color = $value;
            $correcto = true;
        }

        return $correcto;
	}

	public function getGrosor() : int {
		return $this->_grosor;
	}

	public function setGrosor(int $value):bool {
		$correcto = false;

        if (validaRango($value, self::GROSORES, 2)) {
            $this->_grosor = $value;
            $correcto = true;
        }

        return $correcto;
	}


    /**
     * Metodo magico get que es llamado de forma automatica cuando se quiere obtener informacion sobre una variable, exista o no, del objeto. 
     * La redefinimos para que su uso quede deshabilitado devolviendo un error.
     * @param string $name
     * @return mixed
     */
    public function __get(string $name):mixed {
        throw new Exception("No existe la propiedad $name");
    }

    /**
     * Metodo magico set que es llamado de forma automatica cuando se quiere asignar valor a una variable de la clase exista o no.
     * La redefinimos para que su uso quede deshabilitado devolviendo un error.
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, mixed $value):void {
        throw new Exception("No existe la propiedad $name por lo que no se puede asignar el valor");
    }

    /**
     * Metodo isset que comprueba si existe una variable en el objeto o no. Devolvemos false para deshabilitarla.
     *
     * @param string $name
     * @return boolean
     */
    public function __isset(string $name):bool {
        return false;
    }

    /**
     * Metodo unset magico que quita el valor de una variable. Devolvemos un mensaje de error para deshabilitarla.
     *
     * @param string $name
     * @return void
     */
    public function __unset(string $name):void {
        throw new Exception("No existe la propiedad $name");
    }
}
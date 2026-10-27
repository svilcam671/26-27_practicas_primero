<?php

class InstrumentoBase {

    private string $_descripcion;
    protected int $_edad;
    protected int $_numeroInstancia;
    protected static int $_totalInstancia = 1;


    public function __construct(string $descripcion, int $edad = 10) {
        $this->_descripcion = $descripcion;
        $this->_edad = $edad;
        
        self::$_totalInstancia++;

    }

    public function sonido() : string {
        
        return "fiuuuuuuu";

    }

    public function afinar() : string {
        
        return "Paso 1: Coger el instrumento. Paso 2: Revisar el sonido. Paso 3: Afinar con la herramienta adecuada";

    }

    public function envejecer() : void {
        
        $this->_edad = $this->_edad+1;

    }


    // getter y setters
	public function get_descripcion() : string {
		return $this->_descripcion;
	}

	public function set_descripcion(string $value) {
		$this->_descripcion = $value;
	}

	public function get_edad() : int {
		return $this->_edad;
	}

	public function set_edad(int $value) {
		$this->_edad = $value;
	}
}
<?php

class InstrumentoViento extends InstrumentoBase {

    
    protected string $_material = "madera";




    /**
     * Metodo que devuelve una cadena con el sonido que hace el instrumento
     *
     * @return string devuelve una cadena que representa el sonido del instrumento
     */
    public function sonido() : string {

        return "fiuuuuuuu";
    }
    

    

    /**
     * Metodo que devuelve una cadena con los pasos necesarios para afinar el instrumento
     *
     * @return string devuelve un string con los pasos
     */
    public final function afinar() : string {
        return "Paso 1: Coger el instrumento. Paso 2: Revisar el sonido. Paso 3: Afinar con la herramienta adecuada";
    }
        
        
}
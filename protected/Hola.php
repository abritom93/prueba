<?php
/**
 * Created by PhpStorm.
 * User: abrito
 * Date: 13/12/17
 * Time: 02:02 PM
 */
class  Persona {
    public $id;

    public function __construct($arg_nombre="",$arg_notas=array()) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
    {
        $this->id=$arg_nombre; //ponemos el argumento pasado cuando defines el objeto

    }




}
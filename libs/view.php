<?php

class View
{
    public $listaPersonas;
    public $listaOcupaciones;
    public $listaOcupaciones2;
    public $persona;
    public $mensaje;
    public $mensaje1;
    public $tipo_mensaje;

    function __construct()
    {

    }

    function renderView($vista)
    {
        require 'views/' . $vista;
    }

}
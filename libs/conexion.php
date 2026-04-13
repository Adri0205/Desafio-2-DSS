<?php

class Conexion
{

    private $host;
    private $username;
    private $password;
    private $bd;

    function __construct()
    {
        $this->host = constant('HOST');
        $this->username = constant('USER');
        $this->password = constant('PASSWORD');
        $this->bd = constant('DB');
    }

    function conectar()
    {
        try {
            $con = new PDO("mysql:dbname=$this->bd;host=$this->host", $this->username, $this->password);
            return $con;
        } catch (Exception $e) {
            $error = 'Error encontrado en conexión de Base de datos :( : ' . $e->getMessage() . "\n";
            return $error;
        }
    }

    function desconectar($conexion)
    {
        try {
            $conexion = null;
        } catch (Exception $e) {
            $error = 'Error encontrado en conexión de Base de datos :( : ' . $e->getMessage() . "\n";
            return $error;
        }
    }
}

?>
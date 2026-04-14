<?php
require "beans/PersonaBean.php";
require "beans/OcupacionBean.php";
class MainModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function listaPersonas()
    {
        $query = "SELECT *  FROM persona a INNER JOIN ocupaciones o ON a.id_ocupacion = o.id_ocupacion";
        $this->conexion = $this->con->conectar();
        $resultado = $this->conexion->prepare($query);
        $resultado->execute();

        $array = array();
        while ($row = $resultado->fetch()) {
            $persona = new PersonaBean();
            $ocupacion = new OcupacionBean();
            $persona->setIdPersona($row['id_persona']);
            $persona->setNombre($row['nombre_persona']);
            $persona->setEdad($row['edad_persona']);
            $persona->setTelefono($row['telefono_persona']);
            $persona->setSexo($row['sexo_persona']);
            $persona->setFecha($row['fecha_nac']);
            $ocupacion->setOcupacion($row['ocupacion']);
            $ocupacion->setIdOcupacion($row['id_ocupacion']);
            $persona->setOcupacion($ocupacion);
            $array[] = $persona;
        }
        $this->con->desconectar($this->conexion);
        return $array;
    }


    function listaOcupaciones()
    {
        $query = "SELECT *  FROM ocupaciones";
        $this->conexion = $this->con->conectar();
        $resultado = $this->conexion->prepare($query);
        $resultado->execute();

        $array = array();
        while ($row = $resultado->fetch()) {
            $ocupacion = new OcupacionBean();
            $ocupacion->setOcupacion($row['ocupacion']);
            $ocupacion->setIdOcupacion($row['id_ocupacion']);

            $array[] = $ocupacion;
        }

        $this->con->desconectar($this->conexion);
        return $array;
    }

    function agregarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha)
    {
        try {
            $query = "INSERT INTO persona (nombre_persona, edad_persona, telefono_persona, sexo_persona, id_ocupacion, fecha_nac) VALUES(:nombre,:edad,:telefono,:sexo,:ocupacion,:fecha)";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':nombre', $nombre);
            $row->bindParam(':edad', $edad);
            $row->bindParam(':telefono', $telefono);
            $row->bindParam(':sexo', $sexo);
            $row->bindParam(':ocupacion', $ocupacion);
            $row->bindParam(':fecha', $fecha);
            $resultado = $row->execute();
            $this->con->desconectar($this->conexion);
            return $resultado;
        } catch (Exception $e) {
            return false;
        }

    }

    function obtenerPersona()
    {
        $id = 1;
        $query = "SELECT * FROM persona WHERE id_persona = :valor";
        $this->conexion = $this->con->conectar();
        $row = $this->conexion->prepare($query);
        $row->bindParam(':valor', $id);
        $row->execute();
        while ($row = $row->fetch()) {
            $persona = new PersonaBean();
            $ocupacion = new OcupacionBean();
            $persona->setIdPersona($row['id_persona']);
            $persona->setNombre($row['nombre_persona']);
            $persona->setEdad($row['edad_persona']);
            $persona->setTelefono($row['telefono_persona']);
            $persona->setSexo($row['sexo_persona']);
            $persona->setFecha($row['fecha_nac']);
            $ocupacion->setOcupacion(null);
            $ocupacion->setIdOcupacion($row['id_ocupacion']);
            $persona->setOcupacion($ocupacion);
            return $persona;
        }

    }

    //aqui/////////////////////////////////////
    function eliminarPersona($id)
    {
        try {
            $query = "DELETE FROM persona WHERE id_persona = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':id', $id);
            $resultado = $row->execute();
            $this->con->desconectar($this->conexion);
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }

    function modificarPersona($id, $nombre, $edad, $telefono, $sexo, $ocupacion, $fecha)
    {
        try {
            $query = "UPDATE persona SET nombre_persona = :nombre, edad_persona = :edad, telefono_persona = :telefono, sexo_persona = :sexo, id_ocupacion = :ocupacion, fecha_nac = :fecha WHERE id_persona = :id";
            $this->conexion = $this->con->conectar();
            $row = $this->conexion->prepare($query);
            $row->bindParam(':id', $id);
            $row->bindParam(':nombre', $nombre);
            $row->bindParam(':edad', $edad);
            $row->bindParam(':telefono', $telefono);
            $row->bindParam(':sexo', $sexo);
            $row->bindParam(':ocupacion', $ocupacion);
            $row->bindParam(':fecha', $fecha);
            $resultado = $row->execute();
            $this->con->desconectar($this->conexion);
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }
    //aqui///////////////////////////////
}
?>
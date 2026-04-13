<?php

class MainController extends Controller
{

    function __construct()
    {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }



    function principal()
    {
        $this->view->listaPersonas = $this->model->listaPersonas();
        $this->view->listaOcupaciones = $this->model->listaOcupaciones();
        $this->view->persona = $this->model->obtenerPersona();
        $this->view->listaOcupaciones2 = $this->model->listaOcupaciones();

        // Obtener mensaje de sesión si existe
        if (isset($_SESSION['mensaje'])) {
            $this->view->mensaje = $_SESSION['mensaje'];
            $this->view->tipo_mensaje = $_SESSION['tipo_mensaje'];
            unset($_SESSION['mensaje']);
            unset($_SESSION['tipo_mensaje']);
        }

        $this->view->renderView('main/main.php');

    }
    function agregarPersona()
    {
        $nombre = $_POST["nombre"];
        $edad = $_POST["edad"];
        $telefono = $_POST["telefono"];
        $sexo = $_POST["sexo"];
        $ocupacion = $_POST["ocupacion"];
        $fecha = $_POST["fecha"];
        $resultado = $this->model->agregarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if ($resultado) {
            $_SESSION['mensaje'] = '✓ Persona agregada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = '✗ Error al agregar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }
    function eliminarPersona($id)
    {
        $resultado = $this->model->eliminarPersona($id);

        if ($resultado) {
            $_SESSION['mensaje'] = '✓ Persona eliminada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = '✗ Error al eliminar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }

    function modificarPersona()
    {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $edad = $_POST["edad"];
        $telefono = $_POST["telefono"];
        $sexo = $_POST["sexo"];
        $ocupacion = $_POST["ocupacion"];
        $fecha = $_POST["fecha"];
        $resultado = $this->model->modificarPersona($id, $nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if ($resultado) {
            $_SESSION['mensaje'] = '✓ Persona modificada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = '✗ Error al modificar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }
}

?>
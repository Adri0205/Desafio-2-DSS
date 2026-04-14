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

    private function validarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha)
    {
        $errores = [];

        $nombre = trim($nombre);
        if (empty($nombre)) {
            $errores[] = "El nombre es requerido";
        } elseif (strlen($nombre) < 3) {
            $errores[] = "El nombre debe contener al menos 3 caracteres";
        } elseif (strlen($nombre) > 100) {
            $errores[] = "El nombre no puede exceder 100 caracteres";
        } elseif (!preg_match("/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/", $nombre)) {
            $errores[] = "El nombre solo debe contener letras y espacios";
        }

        if (empty($edad)) {
            $errores[] = "La edad es requerida";
        } elseif (!is_numeric($edad)) {
            $errores[] = "La edad debe ser un número";
        } elseif ($edad < 1 || $edad > 120) {
            $errores[] = "La edad debe estar entre 1 y 120 años";
        }

        $telefono = trim($telefono);
        if (empty($telefono)) {
            $errores[] = "El teléfono es requerido";
        } elseif (!preg_match("/^[0-9\-\s\+\(\)]+$/", $telefono)) {
            $errores[] = "El teléfono contiene caracteres inválidos";
        } else {
            // Extraer solo dígitos
            $digitos = preg_replace("/\D/", "", $telefono);
            if (strlen($digitos) < 7) {
                $errores[] = "El teléfono debe contener al menos 7 dígitos";
            }
        }

        if (empty($sexo) || !in_array($sexo, ["Masculino", "Femenino"])) {
            $errores[] = "Debe seleccionar un sexo válido";
        }

        if (empty($ocupacion) || !is_numeric($ocupacion)) {
            $errores[] = "Debe seleccionar una ocupación válida";
        }

        if (empty($fecha)) {
            $errores[] = "La fecha de nacimiento es requerida";
        } else {
            $fechaCaptura = DateTime::createFromFormat('Y-m-d', $fecha);
            if ($fechaCaptura === false) {
                $errores[] = "El formato de la fecha no es válido";
            } else {
                $hoy = new DateTime();

                if ($fechaCaptura > $hoy) {
                    $errores[] = "La fecha de nacimiento no puede ser en el futuro";
                }

                $interval = $hoy->diff($fechaCaptura);
                $edadCalculada = $interval->y;

                if ($edadCalculada < 1 || $edadCalculada > 120) {
                    $errores[] = "La fecha de nacimiento no es válida (edad debe ser 1-120 años)";
                }
            }
        }

        return $errores;
    }

    function principal()
    {
        $this->view->listaPersonas = $this->model->listaPersonas();
        $this->view->listaOcupaciones = $this->model->listaOcupaciones();
        $this->view->persona = $this->model->obtenerPersona();
        $this->view->listaOcupaciones2 = $this->model->listaOcupaciones();

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
        $nombre = $_POST["nombre"] ?? "";
        $edad = $_POST["edad"] ?? "";
        $telefono = $_POST["telefono"] ?? "";
        $sexo = $_POST["sexo"] ?? "";
        $ocupacion = $_POST["ocupacion"] ?? "";
        $fecha = $_POST["fecha"] ?? "";
        $errores = $this->validarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if (!empty($errores)) {
            $_SESSION['mensaje'] = implode(", ", $errores);
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: ' . constant('URL') . 'Main/principal');
            return;
        }

        $resultado = $this->model->agregarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if ($resultado) {
            $_SESSION['mensaje'] = 'Persona agregada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = 'Error al agregar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }

    //aqui///////////////////////////////////////////////////
    function eliminarPersona($id)
    {
        $resultado = $this->model->eliminarPersona($id);

        if ($resultado) {
            $_SESSION['mensaje'] = 'Persona eliminada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = 'Error al eliminar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }

    function modificarPersona()
    {
        $id = $_POST["id"] ?? "";
        $nombre = $_POST["nombre"] ?? "";
        $edad = $_POST["edad"] ?? "";
        $telefono = $_POST["telefono"] ?? "";
        $sexo = $_POST["sexo"] ?? "";
        $ocupacion = $_POST["ocupacion"] ?? "";
        $fecha = $_POST["fecha"] ?? "";

        // Validar que el ID sea válido
        if (empty($id) || !is_numeric($id)) {
            $_SESSION['mensaje'] = 'ID de persona inválido';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: ' . constant('URL') . 'Main/principal');
            return;
        }

        // Validar datos
        $errores = $this->validarPersona($nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if (!empty($errores)) {
            $_SESSION['mensaje'] = implode(", ", $errores);
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: ' . constant('URL') . 'Main/principal');
            return;
        }

        $resultado = $this->model->modificarPersona($id, $nombre, $edad, $telefono, $sexo, $ocupacion, $fecha);

        if ($resultado) {
            $_SESSION['mensaje'] = 'Persona modificada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $_SESSION['mensaje'] = 'Error al modificar la persona';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: ' . constant('URL') . 'Main/principal');
    }
}

//aqui///////////////////////////////////////////

?>
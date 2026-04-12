<?php 
 
class MainController extends Controller{
 
    function __construct(){ 
        parent::__construct();
        // $this->view->mensaje1= "Parametro enviado a la vista"; 
        // $this->view->renderView('main/main.php'); 
    } 
 
     
  
    function principal(){ 
        $this->view->listaPersonas= $this->model->listaPersonas();
        $this->view->listaOcupaciones= $this->model->listaOcupaciones(); 
        $this->view->persona= $this->model->obtenerPersona();
        $this->view->renderView('main/main.php');
        
    } 
    function agregarPersona(){ 
       $nombre = $_POST["nombre"]; 
       $edad = $_POST["edad"]; 
       $telefono = $_POST["telefono"]; 
       $sexo = $_POST["sexo"]; 
       $ocupacion = $_POST["ocupacion"]; 
       $fecha = $_POST["fecha"]; 
       $this->model->agregarPersona($nombre,$edad,$telefono,$sexo,$ocupacion,$fecha);
       header('Location:'. constant('URL')."Main/principal");
    } 
    function eliminarPersona($id){ 
        $this->model->eliminarPersona($id);
        header('Location:'. constant('URL')."Main/principal"); 
    } 
} 
 
?>
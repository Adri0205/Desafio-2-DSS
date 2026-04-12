<?php require "views/templates/header.php"; ?> 
<?php require "views/templates/nav.php"; ?> 
 
<body> 
    <br> 
    <br> 
    <br> 
    <div class="container"> 
        <h1 class="text-center">Gestion personas</h1> 

        <div> 
 
            <div class=""> 
                <table class="table table-striped table-hover table-dark"> 
                    <thead class="table-dark table-striped"> 
                        <tr> 
                            <th>Id</th> 
                            <th>Nombre</th> 
                            <th>Edad</th> 
                            <th>Telefono</th> 
                            <th>Sexo</th> 
                            <th>Ocupacion</th> 
                            <th>Fecha nacimiento</th> 
                            <th colspan="2">Operaciones</th> 
 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php 
                         
                        foreach($this->listaPersonas as $lista ){ 
                        ?> 
                            <tr>
                                <th><?php echo $lista->getIdPersona(); ?></th> 
                                <th><?php echo $lista->getNombre(); ?></th> 
                                <th><?php echo $lista->getEdad(); ?></th> 
                                <th><?php echo $lista->getTelefono(); ?></th> 
                                <th><?php echo $lista->getSexo(); ?></th> 
                                <th><?php echo $lista->getOcupacion()->getOcupacion(); ?></th> 
                                <th><?php echo $lista->getFecha(); ?></th> 
                                <th><button onclick="alerta('<?php echo $lista->getIdPersona() ?>')" class="btn btndanger">Eliminar</button></th> 
                                <th><button onclick="modificar('<?php echo $lista->getIdPersona() ?>', 
                                '<?php echo $lista->getNombre(); ?>', 
                                '<?php echo $lista->getEdad(); ?>', 
                                '<?php echo  $lista->getTelefono(); ?>', 
                                '<?php echo $lista->getSexo();  ?>', 
                                '<?php echo $lista->getOcupacion()->getIdOcupacion(); ?>', 
                                '<?php echo $lista->getFecha(); ?>')" class="btn btn-info">Modificar</button></th> 
 
                            </tr> 
                        <?php 
                        } 
 
                    
                        ?> 
                    </tbody> 
                </table> 
 
            </div> 
 
 
        </div> 
 
    </div> 
 
 
</body> 
 
 
 
 
<?php require "views/templates/modal.php"; ?> 
<?php require "views/templates/footer.php"; ?> 
 
</html> 
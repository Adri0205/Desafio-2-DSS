<!DOCTYPE html>
<?php require "views/templates/header.php"; ?>
<?php require "views/templates/nav.php"; ?>

<body>
    <br>
    <br>
    <br>
    <div class="container">
        <h1 class="text-center">Gestion personas</h1>

        <?php if (isset($this->mensaje)): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    <?php if ($this->tipo_mensaje === 'success'): ?>
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            html: '<h5><?php echo $this->mensaje; ?></h5>',
                            confirmButtonColor: '#28a745',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    <?php else: ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: '<h5><?php echo $this->mensaje; ?></h5>',
                            confirmButtonColor: '#dc3545',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    <?php endif; ?>
                });
            </script>
        <?php endif; ?>


        <div style="padding: 0;" id="conten">
            <form role="form" id="formaPersona" action="<?php echo constant("URL") ?>Main/agregarPersona" method="POST"
                novalidate>
                <div class="col-md-12" id="conten">
                    <input type="hidden" name="id" id="idpersona">

                    <div class="form-group">
                        <label for="nombre">Ingrese el nombre de la persona:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nombre"
                                value="<?php echo $this->persona->getNombre(); ?>" id="nombre"
                                placeholder="Ingresa el nombre">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edad">Ingrese la edad de la persona:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="edad" name="edad"
                                value="<?php echo $this->persona->getEdad(); ?>" placeholder="Ingresa la edad">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edad">Ingrese el telefono de la persona:</label>
                        <div class="input-group">
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                                value="<?php echo $this->persona->getTelefono(); ?>" placeholder="Ingresa el telefono">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Ingrese el sexo de la persona:</label>
                        <div class="input-group">
                            <select name="sexo" id="sexo" class="form-control">
                                <option value="">Seleccionar...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ocupacion">Ingrese la ocupacion de la persona:</label>
                        <div class="input-group"> <select name="ocupacion" id="ocupacion" class="form-control">
                                <option value="">Seleccionar...</option>
                                <?php
                                foreach ($this->listaOcupaciones as $lista) {
                                    ?>
                                    <option value="<?php echo $lista->getIdOcupacion(); ?>">
                                        <?php echo $lista->getOcupacion(); ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Ingrese la fecha de nacimiento de la persona:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fecha"
                                value="<?php echo $this->persona->getFecha(); ?>" name="fecha"
                                placeholder="Ingresa la fecha">
                        </div>
                    </div>

                    <div style="margin-left: 30%; display: flex; gap: 10px;">
                        <input type="submit" class="btn btn-success col-md-6" value="Agregar Persona">
                    </div>
                </div>
            </form>


        </div>
        <br>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <button class="btn btn-primary" onclick="generarPDF()"><i class="fa fa-file-pdf-o"></i> Imprimir
                PDF</button>
        </div>
        <div>

            <div>
                <table class="table table-striped table-hover table-dark" id="tablaPersonas">
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

                        foreach ($this->listaPersonas as $lista) {
                            ?>
                            <tr>
                                <th><?php echo $lista->getIdPersona(); ?></th>
                                <th><?php echo $lista->getNombre(); ?></th>
                                <th><?php echo $lista->getEdad(); ?></th>
                                <th><?php echo $lista->getTelefono(); ?></th>
                                <th><?php echo $lista->getSexo(); ?></th>
                                <th><?php echo $lista->getOcupacion()->getOcupacion(); ?></th>
                                <th><?php echo $lista->getFecha(); ?></th>
                                <th><button onclick="alerta('<?php echo $lista->getIdPersona() ?>')"
                                        class="btn btndanger">Eliminar</button></th>
                                <th><button onclick="modificar('<?php echo $lista->getIdPersona() ?>', 
                                '<?php echo $lista->getNombre(); ?>', 
                                '<?php echo $lista->getEdad(); ?>', 
                                '<?php echo $lista->getTelefono(); ?>', 
                                '<?php echo $lista->getSexo(); ?>', 
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
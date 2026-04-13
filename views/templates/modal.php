<div class="modal fade" id="exampleModal" tabindex="-1" aria labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close">X</button>
            </div>
            <div class="modal-body">
                <form role="form" id="formactualiza" action="<?php echo constant("URL") ?>Main/agregarPersona"
                    method="POST">
                    <div class="col-md-12" id="conten">
                        <input type="hidden" name="id" id="idpersona">

                        <div class="form-group">
                            <label for="nombre">Ingrese el nombre de la persona:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre"
                                    required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edad">Ingrese la edad de la persona:</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="edad" placeholder="Ingresa la edad"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edad">Ingrese el telefono de la persona:</label>
                            <div class="input-group">
                                <input type="tel" class="form-control" name="telefono" placeholder="Ingresa el telefono"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Ingrese el sexo de la persona:</label>
                            <div class="input-group">
                                <select name="sexo" class="form-control" required>
                                    <option value="Masculino">Maculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ocupacion">Ingrese la ocupacion de la persona:</label>
                            <div class="input-group">
                                <select name="ocupacion" class="form-control" required>
                                    <?php
                                    foreach ($this->listaOcupaciones2 as $lista) {
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
                                <input type="date" class="form-control" name="fecha" placeholder="Ingresa la fecha"
                                    required>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">

                <input type="submit" name="submit" class="btn btn-success btn-md" form="formactualiza" value="Enviar">
            </div>
        </div>
    </div>
</div>
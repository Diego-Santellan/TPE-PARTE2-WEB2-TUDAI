<?php
class  PropertyView
{
    public function showProperties($properties)
    {

        require_once './templates/layout/header.phtml';
        require_once './templates/form_add_property.phtml';
        require_once './templates/filter_properties.phtml';

?>
        <!--el controller me envia las propiedades que el modelo pidio a la DB-->
        <div class="container mt-5">
            <h2 class="text-center mb-4">Propiedades</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-header">
                    <tr>
                        <th>Tipo</th>
                        <th>Zona</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Modalidad</th>
                        <th>Estado</th>
                        <th>Ciudad</th>
                        <th>id_owner</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $property): ?>
                        <tr>
                            <td><?php echo $property->type ?></td>
                            <td><?php echo $property->zone ?></td>
                            <td><?php echo $property->price ?></td>
                            <td><?php echo substr( $property->description, 0,20) ?>...</td>
                            <td><?php echo $property->mode ?></td>
                            <td><?php echo $property->status ?></td>
                            <td><?php echo $property->city ?></td>
                            <td><?php echo $property->id_owner ?></td>
                            <td><a class="btn btn-danger" href="deleteProperty/<?php echo $property->id_property ?>">Eliminar</a></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPropertyEdit<?php echo $property->id_property ?>" data-bs-whatever="@getbootstrap">Editar</button></td>
                            <td><a class="btn btn-info text-light" href="getProperty/<?php echo $property->id_property ?>">Ver más</a></td>
                        </tr>

                        <div class="modal fade" id="modalPropertyEdit<?php echo $property->id_property ?>" tabindex="-1" aria-labelledby="modalPropertyEditLabel<?php echo $property->id_property ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalPropertyEditLabel<?php echo $property->id_property ?>">Editar propiedad <?php echo $property->id_property ?>:</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- updateProperty es una ruta del router -->
                                        <form action="updateProperty/<?php echo $property->id_property ?>" method="POST">
                                            <input type="hidden" name="id_property" id="<?php echo $property->id_property ?>">
                                            <div class="mb-3">
                                                <label for="typePropertyEdit" class="col-form-label">Tipo:</label>
                                                <select class="form-select" id="typePropertyEdit" name="typePropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                    <option selected disabled>Actualice el tipo de propiedad</option>

                                                    <option value="apartament">DEPARTAMENTO</option>
                                                    <option value="house">CASA</option>
                                                    <option value="lot">LOTE</option>
                                                    <option value="countryHouse">QUINTA</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="zonePropertyEdit" class="col-form-label">Nueva zona :</label>
                                                <input name="zonePropertyEdit" type="text" class="form-control" id="zonePropertyEdit" maxlength="45" pattern="[A-Za-z0-9\s]+" required></input>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pricePropertyEdit" class="col-form-label">Nuevo precio:</label>
                                                <input type="number" class="form-control" name="pricePropertyEdit" id="pricePropertyEdit" required pattern="[0-9]{1,10}" min="0" max="9999999999"></input>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descriptionPropertyEdit" class="col-form-label">Nueva descripción :</label>
                                                <input name="descriptionPropertyEdit" type="text" class="form-control" id="descriptionPropertyEdit" maxlength="500" pattern="[A-Za-z0-9,.\\s]+" required></input>
                                            </div>
                                            <div class="mb-3">
                                                <label for="modePropertyEdit" class="col-form-label">Nueva modalidad:</label>
                                                <select class="form-select" id="modePropertyEdit" name="modePropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                    <option selected disabled>Actualice la modalidad de la propiedad</option>

                                                    <option value="sell">VENTA</option>
                                                    <option value="rent">ALQUILER</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="statusPropertyEdit" class="col-form-label">Nuevo estado:</label>
                                                <select class="form-select" id="statusPropertyEdit" name="statusPropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                    <option selected disabled>Actualice la modalidad de la propiedad</option>

                                                    <option value="solt">VENDIDO</option>
                                                    <option value="rented">ALQUILADO</option>
                                                    <option value="available">DISPONIBLE</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="cityPropertyEdit" class="col-form-label">Nueva ciudad :</label>
                                                <input name="cityPropertyEdit" type="text" class="form-control" id="cityPropertyEdit" maxlength="45" pattern="[A-Za-z0-9\s]+" required></input>
                                            </div>
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                            <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

                                            <input type="submit" class="btn btn-primary" value="Guarda Cambios"></input>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach  ?>
                </tbody>
            </table>
        </div>

    <?php require_once './templates/layout/footer.phtml';
    }
    public function showProperty($property)
    {
        require_once './templates/layout/header.phtml';
    ?>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Propiedades</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-header">
                    <tr>
                        <th>Tipo</th>
                        <th>Zona</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Modalidad</th>
                        <th>Estado</th>
                        <th>Ciudad</th>
                        <th>id_owner</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $property->type ?></td>
                        <td><?php echo $property->zone ?></td>
                        <td><?php echo $property->price ?></td>
                        <td><?php echo $property->description ?></td>
                        <td><?php echo $property->mode ?></td>
                        <td><?php echo $property->status ?></td>
                        <td><?php echo $property->city ?></td>
                        <td><?php echo $property->id_owner ?></td>
                        <td><a class="btn btn-danger" href="deleteProperty/<?php echo $property->id_property ?>">Eliminar</a></td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPropertyEdit<?php echo $property->id_property ?>" data-bs-whatever="@getbootstrap">Editar</button></td>
                    </tr>

                    <div class="modal fade" id="modalPropertyEdit<?php echo $property->id_property ?>" tabindex="-1" aria-labelledby="modalPropertyEditLabel<?php echo $property->id_property ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalPropertyEditLabel<?php echo $property->id_property ?>">Editar propiedad <?php echo $property->id_property ?>:</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- updateProperty es una ruta del router -->
                                    <form action="updateProperty/<?php echo $property->id_property ?>" method="POST">
                                        <input type="hidden" name="id_property" id="<?php echo $property->id_property ?>">
                                        <div class="mb-3">
                                            <label for="typePropertyEdit" class="col-form-label">Tipo:</label>
                                            <select class="form-select" id="typePropertyEdit" name="typePropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                <option selected disabled>Actualice el tipo de propiedad</option>

                                                <option value="apartament">DEPARTAMENTO</option>
                                                <option value="house">CASA</option>
                                                <option value="lot">LOTE</option>
                                                <option value="countryHouse">QUINTA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="zonePropertyEdit" class="col-form-label">Nueva zona :</label>
                                            <input name="zonePropertyEdit" type="text" class="form-control" id="zonePropertyEdit" maxlength="45" pattern="[A-Za-z0-9\s]+" required></input>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pricePropertyEdit" class="col-form-label">Nuevo precio:</label>
                                            <input type="number" class="form-control" name="pricePropertyEdit" id="pricePropertyEdit" required pattern="[0-9]{1,10}" min="0" max="9999999999"></input>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descriptionPropertyEdit" class="col-form-label">Nueva descripción :</label>
                                            <input name="descriptionPropertyEdit" type="text" class="form-control" id="descriptionPropertyEdit" maxlength="500" pattern="[A-Za-z0-9,.\\s]+" required></input>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modePropertyEdit" class="col-form-label">Nueva modalidad:</label>
                                            <select class="form-select" id="modePropertyEdit" name="modePropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                <option selected disabled>Actualice la modalidad de la propiedad</option>

                                                <option value="sell">VENTA</option>
                                                <option value="rent">ALQUILER</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="statusPropertyEdit" class="col-form-label">Nuevo estado:</label>
                                            <select class="form-select" id="statusPropertyEdit" name="statusPropertyEdit" maxlength="20" pattern="[A-Za-z\s]+" required>
                                                <option selected disabled>Actualice la modalidad de la propiedad</option>

                                                <option value="solt">VENDIDO</option>
                                                <option value="rented">ALQUILADO</option>
                                                <option value="available">DISPONIBLE</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cityPropertyEdit" class="col-form-label">Nueva ciudad :</label>
                                            <input name="cityPropertyEdit" type="text" class="form-control" id="cityPropertyEdit" maxlength="45" pattern="[A-Za-z0-9\s]+" required></input>
                                        </div>
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                                        <!-- QUE HACER CON EL ID_OWNER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

                                        <input type="submit" class="btn btn-primary" value="Guarda Cambios"></input>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>

                    <?php
                    require_once './templates/layout/footer.phtml';
                }
                public function showError($mjsError)
                {
                    require_once './templates/layout/header.phtml';
                    ?>
                        <h1 class="errorMessage">Error: <?php echo $mjsError ?> </h1>
                <?php
                    require_once './templates/layout/footer.phtml';
                }
            }
                ?>
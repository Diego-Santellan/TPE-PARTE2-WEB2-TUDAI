<h2>Ingresar nueva propiedad</h2>
<!-- en action va la ruta accion(URL) -->
<form action="newProperty" method="post" id="formProperty">
    <label for="typePropertyAdd">Tipo de propiedad:</label>
    <select id="typePropertyAdd" name="typePropertyAdd" required>
        <option value="apartament">DEPARTAMENTO</option>
        <option value="house">CASA</option>
        <option value="lot">LOTE</option>
        <option value="countryHouse">QUINTA</option>
    </select>

    <label for="zonePropertyAdd">Zona:</label>
    <input type="text" id="zonePropertyAdd" name="zonePropertyAdd" maxlength="45" required>
    <span id="zonePropertyAddError" class="errorMessage"></span>


    <label for="pricePropertyAdd">Precio sin decimales en USD:</label>
    <input type="number" id="pricePropertyAdd" name="pricePropertyAdd" min="0" max="9999999999" maxlength="10" pattern="^[0-9]{1,10}$" required>
    <span id="pricePropertyAddError" class="errorMessage"></span>


    <label for="descriptionPropertyAdd">Descripción:</label>
    <input type="text" id="descriptionPropertyAdd" name="descriptionPropertyAdd" maxlength="500" rows="4" cols="50" required>
    <span id="descriptionPropertyAddError" class="errorMessage"></span>

    <label for="modePropertyAdd">Modalidad:</label>
    <select id="modePropertyAdd" name="modePropertyAdd" required>
        <option value="sell">VENTA</option>
        <option value="rent">ALQUILER</option>
    </select>

    <label for="statusPropertyAdd">Estado:</label>
    <select id="statusPropertyAdd" name="statusPropertyAdd" required>
        <option value="sold">VENDIDO</option>
        <option value="rented">ALQUILADO</option>
        <option value="available">DISPONIBLE</option>
    </select>

    <label for="cityPropertyAdd">Localidad:</label>
    <input type="text" id="cityPropertyAdd" name="cityPropertyAdd" maxlength="45" required>
    <span id="cityPropertyAddError" class="errorMessage"></span>


    <label for="id_ownerPropertyAdd">ID Dueño:</label>
    <input type="number" id="id_ownerPropertyAdd" name="id_ownerPropertyAdd" required>


    <input type="submit" value="Guardar Propiedad">
</form>
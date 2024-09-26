<h2>Ingresar nueva propiedad</h2>
<!-- en action va la ruta accion(URL) -->
<form action="newPropierty" method="post" id="formPropierty">
    <label for="type">Tipo de propiedad:</label>
    <select id="type" name="type" required>
        <option value="apartament">Departamento</option>
        <option value="house">Casa</option>
        <option value="lot">Lote</option>
        <option value="countryHouse">Quinta</option>
    </select>

    <label for="zone">Zona:</label>
    <input type="text" id="zone" name="zone" maxlength="45" required>
    <span id="zoneError" class="errorMessage"></span>


    <label for="price">Precio sin decimales en USD:</label>
    <input type="number" id="price" name="price" step="1" min="0" required>
    <span id="priceError" class="errorMessage"></span>


    <label for="description">Descripción:</label>
    <textarea id="description" name="description" maxlength="500" rows="4" cols="50" required></textarea><br><br>
    <span id="descriptionError" class="errorMessage"></span>

    <label for="mode">Modalidad:</label>
    <select id="mode" name="mode" required>
        <option value="sell">Venta</option>
        <option value="rent">Alquiler</option>
    </select>

    <label for="status">Estado:</label>
    <select id="status" name="status" required>
        <option value="sold">VENDIDO</option>
        <option value="rented">ALQUILADO</option>
        <option value="available">DISPONIBLE</option>
    </select>

    <label for="city">Localidad:</label>
    <input type="text" id="city" name="city" maxlength="45" required>
    <span id="cityError" class="errorMessage"></span>


    <label for="id_owner">ID Dueño:</label>
    <input type="number" id="id_owner" name="id_owner" required>


    <input type="submit" value="Guardar Propiedad">
</form>
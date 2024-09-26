<h2>Ingresar Dueño</h2>
<form action="newOwner" method="post" id="formOwner">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" maxlength="50" pattern="[a-zA-Z\s]+" required>
    <span id="nameError" class="errorMessage"></span>

    <label for="phone">Teléfono:</label>
    <input type="text" id="phone" name="phone" maxlength="20" pattern="[a-zA-Z0-9\s]+" required>
    <span id="phoneError" class="errorMessage"></span>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" maxlength="80" required>
    <span id="emailError" class="errorMessage"></span>


    <input type="submit" value="Guardar Dueño">
</form>



{include file='layout/header.phtml'}

<h2 class="text-center m-4">Iniciar sesión</h2>

{if $error}
<div class='alert alert-danger' role='alert'>
  {$error}
</div>
{/if}

<div class="d-flex flex-column justify-content-center mt-5 w-100 align-items-center">
  <form method="POST" action="login" class="needs-validation p-4 bg-light border border-secondary rounded shadow w-50">
    <div class="mb-3">
      <label for="usernameLogin" class="form-label">Nombre de usuario:</label>
      <input type="text" class="form-control" name="usernameLogin" id="usernameLogin" required>
    </div>
    <div class="mb-3">
      <label for="passwordLogin" class="form-label">Contraseña:</label>
      <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" required>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
  </form>
  <a href="showRegister" class="mt-5">No estás registrado? Registrate</a>
</div>

{include file='layout/footer.phtml'}
{include file='layout/header.phtml'}
<!-- como usamos smarty cambiamos la extension de phtml a tpl -->

<h2 class="text-center m-4">Registrarse</h2>

{if $error} 
<div class='alert alert-danger' role='alert'>
  {$error}
</div>
{/if}

<div class="d-flex flex-column justify-content-center mt-5 w-100 align-items-center">
  <form method="POST" action="register" class="needs-validation p-4 bg-light border border-secondary rounded shadow w-50">
    <div class="mb-3">
      <label for="usernameRegister" class="form-label">Nombre de usuario:</label>
      <input type="text" class="form-control" name="usernameRegister" id="usernameRegister" required>
    </div>
    <div class="mb-3">
      <label for="passwordRegister" class="form-label">Contraseña:</label>
      <input type="password" class="form-control" id="passwordRegister" name="passwordRegister" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrese</button>
  </form>
  <a href="showLogin" class="mt-5">Ya estás registrado? Iniciá sesion</a>
</div>

{include file='layout/footer.phtml'}
<?php
/* Smarty version 5.4.1, created on 2024-10-09 17:24:51
  from 'file:form_login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_6706a043c670d3_61312206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c78199349e1d68d1adf8219df0ec07c667c64b6f' => 
    array (
      0 => 'form_login.tpl',
      1 => 1728487458,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.phtml' => 1,
    'file:layout/footer.phtml' => 1,
  ),
))) {
function content_6706a043c670d3_61312206 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\inmobiliaria\\templates';
$_smarty_tpl->renderSubTemplate('file:layout/header.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<h2 class="text-center m-4">Iniciar sesión</h2>

<?php if ($_smarty_tpl->getValue('error')) {?>
<div class='alert alert-danger' role='alert'>
  <?php echo $_smarty_tpl->getValue('error');?>

</div>
<?php }?>

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

<?php $_smarty_tpl->renderSubTemplate('file:layout/footer.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

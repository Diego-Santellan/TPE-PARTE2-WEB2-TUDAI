<?php
/* Smarty version 5.4.1, created on 2024-10-09 17:28:34
  from 'file:form_register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_6706a122ed1530_93200773',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faa2df12a56a701f8c2204bcbb0cb53fe88d085f' => 
    array (
      0 => 'form_register.tpl',
      1 => 1728487651,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.phtml' => 1,
    'file:layout/footer.phtml' => 1,
  ),
))) {
function content_6706a122ed1530_93200773 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\inmobiliaria\\templates';
$_smarty_tpl->renderSubTemplate('file:layout/header.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
<!-- como usamos smarty cambiamos la extension de phtml a tpl -->

<h2 class="text-center m-4">Registrarse</h2>

<?php if ($_smarty_tpl->getValue('error')) {?> 
<div class='alert alert-danger' role='alert'>
  <?php echo $_smarty_tpl->getValue('error');?>

</div>
<?php }?>

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

<?php $_smarty_tpl->renderSubTemplate('file:layout/footer.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

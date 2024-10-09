<?php
/* Smarty version 5.4.1, created on 2024-10-09 17:24:51
  from 'file:layout/header.phtml' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_6706a043d46ca0_86869753',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53bbd882cf71364ff58c1ceb121e05278b15739e' => 
    array (
      0 => 'layout/header.phtml',
      1 => 1728224850,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6706a043d46ca0_86869753 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\inmobiliaria\\templates\\layout';
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?php echo '<?php'; ?>
 echo BASE_URL <?php echo '?>'; ?>
">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Gamalero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo '<?php'; ?>
 echo BASE_URL; <?php echo '?>'; ?>
/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark ">
            <div class="container">
                <a class="navbar-brand text-light" href="#">Inmobiliaria Gamalero</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="#">Dueños</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="/<?php echo '<?php'; ?>
 echo BASE_URL; <?php echo '?>'; ?>
getAllProperties">Propiedades</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Propiedades
                            </a>
                            <ul class="dropdown-menu bg-dark">
                                <li><a class="dropdown-item text-light " href="#">Casa</a></li>
                                <li><a class="dropdown-item text-light" href="#">Departamento</a></li>
                                <li><a class="dropdown-item text-light" href="#">Quinta</a></li>
                                <li><a class="dropdown-item text-light" href="#">Lote</a></li>
                            </ul>
                        </li>
                        

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container" id=""><?php }
}

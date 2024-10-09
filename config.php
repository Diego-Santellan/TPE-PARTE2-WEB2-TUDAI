<?php
    const MYSQL_USER = 'root';
    const MYSQL_PASS = '';
    const MYSQL_DB = 'inmobiliaria';
    const MYSQL_HOST = 'localhost';
    
    require_once './vendor/autoload.php'; // Esto carga todas las dependencias de Composer, incluyendo Smarty
    $smarty = new Smarty\Smarty();
    
    $smarty->setTemplateDir('./templates/');
    $smarty->setCompileDir('./templates_c/');
    $smarty->setCacheDir('./cache/');
    $smarty->setConfigDir('./configs/');
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/support/' . 'config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/support/' . 'jdf.php';
function AutoLoad($className) {
    $class = SOFT_ROOT . '/inc/class.' . $className . '.php';
    if(file_exists($class)) {
        require_once $class;
    }
}

spl_autoload_register('AutoLoad');
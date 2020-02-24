<?php
spl_autoload_register(function ($className) {
    $filename = 'inc';
    if (strpos($className, 'Controller') !== false) {
        $filename .= '/controllers/';
    } elseif (strpos($className, 'Model') !== false) {
        $filename .= '/models/';
    } elseif (strpos($className, 'Page') !== false) {
        $filename = 'page/';
    } else {
        $filename .= '/lib/';
    }
    $filename .= $className . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        require_once 'view/parts/404.phtml';
        header("Refresh: 1; url=" . ApplicationController::getInstance()->url('home') . "");
    }
});
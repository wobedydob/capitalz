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

    require_once $filename;

});
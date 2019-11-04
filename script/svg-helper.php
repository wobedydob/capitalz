<?php

function svg_helper($name)
{
    $file = 'img/svg/' . $name . '.svg';
    if (file_exists($file)) {
        return file_get_contents($file);
    } else {
        echo $file;
        exit;
    }
}
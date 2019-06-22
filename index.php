<?php

spl_autoload_register(function ($class) {
    if (file_exists(__DIR__.'/application/controllers/'.$class.'.php')) {
        require __DIR__.'/application/controllers/'.$class.'.php';
    } elseif (file_exists(__DIR__.'/application/models/'.$class.'.php')) {
        require __DIR__.'/application/models/'.$class.'.php';
    } elseif (file_exists(__DIR__.'/application/core/'.$class.'.php')) {
        require __DIR__.'/application/core/'.$class.'.php';
    }
});

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

require 'application/bootstrap.php';

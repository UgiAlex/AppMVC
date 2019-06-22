<?php
$app = new \Slim\Slim();

    $app->get('/', 'ControllerNews:mainPage');
    $app->get('/parse', 'ControllerNews:parsePages');
    $app->get('/post/:id', 'ControllerNews:readPost');
    $app->get('/users', 'ControllerNews:authors');
    $app->get('/:nickName/post', 'ControllerNews:authorNews');

$app->run();

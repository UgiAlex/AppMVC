<?php
$app = new \Slim\Slim();

    $app->get('/', 'ControllerNews:ActionIndex');
    $app->get('/parse', 'ControllerNews:ActionParse');
    $app->get('/post/:id', 'ControllerNews:ActionPost');
    $app->get('/users', 'ControllerNews:ActionUser');
    $app->get('/:nickName/post', 'ControllerNews:ActionUserPost');

$app->run();

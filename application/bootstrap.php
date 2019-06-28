<?php
$app = new \Slim\Slim();

$app->get('/', 'ControllerNews:mainPage');
$app->get('/parseuser', 'ControllerUser:parseUser');
$app->get('/parsenews', 'ControllerNews:parseNews');
$app->get('/post/:id', 'ControllerNews:readPost');
$app->get('/users', 'ControllerUser:selectAllUser');
$app->get('/:nickName/post', 'ControllerNews:authorNews');

$app->run();

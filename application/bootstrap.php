<?php

$app = new \Slim\Slim();

	$app->get('/',           		'controller_post:action_index');
	$app->get('/parse',      		'controller_post:action_parse');
	$app->get('/post/:id',   		'controller_post:action_post');
	$app->get('/users',      		'controller_user:action_user');
	$app->get('/:nickName/post', 	'controller_user:action_userPost');

$app->run();
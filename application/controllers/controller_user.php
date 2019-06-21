<?php

class Controller_User extends Controller
{

	function __construct()	{
		$this->model = new Model_User();
		$this->view = new View();
	}

	function action_user()	{
		$data = $this->model->SelectUsers();		
		$this->view->generate('Users_view.php', $data);
	}

	function action_userPost($nick)	{
		$data = $this->model->SelectUsersPost($nick);
		$this->view->generate('UserPost_view.php', $data);
	}

}
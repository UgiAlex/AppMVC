<?php

class Controller_Post extends Controller
{
	
	function __construct()
	{
		$this->model = new Model_Post();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->slim();		
		$this->view->generate('post_view.php', 'template_view.php', $data);
	}
}
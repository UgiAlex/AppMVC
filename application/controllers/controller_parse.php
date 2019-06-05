<?php

class Controller_Parse extends Controller
{

	function __construct()
	{
		$this->model = new Model_Parse();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->ParsePage();	
		$this->view->generate('parse_view.php', 'template_view.php', $data);
	}
}
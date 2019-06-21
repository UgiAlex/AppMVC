<?php

class Controller_Post extends Controller
{

	function __construct()	{
		$this->model = new Model_Post();
		$this->view = new View();
	}

	function action_index()	{
		$data = $this->model->SelectAll();		
		$this->view->generate('post_view.php', $data);
	}	
	
	function action_parse()	{
		$data = $this->model->ParsePost();	
		$this->view->generate('parse_view.php', $data);
	}

	function action_post($id)	{
		$data = $this->model->SelectOne($id);
		$this->view->generate('news_view.php', $data);
	}

}
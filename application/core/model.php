<?php

class Model
{
	protected $db;
	
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

		$this->db = ORM::configure('sqlite:./demo.sqlite');
		$this->db = ORM::get_db()->exec("CREATE TABLE IF NOT EXISTS News (id INTEGER PRIMARY KEY, Title TEXT, TimePublic TEXT, Comments TEXT);");
	}

	public function SelectAll()
	{	}
}
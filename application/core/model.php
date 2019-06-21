<?php

class Model
{
	protected $db;
	
	public function __construct() {

		$this->db = ORM::configure('sqlite:./demo.sqlite');
		$this->db = ORM::get_db()->exec("CREATE TABLE IF NOT EXISTS News (id INTEGER PRIMARY KEY, Author TEXT, Nickname TEXT, Title TEXT, TimePublic TEXT, Comments TEXT);");
	}

}
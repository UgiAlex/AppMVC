<?php

class Model_User extends Model
{

	public function SelectUsers() {
		$data = $this->db = ORM::forTable('News')->distinct()->selectMany('Author', 'Nickname')->findMany();
		return $data;
	}

	public function SelectUsersPost($nick) {
		$data = $this->db = ORM::forTable('News')->where('Nickname', $nick)->findMany();
		return $data;
	}

}
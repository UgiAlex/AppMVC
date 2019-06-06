<?php

class Model_Data extends Model
{
	public function SelectAll() {
		$data = $this->db = ORM::forTable('News')->orderByDesc('TimePublic')->findMany();
		return $data;
	}

	public function GetPost($index) {
		$data = $this->db = ORM::forTable('News')->where('id', $index)->findOne();
		return $data;
	}
}

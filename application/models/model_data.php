<?php

class Model_Data extends Model
{
	public function SelectAll() {
		$data = $this->db = ORM::forTable('News')->orderByDesc('TimePublic')->findMany();
		return $data;
	}

}

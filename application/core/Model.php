<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = ORM::configure('sqlite:./demo.sqlite');
        $this->db = ORM::get_db()->exec('CREATE TABLE IF NOT EXISTS News (id INTEGER PRIMARY KEY, id_Author INTEGER, Title TEXT, TimePublic TEXT, Comments TEXT);');
        $this->db = ORM::get_db()->exec('CREATE TABLE IF NOT EXISTS Authors (id INTEGER PRIMARY KEY, Name TEXT, Nickname TEXT)');
    }
}

<?php

class ControllerUser {

    public function __construct() {
        $this->model = new ModelUser();
        $this->view = new View();
    }

    public function parseUser() {
        $data = $this->model->parseUser();
        $this->view->generate('Parse.php');
    }

    public function selectAllUser() {
        $data = $this->model->SelectAllUsers();
        $this->view->generate('Authors.php', $data);
    }

}

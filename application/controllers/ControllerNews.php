<?php

class ControllerNews
{
    public function __construct()
    {
        $this->model = new ModelNews();
        $this->view = new View();
    }

    public function mainPage()
    {
        $data = $this->model->selectAllNews();
        $this->view->generate('News.php', $data);
    }

    public function parsePages()
    {
        $data = $this->model->parse();
        $this->view->generate('Parse.php');
    }

    public function readPost($id)
    {
        $data = $this->model->selectOneNews($id);
        $this->view->generate('Post.php', $data);
    }

    public function authors()
    {
        $data = $this->model->selectAuthors();
        $this->view->generate('Authors.php', $data);
    }

    public function authorNews($nickname)
    {
        $data = $this->model->selectAuthorNews($nickname);
        $this->view->generate('AuthorNews.php', $data);
    }
}

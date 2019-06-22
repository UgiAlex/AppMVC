<?php
class ControllerNews extends Controller
{
    public function __construct()
    {
        $this->model = new ModelNews();
        $this->view = new View();
    }

    public function ActionIndex()
    {
        $data = $this->model->SelectAllNews();
        $this->view->generate('post_view.php', $data);
    }    
    
    public function ActionParse()
    {
        $data = $this->model->Parse();
        $this->view->generate('parse_view.php');
    }

    public function ActionPost($id)
    {
        $data = $this->model->SelectOneNews($id);
        $this->view->generate('news_view.php', $data);
    }
    
    public function ActionUserPost($nickname)
    {
        $data = $this->model->SelectAuthorNews($nickname);
        $this->view->generate('UserPost_view.php', $data);
    }

    public function ActionUser()
    {
        $data = $this->model->SelectAuthors();
        $this->view->generate('Users_view.php', $data);
    }
}

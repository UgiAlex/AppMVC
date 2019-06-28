<?php

class ModelNews extends Model {

    public function parseNews() {
        $Authors = ModelNews::selectAuthors();

        foreach ($Authors as $Author) {
            $pageUserPost = file_get_contents('https://habr.com/ru/users/' . $Author['Nickname'] . '/posts/');
            $parseUserPost = new nokogiri($pageUserPost);
             
            $title = $parseUserPost->get('.post__title_link')->toArray();
            $time = $parseUserPost->get('.post__time')->toArray();
            $comments = $parseUserPost->get('.post-stats__comments-count')->toArray();
            for ($i = 0; $i < 5; $i++) {
                // Далее чтобы не засорять таблицу идентичными записями проверяем есть ли новость с подобным заголовком
                $CheckNews = ORM::forTable('News')->where('Title', $title[$i]['#text'][0])->findOne();
                // Если запись есть обновим содержимое столбца "Комментарии"
                if ($CheckNews == false) {
                    $News = ORM::for_table('News')->create();
                    $News->id_Author = $Author['id'];
                    $News->Title = $title[$i]['#text'][0];
                    $News->TimePublic = $time[$i]['#text'][0];
                    $News->Comments = $comments[$i]['#text'][0];
                    $News->save();
                }
            }
        }
    }

    public function selectAllNews() {
        $data = $this->db = ORM::forTable('News')->orderByDesc('TimePublic')->findMany();
        return $data;
    }

    public function selectOneNews($id) {
        $data = $this->db = ORM::forTable('News')->findOne($id);
        return $data;
    }

    public function selectAuthors() {
        $data = $this->db = ORM::forTable('Authors')->findMany();
        return $data;
    }

    public function selectAuthorNews($nickname) {
        $id_Author = $this->db = ORM::forTable('Authors')->where('Nickname', $nickname)->select('id')->findOne();
        $data = $this->db = ORM::forTable('News')->where('id_Author', $id_Author['id'])->findMany();
        return $data;
    }

}

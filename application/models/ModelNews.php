<?php

class ModelNews extends Model {

    public function parse() {
        $pageUser = file_get_contents('https://habr.com/ru/users/');
        $parseUser = new nokogiri($pageUser);
        $author = $parseUser->get('.list-snippet__fullname')->toArray();
        $nick = $parseUser->get('.list-snippet__nickname')->toArray();
        for ($i = 0; $i < 10; $i++) {
            $pageUserPost = file_get_contents($author[$i]['href'] . 'posts/');
            $parseUserPost = new nokogiri($pageUserPost);
            // Получим все записи со страницы в массивы, 
            $title = $parseUserPost->get('.post__title_link')->toArray();
            $time = $parseUserPost->get('.post__time')->toArray();
            $comments = $parseUserPost->get('.post-stats__comments-count')->toArray();
            for ($j = 0; $j < 5; $j++) {
                // Далее чтобы не засорять таблицу идентичными записями проверяем есть ли новость с подобным заголовком
                $CheckNews = ORM::forTable('News')->where('Title', $title[$j]['#text'][0])->findOne();
                // Если запись есть обновим содержимое столбца "Комментарии"
                if ($CheckNews == false) {
                    $News = ORM::for_table('News')->create();
                    $News->id_Author = $i;
                    $News->Title = $title[$j]['#text'][0];
                    $News->TimePublic = $time[$j]['#text'][0];
                    $News->Comments = $comments[$j]['#text'][0];
                    $News->save();
                }
            }
            $CheckAuthor = ORM::forTable('Authors')->where('Nickname', $nick[$i]['#text'][0])->findOne();
            if ($CheckAuthor == false) {
                $Author = ORM::forTable('Authors')->create();
                $Author->Name = $author[$i]['#text'][0];
                $Author->Nickname = $nick[$i]['#text'][0];
                $Author->save();
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
        $data = $this->db = ORM::forTable('Authors')->distinct()->selectMany('Name', 'Nickname')->findMany();
        return $data;
    }

    public function selectAuthorNews($nickname) {
        $id_Author = $this->db = ORM::forTable('Authors')->where('Nickname', $nickname)->select('id')->findOne();
        $data = $this->db = ORM::forTable('News')->where('id_Author', $id_Author['id'] - 1)->findMany();
        return $data;
    }

}

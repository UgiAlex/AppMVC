<?php

class ModelUser extends Model {

    public function parseUser() {
        $pageUser = file_get_contents('https://habr.com/ru/users/');
        $parseUser = new nokogiri($pageUser);
        $author = $parseUser->get('.list-snippet__fullname')->toArray();
        $nick = $parseUser->get('.list-snippet__nickname')->toArray();
        for ($i=0; $i < 10; $i++) {
            $CheckAuthor = ORM::forTable('Authors')->where('Nickname', $nick[$i]['#text'][0])->findOne();
            if ($CheckAuthor == false) {
                $Author = ORM::forTable('Authors')->create();
                $Author->Name = $author[$i]['#text'][0];
                $Author->Nickname = $nick[$i]['#text'][0];
                $Author->save();
            }
        }
    }

    public function SelectAllUsers() {
        $data = $this->db = ORM::forTable('Authors')->findMany();
        return $data;
    }

}

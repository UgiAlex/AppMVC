<?php

require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";

class Model_Post extends Model
{

	public function ParsePage() {

		$page = file_get_contents('https://habr.com/ru/');
		$saw = new nokogiri($page);

		// Получаем значения с элементов страницы
		$title = $saw->get('.post__title_link')->toArray();
		$time = $saw->get('.post__time')->toArray();
		$comments = $saw->get('.post-stats__comments-count')->toArray();

		for ($i=0; $i < 5; $i++) { 
			// Далее чтобы не засорять таблицу идентичными записями проверяем есть ли новость с подобным заголовком
			$Check = ORM::forTable('News')->where('Title', $title[$i]['#text'][0])->findOne();
			// Если запись есть обновим содержимое столбца "Комментарии"
			if ($Check == true) {
				$Check->TimePublic = Model_Post::GetDateTime($time[$i]['#text'][0]);
				$Check->Comments = $comments[$i]['#text'][0];
				$Check->save();
			}
			// Если запись не нашлась создаем новую запись в БД
			else {
				$News = ORM::for_table('News')->create();
				$News->Title = $title[$i]['#text'][0];
				$News->TimePublic = Model_Post::GetDateTime($time[$i]['#text'][0]);
				$News->Comments = $comments[$i]['#text'][0];
				$News->save();
			}

		}

		return [
			'title' => $title,
			'time' => $time,
			'comments' => $comments,
		];
	}

	public function SelectAll() {

		$data = $this->db = ORM::forTable('News')->orderByDesc('TimePublic')->findMany();
		return $data;

	}

	public function SelectOne() {
		
		$app = new \Slim\Slim();

		$app->get('/post/news/:index', function($index) {
			
		});

		$app->run();
			
			$data = $_SERVER['REQUEST_URI'];
			return $data;
	}

	public function GetDateTime($string) {

		$DateString = explode(' ', $string);
		if ($DateString[0] == 'вчера') {
			$Date = date('Y/m/d',strtotime("-1 days"));
		}
		if ($DateString[0] == 'сегодня') {
			$Date = date('Y/m/d');
		}

		return $DateTime = $Date.' '.$DateString[2];

	}
}
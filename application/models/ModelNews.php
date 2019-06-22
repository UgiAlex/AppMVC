<?php

class Model_Post extends Model
{

	// echo "<pre>"; print_r($a); echo "</pre>";

	public function ParsePost() {

		$pageUser = file_get_contents('https://habr.com/ru/users/');
		$parseUser = new nokogiri($pageUser);

		$author = $parseUser->get('.list-snippet__fullname')->toArray();
		$nick = $parseUser->get('.list-snippet__nickname')->toArray();
		
		for ($i=0; $i < 10; $i++) { 
			
			$pageUserPost = file_get_contents($author[$i]['href'].'posts/');
			$parseUserPost = new nokogiri($pageUserPost);

			// Получим все записи со страницы в массивы, 
			$title = $parseUserPost->get('.post__title_link')->toArray();
			$time = $parseUserPost->get('.post__time')->toArray();
			$comments = $parseUserPost->get('.post-stats__comments-count')->toArray();

			for ($j=0; $j < 5; $j++) { 

				// $data[] = [
				// 	'author' => $author[$i]['#text'][0],
				// 	'title'  => $Title[$j]['#text'][0],
				// ];					

				// Далее чтобы не засорять таблицу идентичными записями проверяем есть ли новость с подобным заголовком
				$Check = ORM::forTable('News')->where('Title', $title[$j]['#text'][0])->findOne();
				// Если запись есть обновим содержимое столбца "Комментарии"
				if ($Check == true) {
					$Check->Comments = $comments[$j]['#text'][0];
					$Check->save();
				}
				// Если запись не нашлась создаем новую запись в БД
				else {
					$News = ORM::for_table('News')->create();

					$News->Author     =	$author[$i]['#text'][0];
					$News->Nickname   = $nick[$i]['#text'][0];
					$News->Title      = $title[$j]['#text'][0];
					$News->TimePublic = $time[$j]['#text'][0];
					$News->Comments   = $comments[$j]['#text'][0];
					
					$News->save();
				}
			}
		}
		// echo "<pre>"; print_r($data); echo "</pre>";
	}

	public function SelectAll() {
		$data = $this->db = ORM::forTable('News')->orderByDesc('TimePublic')->findMany();
		return $data;
	}
	
	public function SelectOne($id) {
		$data = $this->db = ORM::forTable('News')->findOne($id);
		return $data;
	}
}



		// $pageUser = file_get_contents('https://habr.com/ru/');
		// $saw = new nokogiri($pageUser);

		// // Получаем значения с элементов страницы

		// $title = $saw->get('.post__title_link')->toArray();
		// $time = $saw->get('.post__time')->toArray();
		// $comments = $saw->get('.post-stats__comments-count')->toArray();

		// for ($i=0; $i < 10; $i++) { 
		// 	// Далее чтобы не засорять таблицу идентичными записями проверяем есть ли новость с подобным заголовком
		// 	$Check = ORM::forTable('News')->where('Title', $title[$i]['#text'][0])->findOne();
		// 	// Если запись есть обновим содержимое столбца "Комментарии"
		// 	if ($Check == true) {
		// 		$Check->TimePublic = Model_Post::GetDateTime($time[$i]['#text'][0]);
		// 		$Check->Comments = $comments[$i]['#text'][0];
		// 		$Check->save();
		// 	}
		// 	// Если запись не нашлась создаем новую запись в БД
		// 	else {
		// 		$News = ORM::for_table('News')->create();
		// 		$News->Title = $title[$i]['#text'][0];
		// 		$News->TimePublic = Model_Post::GetDateTime($time[$i]['#text'][0]);
		// 		$News->Comments = $comments[$i]['#text'][0];
		// 		$News->save();
		// 	}
		// }

		// return [
		// 	'title' => $title,
		// 	'time' => $time,
		// 	'comments' => $comments,
		// ];

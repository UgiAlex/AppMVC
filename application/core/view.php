<?php

class View
{
	
		// $content_file - Шаблон запрашиваемой страницы;
		// $template_file - Шаблон главной страницы;
		// $data - массив данных;
	
	function generate($content_view, $template_view, $data = null)
	{
		// Подключаем шаблон главной, в одном из блоков div будет встроен шаблон запрашиваемой страницы
		include 'application/views/'.$template_view;
	}
}

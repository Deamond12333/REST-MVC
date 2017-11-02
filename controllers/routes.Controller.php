<?php

	class routesController
	{
		/*public $mysqli = null;
		
		public function __construct()
		{
			global $mysqli;
			$mysqli = new mysqli("omstu.term", "root", "", "routes");
			
			if ($mysqli->connect_errno)
			{
				echo "Ошибка соединения: ", $mysqli->connect_error;
			}
			
			if (!$mysqli->set_charset("utf8"))
			{
				echo "Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error;
			}
		}*/
		
		public function getMethods()
		{
			return
			array
				(
					array ("href" => 'add', "link" => 'Добавить'),
					array ("href" => 'get', "link" => 'Получить'),
					array ("href" => 'delete', "link" => 'Удалить'),
					//array ("href" => 'showall', "link" => 'Показать всех')
				);
		}
	}
	
?>
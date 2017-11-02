<?php

	class usersController
	{
		public $mysqli = null;
		
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
		}
		
		public function getMethods()
		{
			return
			array
				(
					array ("href" => 'add', "link" => 'Добавить'),
					array ("href" => 'get', "link" => 'Получить'),
					array ("href" => 'delete', "link" => 'Удалить'),
					array ("href" => 'showall', "link" => 'Показать всех')
				);
		}
		
		public function getArguments($method)
		{
			switch($method)
			{
				case "action_add": return array(1 => 'name');
				case "action_get": return array(0 => 'id');
				case "action_delete": return array(0 => 'id');
				case "action_showall": return null;
				default: return -1;
			}
		}
		
		public function action_add($name)
		{
			global $mysqli;
			$query = sprintf("INSERT INTO `routes`.`users` ( `id` , `name` ) VALUES (NULL , '%s');", $name);
			if (!$mysqli->query($query)) return 'Ошибка добавления!';
			return 'Пользователь с именем '.$name.' добавлен!';
		}
		
		public function action_get($id)
		{
			global $mysqli;
			$query = sprintf("SELECT * FROM users where users.id = '%s' ORDER BY `users`.`id` ASC;", $id);
			if ($result = $mysqli->query($query))
			{
				if ($row = $result->fetch_assoc()) return "Найден пользователь ".$row['id']." c именем ".$row['name'];
				else echo "Пользователь не найден!";
				$result->free();
			}
		}
		
		public function action_delete($id)
		{
			global $mysqli;
			$query = sprintf("DELETE FROM users WHERE users.id = '%s'", $id);
			if ($mysqli->query($query)) return "Удаление успешно завершено!";
			else return "Ошибка удаления!";
		}
		
		public function action_showall()
		{
			global $mysqli;
			$query = "SELECT * FROM users ORDER BY  `users`.`id` ASC";
			$report = array();
			if ($result = $mysqli->query($query))
			{
				$i = 0;
				while ($row = $result->fetch_assoc())
				{
					$report[$i] = $row;
					$i++;
				}
				$result->free();
				return $report;
			}
			else return 0;
		}
	}
	



//select users.name, route.addressFrom, route.addressTo, route.length from (select * from trip join users where users.id = trip.userId) join route where trip.routeid = route.id 
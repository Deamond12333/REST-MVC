<?php

	class Router
	{
		public static function getController()
		{
			// крошим урл
			$parts = explode("/", $_SERVER['REDIRECT_URL']);
			// отдаем входное меню
			if ($parts[1] == NULL)
			{
				include 'controllers/templates/controllers.form.php';
				return;
			}
			// проверяем наличие контроллера
			$class_name = $parts[1]."Controller";
			if (!file_exists("controllers/".$parts[1].".Controller.php")) throw new \Exception("Controller file does not exist!");
			require_once("controllers/".$parts[1].".Controller.php");
			$class = new $class_name();
			// отдаем меню с методами контроллера
			if ($parts[2] == NULL)
			{
				$menu = $class->getMethods();
				$template = '';
				foreach($menu as $key => $point)
				{
					$template .= "<li><a href='".$parts[1]."/".$point["href"]."'>".$point["link"]."</a></li>";
				}
				global $smarty;
				$smarty->assign('menu', $template);
				$smarty->display('methods.template.tpl');
				return;
			}
			// проверяем наличие формы
			if (!file_exists("controllers/templates/".$parts[1].".".$parts[2].".form.php")) 
			{
				// пришлось клепать дополнительный костыль из-за этого метода
				if ($parts[2] == 'showall')
				{
					$result = $class->action_showall();
					if ($_GET['client'] != null)
					{
					echo "id         name\r\n";
						foreach($result as $key => $user)
						{
							echo $user['id']."   ".$user['name']."\r\n";
						}
					}
					else
					{
						global $smarty;
						$smarty->assign('title', "Готово");
						if ($result != 0)
						{
							$list = '<ul>';
							for ($i = 0; $i < count($result); ++$i)
							{
								$list .= '<li> '.$result[$i]['id'].' => '.$result[$i]['name'].' </li>';
							}
							$list .= '</ul>';
							$smarty->assign('result', "Показать всех пользователей");
							$smarty->assign('showall', $list);
						}
						else $smarty->assign('result', "Таблица пуста...");
						$smarty->display('result.template.tpl');
					}
					return;
				}
				else throw new \Exception("Form file does not exist!");
			}
			else
			{
				// если показать нечего, то отдаем форму, иначе покаываем
				if ($_POST == null) include 'controllers/templates/'.$parts[1].'.'.$parts[2].'.form.php';
				else
				{
					$method = "action_".$parts[2];
					if (!method_exists($class, $method)) throw new \Exception("Method does not exist!");
					$arguments = $class->getArguments($method);
					$parameters = array();
					$i = 0;
					foreach($arguments as $key => $arg)
					{
						$parameters[$i] = $_POST[$arg];
						$i++;
					}
					$result = call_user_func_array($class_name.'::'.$method, $parameters);
					if ($_POST['client'] != null)
					{
						echo $result;
					}
					else
					{
						global $smarty;
						$smarty->assign('title', "Готово");
						$smarty->assign('result', $result);
						$smarty->display('result.template.tpl');
					}
				}
				return;
			}
		}
	}
	
?>
<?
	$f = new RouterFactory();
	try
	{
		$c = $f->getController($arr[1]);
		if ($c instanceof Controller)
		{
			$c->run($arr[2]);
		}
	}
	catch(Exception $e)
	{
		// Controller not found
	}
?>

<?
	class RouterFactory
	{
		public function getController($route)
		{
			if ($route == 'users') return new usersController();
			if ($route == 'schedule') return new scheduleController();
		}
	}
?>

<?
	class scheduleController extends Controller
	{
		public function run($param)
		{
			echo "I'm schedule controller!";
		}
	}
?>

<?
	class usersController extends Controller
	{
		public function run($param)
		{
			echo "I'm users controller!";
		}
	}
?>

<?
	abstract class Controller
	{
		abstract public function run($param);
	}
	
	/*
	
	
	$numargs = $class->countOfParameters($method);
	echo $numargs;
	$params = explode("&", $query);
	$parameters = array();
	$numparams = count($params);
	if ($numargs != $numparams) throw new \Exception("Invalid number of parameters!");
	$i = 0;
	foreach($params as $key => $value)
	{
		$parts = explode("=", $value);
		$parameters[$i] = $parts[1];
		$i++;
	}
	call_user_func_array($class_name.'::'.$method, $parameters);
	
	
	$parts = explode("/", urldecode($_SERVER["REDIRECT_URL"]));
	echo '<pre>';
	var_dump($_SERVER);
	/*echo '</pre>';
	$controllerName = $parts[1].'Controller';
	$controller = new $controllerName();
	if ($parts[2] == 'add'):
		$controller -> action_add(array_splice($parts, 3));
	else:
		$functionName = 'action_'.$parts[3];
		$controller -> $functionName($parts[2]);
	endif;
	
	---- Домашка ---- 
	
	CURL
	
	regexp
	{
		$reg = '~(8|\+7|7)\(?([0-9]{3})\)?[ -]?([0-9]{3}[ -]?[0-9]{4})~ui';
		$matches = array();
		if (preg_match($reg, 'something strings', $matches))
		{
			echo '<pre>';
			
		}
	}
	
	фабричный метод, абстрактная фабрика, паттерн проектирования "фабрика"
	
	
	*/
?>
<?php

	include 'C:/Users/Public/OpenServer/domains/smarty/libs/Smarty.class.php';
	$smarty = new Smarty();
	$smarty->template_dir = 'C:/Users/Public/OpenServer/domains/omstu.term/controllers/templates/';
	$smarty->compile_dir = 'C:/Users/Public/OpenServer/domains/omstu.term/controllers/templates_c/';
	$smarty->config_dir = 'C:/Users/Public/OpenServer/domains/omstu.term/controllers/configs/';
	$smarty->cache_dir = 'C:/Users/Public/OpenServer/domains/omstu.term/controllers/cache/';
	
	//header("Content-Type: text/html; Charset=utf-8;");
	//header("My-TAG: TEST;");
	
	$files = glob("controllers/*.Controller.php");
	foreach ($files as $key => $file) require_once($file);
	require_once ('router.php');
	
	$router = new Router();
	try
	{
		$router->getController();
	}
	catch(Exception $e)
	{
		echo $e;
	}
	
?>
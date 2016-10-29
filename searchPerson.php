<?php
	//This is blah
	
	//HTTPS Check, seems to break android
	/*if($_SERVER['SERVER_PORT'] !== 443 && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) 
	{
		header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit;
	}*/
	
	//Database Start
	session_start();
	try
	{
		$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', $_SERVER['DB_USER'],$_SERVER['DB_PASS']);
	}
	catch (PDOException $e) 
	{
		die('-1 ' . $e->getMessage());
	}
	
	//Get HTTPS response ready
	
	//Check parameters
	try
	{
		$link->beginTransaction();
		//Insert code here
		$result = $link->prepare("SELECT * FROM person ORDER BY name DESC;");
		$success = $result -> execute();	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("-1 ".$result->errorInfo());
		}
		
		$row = $result -> fetchAll();
		$json = json_encode($row);
		echo "Confirmation.".$json;
		$result = null;
		$link->commit();	
		
	}
	catch(Exception $e)
	{
		echo "-1 ".$e->getMessage();
	}
	
	$link = null;
?>
<?php
	//This is blah
	
	//HTTPS Check
	if($_SERVER['SERVER_PORT'] !== 443 && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) 
	{
		header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit;
	}
	
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
	//Getting values
	$person_id = (int) htmlspecialchars($_POST["person_id"], ENT_QUOTES, 'UTF-8');
	$phrase = htmlspecialchars($_POST["phrase"], ENT_QUOTES, 'UTF-8');
	$file_path = htmlspecialchars($_POST["file_path"], ENT_QUOTES, 'UTF-8');
	
	//Check parameters
	try
	{
		$link->beginTransaction();
		//Insert code here
		$result = $link->prepare("INSERT INTO recording VALUES (?,?,?);");
		$success = $result -> execute(array($person_id, $phrase, $file_path));	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("-1 ".$result->errorInfo());
		}
		
		echo "Confirmation";
		$result = null;
		$link->commit();	
		
	}
	catch(Exception $e)
	{
		echo "-1 ".$e->getMessage();
	}
	
	$link = null;
?>
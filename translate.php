<?php
	//This is blah
	
	//HTTPS Check
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
		die('Connection failed: ' . $e->getMessage());
	}
	
	//Get HTTPS response ready
	$person_id = (int) htmlspecialchars($_POST["person_id"], ENT_QUOTES, 'UTF-8');
	$match_me = htmlspecialchars($_POST["match_me"], ENT_QUOTES, 'UTF-8');
	
	//Check parameters
	try
	{
		$link->beginTransaction();
		//Insert code here
		$result = $link->prepare("SELECT * FROM recording WHERE person_id = ?;");
		$success = $result -> execute($person_id);	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("Failed due to:\n ".$result->errorInfo());
		}
		
		$row = $result -> fetchAll();
		for()
		{
			
		}
		echo "Confirmation.".$json;
		$result = null;
		$link->commit();	
		
	}
	catch(Exception $e)
	{
		echo "Failed ".$e->getMessage();
	}
	
	$link = null;
?>
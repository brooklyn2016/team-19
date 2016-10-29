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
		$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', "ex221","thegame66613");
		//$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', $_SERVER['DB_USER'],$_SERVER['DB_PASS']);
	}
	catch (PDOException $e) 
	{
		die('Connection failed: ' . $e->getMessage());
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
		$result = $link->prepare("UPDATE recording SET filepath = ? WHERE phrase = ? AND person_id = ?;");
		$success = $result -> execute(array($file_path,$phrase,$person_id));	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("Failed due to:\n ".$result->errorInfo());
		}
		echo "Confirmation";
		$result = null;
		$link->commit();	
		
	}
	catch(Exception $e)
	{
		echo "Failed ".$e->getMessage();
	}
	
	$link = null;
	
	
	
?>
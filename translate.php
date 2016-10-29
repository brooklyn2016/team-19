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
		//$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', $_SERVER['DB_USER'],$_SERVER['DB_PASS']);
		$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', "ex221","thegame66613");
	}
	catch (PDOException $e) 
	{
		die('-1 ' . $e->getMessage());
	}
	
	//Get HTTPS response ready
	$person_id = (int) htmlspecialchars($_POST["person_id"], ENT_QUOTES, 'UTF-8');
	$match_me = htmlspecialchars($_POST["match_me"], ENT_QUOTES, 'UTF-8');
	
	//Check parameters
	try
	{
		$link->beginTransaction();
		//Insert code here
		$result = $link->prepare("SELECT phrase, filepath FROM recording WHERE person_id = ?;");
		$success = $result -> execute(array($person_id));	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("-1 ".$result->errorInfo());
		}
		
		$row = $result -> fetchAll();
	
		$found = false;
		$explos = explode(" ", $match_me);
		for($i = 0; $i < count($explos); $i++)
		{
			for($y = 0; $y < count($row); $y++)
			{
				if(strcmp($explos[$i],$row[$y][0]) == 0)
				{
					echo $row[$y][1]." ";
					break;
				}
			}
		}
		
		$result = null;
		$link->commit();
	}
	catch(Exception $e)
	{
		echo "-1 ".$e->getMessage();
	}
	
	$link = null;
?>
<?php
	//This is blah
	
	//HTTPS Check
	/*if($_SERVER['SERVER_PORT'] !== 443 && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')) 
	{
		header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		exit;
	}*/
	
	//Database Start
	function test($string, $stuff, $grub)
	{
		if(strlen($string) == 0)
		{
			return;
		}
		$nofound = false;
		for($i = 0; $i <= strlen($string); $i++)
		{
			$test = substr($string, 0, $i);
			for($y = 0; $y < count($stuff); $y++)
			{
				
				//echo strstr($string, $stuff[$y][0]) ." ";
				if(strlen($string) >= strlen($stuff[$y][0]) AND strpos($string, $stuff[$y][0]))
				{
					$nofound = true;
					//echo "!!".$string." ".$stuff[$y][0]."!!</br>";
					test(substr($string, strpos($string, $stuff[$y][0]) + strlen($stuff[$y][0])) , $stuff, $grub." ".$stuff[$y][1]);
				}
			}
		}
		
		if($nofound == false || strlen($string) == 0)
		{
			echo $grub;
		}
	}
	
	session_start();
	try
	{
		//$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', $_SERVER['DB_USER'],$_SERVER['DB_PASS']);
		$link = new PDO('pgsql:host=passdb.czwtincxuane.us-west-2.rds.amazonaws.com;port=5432;dbname=codeforgood', "ex221","thegame66613");
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
		$result = $link->prepare("SELECT phrase, filepath FROM recording WHERE person_id = ?;");
		$success = $result -> execute(array($person_id));	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("Failed due to:\n ".$result->errorInfo());
		}
		
		$row = $result -> fetchAll();
		$found = false;
		
		$grub = "";
		$stuff = test($match_me, $row, $grub);
		
		$result = null;
		$link->commit();
	}
	catch(Exception $e)
	{
		echo "Failed ".$e->getMessage();
	}
	
	$link = null;
?>
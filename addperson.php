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

	//Getting values
	$name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
	
	//Check parameters
	if((strlen($name) > 64) or (strlen($name) < 0))
	{
		die ("Failed due to bad parameters\n");
	}
	
	try
	{
		$link->beginTransaction();
		//Insert code here
		$result = $link->prepare("SELECT max(person_id) FROM person;");
		$success = $result -> execute();	
		if(!$success)
		{
			$result = null;
			$link = null;
			die("Failed due to:\n ".$result->errorInfo());
		}
		
		$row = $result -> fetch(PDO::FETCH_NUM);
		$maxperson_id = (int)($row[0]);
		$maxperson_id += 1;
		$result = null;			
		
		$uploaddir = 'uploads/';
		$uploadfile = $uploaddir . $maxperson_id."-".basename($_FILES["profilefile"]['name']);
		if (move_uploaded_file($_FILES["profilefile"]['tmp_name'], $uploadfile))
		{
			//Get new file
			$result = $link->prepare("INSERT INTO person VALUES (?, ?, ?);");
			$success = $result -> execute(array($maxperson_id, $name, $uploadfile));	
			if(!$success)
			{
				$link->rollBack();
				$error = implode($result->errorInfo());
				$result = null;
				$link = null;	
				die("Failed due to:\n ".$error);
			}
			$result = null;
			//Commit time
			echo "Confirmation\n";
			$link->commit();
		} 
		else 
		{
			$link->rollBack();
			$result = null;
			$link = null;
			echo "Failure due to upload failed";
		}
	}
	catch(Exception $e)
	{
		echo "Failed ".$e->getMessage();
	}
	
	$link = null;
?>
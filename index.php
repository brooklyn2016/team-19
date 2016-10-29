<html>
<head>
</head>
<body>
	<a>
		<h1>addperson:</h1></br>
		<form action="addperson.php" method="post" enctype="multipart/form-data">
			name: </br><input type="text" name="name"></br>
			file: <input type="file" name="profilefile" id="profilefile"></br>
			<input type="submit">
		</form>
	</a>
	
	<a>
		<h1>Add Phrase:</h1></br>
		<form action="addPhrase.php" method="post">
			person_id: <br><input type="text" name="person_id"><br>
			phrase: <br><input type="text" name="phrase"><br>
			file_path: <br><input type="text" name="file_path"><br>
			<input type="submit">
		</form>
	</a>
	
	<a>
		<h1>correct</h1></br>
		<form action="correct.php" method="post">
			person_id: <br><input type="text" name="person_id"><br>
			phrase: <br><input type="text" name="phrase"><br>
			file_path: <br><input type="text" name="file_path"><br>
			<input type="submit">
		</form>
	</a>
	
	<a>
		<h1>translate</h1></br>
		<form action="translate.php" method="post">
			person_id: <br><input type="text" name="person_id"><br>
			match_me: <br><input type="text" name="match_me"><br>
			<input type="submit">
		</form>
	</a>
	
	<a>
		<h1>translate2</h1></br>
		<form action="translate2.php" method="post">
			person_id: <br><input type="text" name="person_id"><br>
			match_me: <br><input type="text" name="match_me"><br>
			<input type="submit">
		</form>
	</a>
</body>
</html>
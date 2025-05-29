<?php 

		function securisation($donnee)
		{
			$donnee = trim($donnee);
			$donnee = stripslashes($donnee);
			$donnee = strip_tags($donnee);
			return $donnee;
		}

		$server = "localhost";
		$login = "root";
		$based = "aziz";
		$pass = "";

		try 
		{
			$conn = new PDO("mysql:host=$server;dbname=$based",$login,$pass);
			$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			echo "Impossible ".$e->getMessage();
		}

 ?>

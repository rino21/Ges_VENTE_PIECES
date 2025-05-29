<?php 
		function est_connect()
		{
			if(session_status()===PHP_SESSION_NONE)
			{
				session_start();
			}
			return !empty($_SESSION['connecte']);
		}

		function obligatoire()
		{
			if(!est_connect())
			{
				header("Location: ./index.php");
				exit();
			}
		}
 ?>
<?php
	Class Connection {

		function connection(){

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "expediente";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			!$conn->set_charset("utf8");
			
			return $conn;
		}

	}

?>
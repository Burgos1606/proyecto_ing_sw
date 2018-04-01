<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$conn->connection();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	
	
?>

<html>
	<head>
		<?php head(); ?>
	</head>
	<body>
		
		<?php navbar(); ?>

		<div class="container">
			
			<div class="page-header">
				<h1>Expedientes Medicos</h1>
			</div>

			

		</div>

	</body>
</html>
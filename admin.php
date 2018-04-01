<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$conn->connection();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	
	if($_SESSION['rol'] != '1'){
		header('Location: index.php'); 
	}
	
?>

<html>
	<head>
		<?php head(); ?>
	</head>
	<body>
		
		<?php navbarAdmin(); ?>

		<div class="container">
			
			<div class="page-header">
				<h1>Médico</h1>
			</div>

			<img src="Portadas/inicio.jpg" class="img-responsive" alt="Responsive image">

		</div>

	</body>
</html>
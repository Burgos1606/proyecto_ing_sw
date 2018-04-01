<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$conn->connection();
	$connection = $conn->connection();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	
	if($_SESSION['rol'] != '1'){
		header('Location: index.php'); 
	}

	$selectDiseases = "SELECT * FROM catalogoEnfermedades;";
	$AllDiseases = $connection->query($selectDiseases);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carga de Libros</title>
		<?php head(); ?>
		<script src="js/funcionesBook.js"></script>
	</head>
	<body>

		<?php navbarAdmin(); ?>		

		<div class="container">

			<div class="page-header">
				<h1>Enfermedades</h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<?php
					if($AllDiseases->num_rows > 0){
				?>
				<table class="table">
					<thead>
						<tr>
							<th>Enfermedad</th>
							<th>Descripción</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$i = 0;
					while ($disease = $AllDiseases->fetch_assoc()) {
					$i++;
				?>
						<tr>
							<td><?php echo $disease['nombre']; ?></td>
							<td><?php echo $disease['descripcion']; ?></td>
						</tr>
				<?php
					}
				?>
					</tbody>
				</table>
				<?php
				}
					if($AllDiseases->num_rows == 0)
					echo "<div class=\"page-header\">
						  	<h3>Sin enfermedades registradas.</h3>
						</div>";
				?>
			</div>

		</div>

	</body>
</html>
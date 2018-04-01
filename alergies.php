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

	$selectAllergies = "SELECT c.nombre, c.descripcion as reaccion, t.nombre as tipo 
		FROM catalogoAlergias c 
		JOIN tipoalergia t ON c.idTipoAlergia = t.idTipoAlergia;";
	$AllAllergies = $connection->query($selectAllergies);

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
				<h1>Alergias</h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<?php
					if($AllAllergies->num_rows > 0){
				?>
				<table class="table">
					<thead>
						<tr>
							<th>Alergia</th>
							<th>Reacción</th>
							<th>Tipo</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$i = 0;
					while ($allergy = $AllAllergies->fetch_assoc()) {
					$i++;
				?>
						<tr>
							<td><?php echo $allergy['nombre']; ?></td>
							<td><?php echo $allergy['reaccion']; ?></td>
							<td><?php echo $allergy['tipo']; ?></td>
						</tr>
				<?php
					}
				?>
					</tbody>
				</table>
				<?php
				}
					if($AllAllergies->num_rows == 0)
						echo "<div class=\"page-header\">
						  	<h3>Sin alergias registradas.</h3>
						</div>";
				?>
			</div>
				
		</div>
	
	</body>
</html>
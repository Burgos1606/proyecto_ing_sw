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

	$selectUser = "SELECT * FROM fichaIdentificacion WHERE nombreAcceso = '".$_SESSION['user']."' ;";
	$user = $connection->query($selectUser)->fetch_assoc();

	$selectAlergiesUser = "SELECT c.nombre, c.descripcion as reaccion, t.nombre as tipo, r.riesgo, a.fechaRegistro 
		FROM alergiapaciente a 
		JOIN paciente p ON a.idPaciente = p.idPaciente 
		JOIN catalogoAlergias c ON c.idAlergia = a.idAlergia 
		JOIN tipoalergia t ON c.idTipoAlergia = t.idTipoAlergia 
		JOIN tipoRiesgo r ON r.idRiesgo = a.idRiesgo 
		JOIN fichaidentificacion f ON f.idFichaIdentificacion = p.idFichaIdentificacion 
		WHERE f.nombreAcceso = '".$_SESSION['user']."' ;";
	$AllAlergiesUser = $connection->query($selectAlergiesUser);

	$selectDiseasesUser = "SELECT c.nombre, c.descripcion, r.riesgo, e.fechaRegistro
		FROM enfermedadpaciente e 
		JOIN catalogoEnfermedades c ON c.idEnfermedad = e.idEnfermedad 
		JOIN paciente p ON e.idPaciente = p.idPaciente 
		JOIN tipoRiesgo r ON r.idRiesgo = e.idRiesgo 
		JOIN fichaidentificacion f ON f.idFichaIdentificacion = p.idFichaIdentificacion 
		WHERE f.nombreAcceso = '".$_SESSION['user']."' ;";
	$AllDiseasesUser = $connection->query($selectDiseasesUser);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carga de Libros</title>
		<?php head(); ?>
	</head>
	<body>

		<?php navbarAdmin(); ?>		

		<div class="container">

			<div class="page-header">
				<h1><?php echo $_SESSION["name"]; ?></h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<div class="row col-md-6">
					<label>Nombre: </label><?php echo " ".$user['nombre']." ".$user['apellidoPaterno']." ".$user['apellidoMaterno']; ?><br>
					<label>Fecha de Nacimiento: </label><?php echo " ".$user['fechaNacimiento']; ?><br>
					<label>Correo: </label><?php echo " ".$user['email']; ?><br>
					<label>Nombre acceso: </label><?php echo " ".$user['nombreAcceso']; ?><br>
					<label>Contraseña: </label><?php echo " ".$user['contrasena']; ?>
				</div>

			</div>

		</div>

		<div class="container">

			<div class="page-header">
				<h1>Alergias</h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<?php
					if($AllAlergiesUser->num_rows > 0){
				?>
				<table class="table">
					<thead>
						<tr>
							<th>Alergia</th>
							<th>Reacción</th>
							<th>Tipo</th>
							<th>Riesgo</th>
							<th>Fecha Registro</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$i = 0;
					while ($allergy = $AllAlergiesUser->fetch_assoc()) {
					$i++;
				?>
						<tr>
							<td><?php echo $allergy['nombre']; ?></td>
							<td><?php echo $allergy['reaccion']; ?></td>
							<td><?php echo $allergy['tipo']; ?></td>
							<td><?php echo $allergy['riesgo']; ?></td>
							<td><?php echo $allergy['fechaRegistro']; ?></td>
						</tr>
				<?php
					}
				?>
					</tbody>
				</table>
				<?php
				}
					if($AllAlergiesUser->num_rows == 0)
						echo "<div class=\"page-header\">
						  	<h3>Sin alergias registradas.</h3>
						</div>";
				?>
			</div>
				
		</div>

		<div class="container">

			<div class="page-header">
				<h1>Enfermedades</h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<?php
					if($AllDiseasesUser->num_rows > 0){
				?>
				<table class="table">
					<thead>
						<tr>
							<th>Enfermedad</th>
							<th>Descripción</th>
							<th>Riesgo</th>
							<th>Fecha Registro</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$i = 0;
					while ($disease = $AllDiseasesUser->fetch_assoc()) {
					$i++;
				?>
						<tr>
							<td><?php echo $disease['nombre']; ?></td>
							<td><?php echo $disease['descripcion']; ?></td>
							<td><?php echo $disease['riesgo']; ?></td>
							<td><?php echo $disease['fechaRegistro']; ?></td>
						</tr>
				<?php
					}
				?>
					</tbody>
				</table>
				<?php
				}
					if($AllDiseasesUser->num_rows == 0)
					echo "<div class=\"page-header\">
						  	<h3>Sin enfermedades registradas.</h3>
						</div>";
				?>
			</div>

		</div>
	
	</body>
</html>
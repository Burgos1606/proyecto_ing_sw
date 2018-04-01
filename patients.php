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

	$selectUsers = "SELECT * FROM fichaIdentificacion WHERE idTipoUsuario = 2;";
	$AllUsers = $connection->query($selectUsers);
	
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
				<h1>Pacientes Registrados</h1>
			</div>

			<div class="col-md-offset-2 col-md-8">
				
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php 
					$i = 0;
					while ($user = $AllUsers->fetch_assoc()) {
					$i++;
				?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="<?php echo $user['idFichaIdentificacion'];?>">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $user['nombreAcceso']; ?>" aria-expanded="true" aria-controls="<?php echo $user['nombreAcceso']; ?>">
									<?php echo $user['nombre']." ".$user['apellidoPaterno']." ".$user['apellidoMaterno']; ?>
								</a>
							</h4>
						</div>
						<div id="<?php echo $user['nombreAcceso']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="<?php echo $user['idFichaIdentificacion'];?>">
							<div class="panel-body">
								<div class="row col-md-6">
									<label>Nombre: </label><?php echo " ".$user['nombre']." ".$user['apellidoPaterno']." ".$user['apellidoMaterno']; ?><br>
									<label>Fecha de Nacimiento: </label><?php echo " ".$user['fechaNacimiento']; ?><br>
									<label>Correo: </label><?php echo " ".$user['email']; ?><br>
									<label>Nombre acceso: </label><?php echo " ".$user['nombreAcceso']; ?><br>
									<label>Contraseña: </label><?php echo " ".$user['contrasena']; ?>
								</div>
								<div class="col-md-6 text-center">
									<img src="Perfil/<?php echo $user['nombreAcceso']; ?>" class="col-md-12">
								</div>
							</div>
						</div>
					</div>
				<?php
					}
					if($i == 0)
						echo "<div class=\"page-header\">
							  	<h3>Sin usuarios registrados.</h3>
							</div>";
				?>
				</div>
			</div>

		</div>
	
	</body>
</html>
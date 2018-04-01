<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$conn->connection();
	session_start();
	if($_SESSION)
		header('Location: index.php');
	else{

		if(isset($_POST['guardar'])){
			$nombre = $_POST['nombre']; 
			$ap_pat = $_POST['ap_pat'];
			$ap_mat = $_POST['ap_mat']; 
			$fecha_nac = $_POST['fecha_nac'];
			$correo = $_POST['correo'];
			$nick = $_POST['nick'];
			$pass = $_POST['pass'];
			$idInfo = rand(1, 10000);
			$rutaImg = $_FILES['imagen_perfil']['tmp_name'];
			$imagen_perfil = $idInfo.".jpg";
			$Perfil = "Perfil/".$imagen_perfil;

			if($imagen_perfil != "")
				copy($rutaImg, $Perfil);
			else
				$imagen_perfil = "Default.jpg";
		
			$insertUserInfo = "INSERT INTO usuariosinfo(
											info_usuario, nombre, ap_pat, ap_mat, fecha_nac, correo, imagen_perfil)
									VALUES(
											'$idInfo', '$nombre', '$ap_pat', '$ap_mat', '$fecha_nac', '$correo', '$imagen_perfil');";
			pg_query($insertUserInfo);

			$insertUser = "INSERT INTO usuarios(nick, pass, info_usuario, rol)
									VALUES('$nick', '$pass', '$idInfo', 'usuario');";
			$insertSuccess = pg_query($insertUser);

			if($insertSuccess){
				echo "<script src=\"js/jquery.min.js\"></script>";
				echo "<script>";
				echo "	$(document).ready(function(){";
				echo "		$('#modalSuccess').click();";
				echo "	});";
				echo "</script>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registro</title>
		<?php head(); ?>
	</head>
	<body>

		<?php navbar(); ?>		

		<div class="container">

			<div class="col-md-offset-3 col-md-6">

				<?php modalSuccessRegister(); ?>
				
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="row col-md-6">
						<div class="form-group">
							<label>Nombre(s):</label>
							<input type="text" name="nombre" class="form-control">
						</div>
						<div class="form-group">
							<label>Apellido Paterno:</label>
							<input type="text" name="ap_pat" class="form-control">
						</div>
						<div class="form-group">
							<label>Apellido Materno:</label>
							<input type="text" name="ap_mat" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Foto de Perfil:</label>
							<input type="file" name="imagen_perfil" id="imgProfile">
						</div>
						<div>
							<output id="list"></output>
							<?php imgProfileFunction(); ?>
						</div>
					</div>
					<div class="row col-md-12">
						<div class="form-group">
							<label>Fecha de Nacimiento: (yyyy/mm/dd)</label>
							<input type="text" name="fecha_nac" class="form-control">
						</div>
						<div class="form-group">
							<label>Correo:</label><br>
							<input type="email" name="correo" class="form-control">
						</div>
						<div class="form-group">
							<label>Nick:</label>
							<input type="text" name="nick" class="form-control">
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="pass" class="form-control">
						</div>
						<button type="submit" name="guardar" class="btn btn-success">Guardar</button>
					</div>
				</form>

			</div>

		</div>
	
	</body>
</html>
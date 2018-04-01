<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$connection = $conn->connection();
	session_start();
	if($_SESSION)
		header('Location: index.php');
	else{
		if (isset($_POST['login'])) {
			$user = $_POST["user"];
			$pass = $_POST["pass"];

			$query = "SELECT * FROM fichaidentificacion WHERE nombreAcceso = '$user' AND contrasena = '$pass'";
			$result = $connection->query($query);
		    if($result->num_rows > 0){
				session_start();
				$queryData = "SELECT * FROM fichaidentificacion WHERE nombreAcceso = '$user'";
				
				$resultData = $connection->query($queryData);

				$data = $resultData->fetch_assoc();

				$_SESSION["user"] = $data["nombreAcceso"];
				$_SESSION["name"] = $data["nombre"]." ".$data["apellidoPaterno"]." ".$data["apellidoMaterno"];
				$_SESSION["rol"] = $data["idTipoUsuario"];
				if($_SESSION["rol"] == '1')
					header('Location: admin.php');
				if($_SESSION["rol"] == '2')
					header('Location: index.php');


		    }else{
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
		<title>Login</title>
		<?php head(); ?>
	</head>
	<body>
		<?php navbar(); ?>
		
		<?php modalFailLogin(); ?>
		<div class="container">
			<div class="col-md-4 col-md-offset-4">
				<form method="POST" action="">
					<div class="form-group">
						<label >Usuario</label>
						<input name="user" class="form-control">
					</div>
					<div class="form-group">
						<label >Password</label>
						<input name="pass" type="password" class="form-control">
					</div>
					<button type="submit" class="btn btn-success" name="login">Ingresar</button>
				</form>
			</div>
		</div>	
		
	</body>
</html>
<?php
	include_once ("Conexion/conexion.php"); 
	include("head.php");
	$conn = new Connect();
	$conn->Conecta();
	
	if(isset($_POST['guardar'])){
		$nombre = $_POST['nombre']; 
		$ap_pat = $_POST['ap_pat'];
		$ap_mat = $_POST['ap_mat']; 
		$fecha_nac = $_POST['fecha_nac'];
		$correo = $_POST['correo'];
		$nick = $_POST['nick'];
		$pass = $_POST['pass'];
		$idInfo = rand(1, 10000);

	
		$insertUserInfo = "INSERT INTO usuariosinfo(
										info_usuario, nombre, ap_pat, ap_mat, fecha_nac, correo)
								VALUES(
										'$idInfo', '$nombre', '$ap_pat', '$ap_mat', '$fecha_nac', '$correo');";
		pg_query($insertUserInfo);

		$insertUser = "INSERT INTO usuarios(nick, pass, info_usuario)
								VALUES('$nick', '$pass', '$idInfo');";
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

?>
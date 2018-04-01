<?php
	
	include_once("../Conexion/conexion.php");
	$conn = new Connect();
	$conn->Conecta();

	$user = $_POST["user"];
	$pass = $_POST["pass"];

	$query = "SELECT * FROM usuarios WHERE nick='$user' AND pass='$pass'";
	$result = pg_query ($query);
    if(pg_num_rows($result) > 0){
		session_start();
		$queryData = "SELECT * FROM usuarios U JOIN usuariosinfo UI ON UI.info_usuario = U.info_usuario WHERE U.nick = '$user'";
		$resultData = pg_query($queryData);
		$data = pg_fetch_assoc($resultData);
		$_SESSION["user"] = $data["nick"];
		$_SESSION["name"] = $data["nombre"]." ".$data["ap_pat"]." ".$data["ap_mat"];
		header('Location: ../index.php'); 
    }else{
		echo "no estas registrado :v";
	}

?>
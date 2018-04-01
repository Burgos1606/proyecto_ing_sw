<?php
	include_once ("../Conexion/conexion.php"); 
	$conn = new Connect();
	$conn->Conecta();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	
	if($_SESSION['rol'] != 'admin'){
		header('Location: index.php'); 
	}

	$idSubida = $_POST['idSubida'];
	$activo = $_POST['activo'];
	
	if($activo == 0)
		$updateBook = "UPDATE subidas SET activo = 1 WHERE id_subidas = $idSubida";
	if($activo == 1) 
		$updateBook = "UPDATE subidas SET activo = 0 WHERE id_subidas = $idSubida";
	pg_query($updateBook);
?>
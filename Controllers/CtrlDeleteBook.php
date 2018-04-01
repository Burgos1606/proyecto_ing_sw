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

	$idBook = $_POST['idBook'];
	$deleteSubida = "DELETE FROM subidas WHERE id_libro = $idBook";
	pg_query($deleteSubida);
	$deleteBook = "DELETE FROM libros WHERE id_libro = $idBook";
	pg_query($deleteBook);
?>
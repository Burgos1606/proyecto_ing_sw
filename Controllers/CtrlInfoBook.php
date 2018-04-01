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
	$selectBook = "SELECT * FROM libros L INNER JOIN subidas S ON L.id_libro = S.id_libro WHERE S.id_libro = $idBook;";
	return pg_query($selectBook);
?>
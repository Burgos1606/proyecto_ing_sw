<?php
	include_once ("Conexion/Connection.php"); 
	include("head.php");
	$conn = new Connection();
	$conn->connection();
	session_start();
	session_destroy();
	header('Location: index.php'); 
?>
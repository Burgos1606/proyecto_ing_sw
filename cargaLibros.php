<?php
	include_once ("Conexion/conexion.php"); 
	include("head.php");
	$conn = new Connect();
	$conn->Conecta();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	
	
	if(isset($_POST['subir'])){
		$nombrePDF = $_FILES['archivo']['name'];
		$rutaPdf = $_FILES['archivo']['tmp_name'];
		$destinoPdf = "Libros/".$nombrePDF;

		$nombrePortada = $_FILES['portada']['name'];
		$rutaPortada = $_FILES['portada']['tmp_name'];
		$destinoPortada = "Portadas/".$nombrePortada;

		$titulo = $_POST['titulo']; 
		$editorial = $_POST['editorial'];
		$noPag = $_POST['noPag']; 
		$anioPub = $_POST['anioPub'];
		$descripcion = $_POST['descripcion'];

		if($nombrePortada != "")
			copy($rutaPortada, $destinoPortada);
		else
			$nombrePortada = "Default.jpg";
		

		if ($nombrePDF != ""){
			if (copy($rutaPdf, $destinoPdf)){

				$insertLibro = "INSERT INTO libros(
													titulo, editorial, no_pag, anio_pub, descripcion, portada)
										VALUES ('$titulo', '$editorial', $noPag, $anioPub, '$descripcion', '$nombrePortada');";
				pg_query($insertLibro);
				$selectLibro = "SELECT id_libro FROM libros 
								WHERE 	titulo = '$titulo'
								AND 	editorial = '$editorial'
								AND 	no_pag = $noPag
								AND 	anio_pub = $anioPub
								AND 	descripcion = '$descripcion'
								AND 	portada = '$nombrePortada';";
				$libroSelect = pg_query($selectLibro);
				$libro = pg_fetch_assoc($libroSelect);
				$idLibro = $libro['id_libro'];

				$insertSubida = "INSERT INTO subidas(
													  fecha_sub, id_libro, nickusuario, nombre_pdf, activo)
										VALUES (NOW(), $idLibro, '$idUser', '$nombrePDF', 0)";
				$insertSuccess = pg_query($insertSubida);

				if($insertSuccess){
					echo "<script src=\"js/jquery.min.js\"></script>";
					echo "<script>";
					echo "	$(document).ready(function(){";
					echo "		$('#modalSuccess').click();";
					echo "	});";
					echo "</script>";
				}

			}else{
				echo 'Error';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Carga de Libros</title>
		<?php head(); ?>
	</head>
	<body>

		<?php navbar(); ?>		

		<div class="container">

			<div class="col-md-offset-4 col-md-4">

				<?php modalSuccessCarga(); ?>
				
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label>Titulo:</label><br>
						<input type="text" name="titulo" class="form-control">
					</div>
					<div class="form-group">
						<label>Editorial:</label>
						<input type="text" name="editorial" class="form-control">
					</div>
					<div class="form-group">
						<label>Número de Paginas:</label>
						<input type="text" name="noPag" class="form-control">
					</div>
					<div class="form-group">
						<label>Año Publicación:</label>
						<input type="text" name="anioPub" class="form-control">
					</div>
					<div class="form-group">
						<label>Descipción:</label><br>
						<textarea rows="5" cols="50" name="descripcion" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Portada:</label>
						<input type="file" name="portada">
					</div>
					<div class="form-group">
						<label>Libro:</label>
						<input type="file" name="archivo">
					</div>
					<button type="submit" name="subir" class="btn btn-default">Subir Libro</button>
				</form>

			</div>

		</div>
	
	</body>
</html>
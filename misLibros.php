<?php
	include_once ("Conexion/conexion.php"); 
	include("head.php");
	$conn = new Connect();
	$conn->Conecta();
	session_start();
	if($_SESSION){
		$idUser = $_SESSION["user"];
	}	

	$selectLibros = "SELECT * FROM libros l join subidas s on l.id_libro = s.id_libro where s.nickusuario = '$idUser';";
	$libroSelect = pg_query($selectLibros);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mis Libros</title>
		<?php head(); ?>
	</head>
	<body>

		<?php navbar(); ?>

		<div class="container">
			
			<div class="page-header">
				<h1>Mis Libros</h1>
			</div>

			<?php 
				$i = 0;
				while ($libro = pg_fetch_assoc($libroSelect)) { 
					$i++; 
			?>
					<div class="col-xs-6 col-md-3">
						<a href="#" class="thumbnail">
						<?php 
							if($libro['activo'] == 1)
								echo "<img src=\"Portadas/".$libro['portada']."\" alt=\"".$libro['titulo']."\">";
							else
								echo "<img src=\"Portadas/".$libro['portada']."\" alt=\"".$libro['titulo']."\" style=\"filter: blur(6px);\">";
						?>
						</a>
					</div>
			<?php
					if ($i == 2) {
						echo "<div class = \"col-xs-12 visible-xs\"></div>";
					}
					if($i == 4){
						echo "<div class = \"col-xs-12 col-md-12\"></div>";
						$i = 0;
					}
				}
				if($i == 0)
					echo "<div class=\"page-header\">
						  	<h3>Sin libros registrados.<small><a href=\"cargaLibros.php\">(Registrar tu primer libro)</a></small></h3>
						</div>";
			?>

		</div>
	
	</body>
</html>
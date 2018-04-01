<?php 
	function head(){
?>
		<link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="Bootstrap/css/bootstrap-theme.min.css" >
		<script src="js/jquery.min.js"></script>
		<script src="Bootstrap/js/bootstrap.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	}
?>

<?php 
	function navbar(){
?>
	<nav class="navbar navbar-default ">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php 
						if($_SESSION 
								&& ($_SERVER['REQUEST_URI'] != '/biblioteca/cargaLibros.php'))
							echo "<a class=\"navbar-brand\" href=\"cargaLibros.php\">Cargar Libro</a>";		
						if($_SERVER['REQUEST_URI'] != '/biblioteca/' 
								&& $_SERVER['REQUEST_URI'] != '/biblioteca/index.php')
							echo "<a class=\"navbar-brand\" href=\"index.php\">Inicio</a>";	
						if($_SESSION 
								&& ($_SERVER['REQUEST_URI'] != '/biblioteca/misLibros.php'))
							echo "<a class=\"navbar-brand\" href=\"misLibros.php\">Mis Libros</a>";	
					?>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php
							if(isset($_SESSION["name"])){
								echo "<li class=\"hidden-xs hidden-sm\">
										<h3>
											<a href=\"perfil.php\">
												".$_SESSION["name"]."
											</a>
											<small>
												<a href=\"logout.php\">
													Cerrar sesion
												</a>
											</small>
										</h3>
									</li>";
								echo "<li class=\"visible-xs visible-sm\">
										<h3>
											<a href=\"perfil.php\">
												".$_SESSION["name"]."
											</a>
										</h3>
									</li>";
								echo "<li class=\"visible-xs visible-sm\">
										<h3>
											<a href=\"logout.php\">
												Cerrar Sesión
											</a>
										</h3>
									</li>";
							}
							else{
								if($_SERVER['REQUEST_URI'] != '/biblioteca/login.php')
									echo "<li>
											<h3>
												<a href=login.php>
													Iniciar Sesión
												</a>
											</h3>
										</li>";

								if($_SERVER['REQUEST_URI'] != '/biblioteca/register.php')
									echo "<li>
											<h3>
												<a href=register.php>
													Registrar
												</a>
											</h3>
										</li>";
							}
						?>				
					</ul>
				</div>
			</div>
		</nav>
<?php
	}
?>

<?php 
	function navbarAdmin(){
?>
	<nav class="navbar navbar-default ">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php 
						if($_SESSION['rol'] == '1'){
							if($_SERVER['REQUEST_URI'] != '/biblioteca/' 
									&& $_SERVER['REQUEST_URI'] != '/biblioteca/admin.php')
								echo "<a class=\"navbar-brand\" href=\"admin.php\">Inicio</a>";	
							if($_SESSION 
									&& ($_SERVER['REQUEST_URI'] != '/biblioteca/patients.php'))
								echo "<a class=\"navbar-brand\" href=\"patients.php\">Pacientes</a>";							
							if($_SESSION 
									&& ($_SERVER['REQUEST_URI'] != '/biblioteca/medics.php'))
								echo "<a class=\"navbar-brand\" href=\"medics.php\">Médicos</a>";	
							if($_SESSION 
									&& ($_SERVER['REQUEST_URI'] != '/biblioteca/alergies.php'))
								echo "<a class=\"navbar-brand\" href=\"alergies.php\">Alergias</a>";	
							if($_SESSION 
									&& ($_SERVER['REQUEST_URI'] != '/biblioteca/diseases.php'))
								echo "<a class=\"navbar-brand\" href=\"diseases.php\">Enfermedades</a>";
						}
					?>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<?php
							if(isset($_SESSION["name"])){
								echo "<li class=\"hidden-xs hidden-sm\">
										<h3>
											<a href=\"perfil.php\">
												".$_SESSION["name"]."
											</a>
											<small>
												<a href=\"logout.php\">
													Cerrar sesion
												</a>
											</small>
										</h3>
									</li>";
								echo "<li class=\"visible-xs visible-sm\">
										<h3>
											<a href=\"perfil.php\">
												".$_SESSION["name"]."
											</a>
										</h3>
									</li>";
								echo "<li class=\"visible-xs visible-sm\">
										<h3>
											<a href=\"logout.php\">
												Cerrar Sesión
											</a>
										</h3>
									</li>";
							}
							else{
								echo "<li>
										<h3>
											<a href=login.php>
												Iniciar Sesión
											</a>
										</h3>
									</li>";

								if($_SERVER['REQUEST_URI'] != '/biblioteca/register.php')
									echo "<li>
											<h3>
												<a href=register.php>
													Registrar
												</a>
											</h3>
										</li>";
							}
						?>				
					</ul>
				</div>
			</div>
		</nav>
<?php
	}
?>

<?php
	function modalSuccessCarga(){
?>
		<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-example-modal-sm" id="modalSuccess">...</button>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Guardado Exitoso.</h4>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>

<?php
	}
?>

<?php
	function modalSuccessRegister(){
?>
		<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-example-modal-sm" id="modalSuccess">...</button>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Guardado Exitoso.</h4>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>

<?php
	}
?>

<?php
	function modalFailLogin(){
?>
		<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-example-modal-sm" id="modalSuccess">...</button>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Error al ingresar.</h4>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>

<?php
	}
?>

<?php
	function imgProfileFunction(){
?>
		<script>
			function archivo(evt) {
				var files = evt.target.files; // FileList object
				for (var i = 0, f; f = files[i]; i++) {
					if (!f.type.match('image.*')) {
						continue;
					}
					var reader = new FileReader();
					reader.onload = (function(theFile) {
						return function(e) {
							document.getElementById("list").innerHTML = ['<img class="img-circle img-resposive col-md-12" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
						};
					})(f);
					reader.readAsDataURL(f);
				}
			}
			document.getElementById('imgProfile').addEventListener('change', archivo, false);
		</script>
<?php
	}
?>

<?php
	function modalDataBook(){
?>
		<button type="button" class="btn btn-primary hidden" data-toggle="modal" data-target=".bs-example-modal-sm" id="modalSuccess">...</button>

		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Error al ingresar.</h4>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>

<?php
	}
?>
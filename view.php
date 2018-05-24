<?php

public function head() {
	?>
		<!DOCTYPE html>
		<html lang="es">
			<head>
				<title>Foro Virtual Planes</title>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width">
				<link rel="stylesheet" href="css/estilo.css" />

			</head>
			<body>
				<div id="CajaPrincipal">
					<div class="cajaHeader">
						<div class="cajaBuscar">
							<form action='buscar.php' method='post'>
								<input type='text' name='busqueda' required="required">
								<input type='submit' name='Buscar' value='Buscar' class="btn">
							</form>
						</div>

						<div class="cajaRegistro">
							BIENVENIDO: 
							<?php
							if (isset($_SESSION["id"])) {
								?>
								<a href="perfil.php"><?php echo $_SESSION["nombre"]; ?></a> | 
								<?php
								if ($_SESSION["privileges"] == "admin") {
									?>
									<a href="panel.php">PANEL</a> | <a href="usuarios.php">LISTADO DE USUARIOS</a> | 
									<?php
								}
								?>
								<a href="salir.php">SALIR</a>
								<?php
							} else {
								?><a href="/index.php?action=register">REGISTRO</a> | <a href="/index.php?action=login">INICIAR SESIÓN</a><?php
							}
							?>
						</div>

						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
					</div>

					<div class="cajaBanner">

					</div>

					<div class="cajaTitulo">
						<h2><a href="<?php echo Conexion::ruta(); ?>">Foro Virtual Planes</a></h2>
						<h4>Bienvenidos a FVP.</h4>
					</div>
	<?php
}

public function foot() {
	?>
				</div>

				<footer>
					<p>Foro Virtual Planes CC 2018</p>
				</footer>
			</body>
		</html>
	<?php
}

public function index($objCategorias, $objForos, $objSubForos, $objTemas, $objComentarios) {
	$categorias = $objCategorias->getCategorias();
	
	foreach ($categorias as $cat) {
		$categoria = $cat["id_forocategoria"];
		?>
		<div class="caja">
			<div class="categorias">
				<a name="<?php echo $cat["categoria"]; ?>"></a><?php echo $cat["categoria"]; ?>
			</div>
			<?php
			$foros = $objForos->getForo($categoria);
			if(sizeof($foros)>0){
				foreach ($foros as $foro) {
					?>
					<div class="foro">
						<div class="foro_icono">
							<img src="img/note.png">
						</div>
						<div class="foro_titulo">
							<a href="temas.php?foro=<?php echo $foro["id_foro"]; ?>"><?php echo $foro["foro"]; ?></a><br>
							<ul>
								<?php
								$subforos = $objSubForos->getSubforo($foro["id_foro"]);
								foreach ($subforos as $sforo) {
									?>
									<li><a href="temas.php?foro=<?php echo $sforo["id_foro"]; ?>&sub=<?php echo $sforo["id_subforo"]; ?>">
											<?php echo $sforo["subforo"]; ?></a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
						<div class="temas_mensajes">
							<?php
								$total = $objTemas->TotalTemas($foro["id_foro"]);
							?>
							Temas: <?php echo $total; ?><br>

							<?php
								$totalcom = $objComentarios->TotalComentariosForo($foro["id_foro"]);
							?>
							Mensajes: <?php echo $totalcom; ?><br>
						</div>
						<div class="ultimocomentario">
							<?php
								$mensaje = $objComentarios->ultimo_comentario($foro["id_foro"]);
								if (sizeof($mensaje) > 0) {
									echo "Titulo: " . $mensaje[0]["titulo"] . "<br/>";
									echo "por: " . $mensaje[0]["nick"] . "<br/>";
									echo "Fecha: " . $mensaje[0]["fecha"];
								} else {
									echo 'No hay comentarios';
								}
							?>
						</div>
						<div style="clear:both; height:1px;font-size:0px; line-height: 0px;"></div>
					</div>
					<?php
				}
			}
			?>
		</div>

		<?php
	}
	?>
	<div class="caja">
		<div class="categorias">Usuarios</div>
		<div class="foro">
			<?php
			$usuarios = $obju->usuarios();
			foreach ($usuarios as $u) {
				?>
				<a href="perfil.php?id=<?php echo $u["id"]; ?>"><?php echo $u["nick"]; ?></a>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

public function error() {
	?>
		<h2>Ha ocurrido algo inesperado !</h2>
		<div class="cajaTitulo">
			<h2><a href="<?php echo Conexion::ruta(); ?>">Foro Virtual Planes</a></h2>
			<h4>Bienvenidos a FVP.</h4>
		</div>
	<?php
}

public function registerview() {
	?>
		<div class="caja">
			<div class="categorias">
				Bienvenido al apasionante mundo de Foro Virtual Planes !
			</div>
			
			<?php 
				if(isset($_GET["m"])){
					if($_GET["m"]==1){
						echo 'Ups ! Parece que el nick ya existe !';
					}
				}
			?>

			<div class="foro">
				<form action="index.php" method="post" class="formulario">
					<label>Nombre completo</label>
					<input type="text" name="nombre" placeholder="Nombre completo" required="required">
					<label>Email</label>
					<input type="email" name="correo" placeholder="Email" required="required">
					<label>Usuario</label>
					<input type="text" name="usuario" placeholder="Usuario" required="required">
					<label>Contraseña</label>
					<input type="password" name="clave" placeholder="Contraseña" required="required">
					<br/>
					<button type="submit" name="submit" class="btn">Crear cuenta</button>
				</form>
			</div>
		</div>
	<?php
}

public function loginview() {
	?>
		<div class="caja">
			<div class="categorias">
				Inicio de sesión
			</div>
			
			<?php
			if (isset($_GET["m"])) {
				switch ($_GET["m"]) {
					case 1:
						echo "<div class='error'>Usuario o contraseña incorrectos !</div>";
						break;
				}
			}
			?>

			<div class="foro">
				<form method="post" action="index.php">
				<h2>Iniciar sesión</h2>
				<label>Usuario</label>
				<input type="text" name="usuario"  placeholder="Usuario" required autofocus>
				<label>Contraseña:</label>
				<input type="password" name="password"  placeholder="Contraseña" required>
				<br>
				<button class="btn" name="submit" type="submit">Entrar</button>
			  </form>

			</div>
		</div>
	<?php
}

?>
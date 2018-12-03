<?php 
include_once 'dbaseInfo.php';

session_start();

if(isset($_SESSION['usuario'])){
	$usuario = $_SESSION['usuario'];
}

if(isset($_SESSION['usuarioArr'])){
	$usuarioArr = $_SESSION['usuarioArr'];
}

$errorNombre =$errorUsuario = $errorPass01 = $errorPass02 = $show = null;


if ($_SERVER["REQUEST_METHOD"] == "POST") {


	if (empty($_POST['usuario'])){
		$errorUsuario = "<br>* Debes escribir el usuario";
	}else{
		$usuario = $_POST['usuario'];
		if (!preg_match("/^[a-zA-Z0-9]*$/",$usuario)) {
			$errorUsuario = "<br>*Sólo letras y números sin espacios"; 
		}
	}
	if (empty($_POST['nombre'])){
		$errorNombre = "<br>* Debes escribir el nombre";
	}else{
		$nombre = $_POST['nombre'];
		if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
			$errorNombre = "<br>*Sólo letras "; 
		}
	}
	if (empty($_POST['contrasena'])){
		$errorPass01 = "<br>* Debes escribir la contraseña";
	}else{
		$pass01 = $_POST['contrasena'];


	}	
	if (empty($_POST['contrasena2'])){
		$errorPass02 = "<br>* Debes escribir la contraseña 2";
	}else{
		$pass02 = $_POST['contrasena2'];
		//Comprueba si las contraseñas son iguales
		if (strcmp($pass01,$pass02) !== 0) {
			unset($pass01);unset($pass02);
			$errorPass02 = "<br> * Las contraseñas no coinciden"; 
		}
	}            
}
?>
<?php

$show2 = "hidden";

//Comprobar que todas los campos tienen datos para validar el registro
if($_SERVER['REQUEST_METHOD']== 'POST'){
	unset($yaExisteUsuario);
	if(isset($usuario)  && isset($pass01)  && isset($pass02)  ){


		foreach($usuarioArr->usuario as $objetoUsuario){

			if (!isset($_SESSION['usuario'])){
				//user verificacion
				//var_dump($usuarioArr);exit();
				if($usuarioArr->existeUsuario($usuario, $pass01)){
					$yaExisteUsuario = "<h3>El usuario ya existe</h3>";

					//$userLogged = true;
				}else{
					//Guardar usuario en la sesión
					$_SESSION['usuario'] = $usuario;
					//$userLogged = false;

					$usuarioNuevo = new Usuario($usuario, $nombre, $pass01, "blogger");
					
					$usuarioArr->addUsuario($usuarioNuevo);
					$_SESSION['usuarioArr'] = $usuarioArr;
					//var_dump($usuarioArr);exit();
				}
			}
		}



		//var_dump($usuarioArr);
		//echo "<br><br><span class=\"registro\">REGISTRO REALIZADO CON EXITO</span>";
		$show = "hidden";
		$show2 = "visible";
	}else{
		$show = "visible";
	}
}
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<?php require 'HTMLheadTag.inc.php'; ?>
		<title>
			Registro
		</title>
		<link rel="stylesheet" type="text/css" href="style.css" />

	</head>
	<body>
		<?php include_once "HTMLheader.inc.php";?>
		<?php include_once "HTMLsearch.inc.php";?>

		<section class="main">    
			<section class="principal">
				<h1 class="center">FORMULARIO DE REGISTRO</h1>
				<span class="error"><?php if(isset($yaExisteUsuario)) print $yaExisteUsuario;?></span>

				<div id="registroOk" class="<?= $show2?> center">REGISTRO REALIZADO CON EXITO</div>

				<div id="form" class="<?= $show?>">

					<form class="front" action="<?=$_SERVER["PHP_SELF"];?>" method="post">
						<fieldset>
							<legend>Registro de usuarios</legend>
							<table border="0" cellpadding="6" cellspacing="0">

								<tr>
									<td>Usuario</td>
									<td>
										<input type="text" name="usuario" value="<?php if(isset($usuario)) print $usuario; ?>">
										<span class="error"><?php print "$errorUsuario";?></span> 
									</td>
								</tr>
								<tr>
									<td>Nombre</td>
									<td>
										<input type="text" name="nombre"  value="<?php if(isset($nombre)) print $nombre; ?>">
										<span class="error"><?php print "$errorNombre";?></span> 
									</td>
								</tr>
								<tr>
									<td>Contraseña</td>
									<td>
										<input type="password" name="contrasena"  value="<?php if(isset($pass01)) print $pass01; ?>">
										<span class="error"><?php print "$errorPass01";?></span>
									</td>
								</tr>
								<tr>
									<td>Repita la Contraseña</td>
									<td>
										<input type="password" name="contrasena2"  value="<?php if(isset($pass02)) print $pass02; ?>">
										<span class="error"><?php print "$errorPass02";?></span>
									</td>
								</tr>


							</table>
							<div class="center"><input type="submit" name="envio" value="Enviar"></div>
						</fieldset>

					</form>

				</div>
			</section>

			<?php include_once 'HTMLarchive.inc.php';?>;

		</section> 
        <?php include "HTMLfooter.inc.php";?>
	</body>
</html>
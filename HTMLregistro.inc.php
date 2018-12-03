<?php

PRINT <<<HERE
<div>
		<h1>FORMULARIO DE REGISTRO</h1>

		<form action="#" method="post">
			<fieldset>
				<legend>Ejercicio de PHP</legend>
				<table border="0" cellpadding="6" cellspacing="0">
					<tr>
						<td>Nombre</td>
						<td>
							<input type="text" name="nombre" size="35" value="<?php if(isset($nombre)) echo $nombre; ?>">
							<span class="error"><?php echo "$errorNombre";?></span> 
						</td>
					</tr>

					<tr>
						<td>Apellidos</td>
						<td>
							<input type="text" name="apellido" size="35" value="<?php if(isset($apellido)) echo $apellido; ?>">	
							<span class="error"><?php echo "$errorApellido";?></span> 
						</td>
					</tr>
					<tr>
						<td>Usuario</td>
						<td>
							<input type="text" name="usuario" size="35" value="<?php if(isset($usuario)) echo $usuario; ?>">
							<span class="error"><?php echo "$errorUsuario";?></span> 



						</td>
					</tr>
					<tr>
						<td>Contraseña</td>
						<td>
							<input type="password" name="contrasena" size="35" value="<?php if(isset($pass1)) echo $pass1; ?>">
							<span class="error"><?php echo "$errorPass1";?></span>
						</td>
					</tr>
					<tr>
						<td>Repita la Contraseña</td>
						<td>
							<input type="password" name="contrasena2" size="35" value="<?php if(isset($pass2)) echo $pass2; ?>">

							<span class="error"><?php echo "$errorPass2";?></span>
						</td>

					</tr>
					<tr>
						<td>Correo electrónico</td>
						<td>
							<input type="text" name="email" size="35" value="<?php if(isset($email)) echo $email; ?>">
							<span class="error"><?php echo "$errorEmail";?></span>
						</td>
					</tr>

					<tr>
						<td>Fecha de nacimiento</td>
						<td>
							<input type="date" name="fNacimiento" size="35" value="<?php if(isset($fNacimiento)) echo $fNacimiento; ?>">
							<span class="error"><?php echo "$errorFNac";?></span>
						</td>
					</tr>

					<tr>
						<td colspan="2">Sexo</td>
					</tr>
					<tr>
						<td>Masculino </td>
						<td><input type="radio" name="genero" value="m" <?php if(isset($genero1)) echo $genero1; ?>></td>
					</tr>
					<tr>
						<td>Femenino </td>
						<td>
							<input type="radio" name="genero" value="f" <?php if(isset($genero2)) echo $genero2; ?>>
							<span class="error"><?php echo "$errorGenero";?></span>
						</td>
					</tr>


					<tr>
						<td colspan="2">Acepta las condiciones 
							<input type="checkbox" name="condiciones" <?php if(isset($condiciones)) echo $condiciones; ?> >
						</td>
					</tr>
					<tr>
						<td colspan="2">Acepta el envío de publicidad.
							<input type="checkbox" name="publicidad"  <?php if(isset($publicidad)) echo $publicidad; ?>>
						</td>
					</tr>
					<tr><td colspan="2">
						<div class="center"><input type="submit" name="envio" value="Enviar"></div></td></tr>
				</table>
			</fieldset>

		</form>

		</div>
HERE;

?>
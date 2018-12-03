<?php
require_once 'funciones.php';
require_once 'dbaseInfo.php';
session_start();



if(isset($_SESSION['entradaArr']))
    $entradaArr = $_SESSION['entradaArr'];

if(isset($_SESSION['usuarioArr']))
    $usuarioArr = $_SESSION['usuarioArr'];

$errorCounter=0;
$errorUsuario = $errorPass  = $show = "";

if(isset($_SESSION['usuario'])){
    $usuario=  $_SESSION['usuario']; 

    //destruir variable de sesión
    if(isset($_POST['logout'])){
        unset($_SESSION['usuario']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //unset($_SESSION['usuario']);

    if (empty($_POST['usuario'])){
        $errorUsuario = "<br>* Debes escribir el usuario";
        $errorCounter++;
    }else{
        $usuario = $_POST['usuario'];
        if (!preg_match("/^[a-zA-Z0-9]*$/",$usuario)) {
            $errorUsuario = "<br>*Sólo letras y números sin espacios"; 
            $errorCounter++;
        }
    }
    if (empty($_POST['contrasena'])){
        $errorPass = "<br>* Debes escribir la contraseña";
        $errorCounter++;
    }else{
        $pass = $_POST['contrasena'];                    
    }	


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Si no hay errores en el formulario se ejecuta esto
        if($errorCounter == 0 ){
            $existe = false;
            //ocultar el formulario si los datos son correctos
            $show = "hidden";

            //LOGIN verificacion
            $usuarioOrig = $usuarioArr->existeUsuario($usuario, $pass);
            if($usuarioOrig !== false){//para que el usuario aparezca tal y como es en la base de datos.

                //Guardar usuario en la sesión
                $_SESSION['usuario'] = $usuarioOrig;
                $userLogged = true;
            }else{
                $userLogged = false;
            }


        }
    }

}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require 'HTMLheadTag.inc.php'; ?>
        <title>Login Page</title>
    </head>
    <body>
        <?php include_once "HTMLheader.inc.php";?>
        <?php include_once "HTMLsearch.inc.php";?>

        <section class="main">    
            <section class="principal">

                <?php         

                //Si el usuario ya está logueado se ejecuta esto
                if(isset($_SESSION['usuario'])){

                    print '<p class="menuL"><a href="editarCrear.php?accion=crear">Crear Entrada</a></p><br>';

                    //Recorriendo las entradas para buscar las que coincidan con las del usuario
                    foreach($entradaArr->entrada as $entrada){

                        //buscando la idEntrada en todas las entradas que coincidan con las del usuario
                        if($entrada->usuario === $usuario ){
                            print $entrada->imprimirTituloEntrada();
                        }
                    }
                    $show = "hidden";
                }
                ?>     

                <section id="form" class="<?= $show?>">
                    <h1 class="center">LOGIN</h1>
                    <aside class="error center">usuario de prueba: Carlos; contraseña: 123</aside>
                    <form class="front" action="<?=$_SERVER["PHP_SELF"];?>" method="post">
                        <fieldset>
                            <legend>Entrada</legend>
                            <table border="0" cellpadding="6" cellspacing="0">

                                <tr>
                                    <td>Usuario</td>
                                    <td>
                                        <input type="text" name="usuario" value="<?php if(isset($usuario)) print $usuario; ?>">
                                        <span class="error"><?php print "$errorUsuario";?></span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contraseña</td>
                                    <td>
                                        <input type="password" name="contrasena" value="<?php if(isset($pass)) print $pass; ?>">
                                        <span class="error"><?php print "$errorPass";?></span>
                                    </td>
                                </tr>


                            </table>
                            <div class="center"><input type="submit" name="envio" value="Enviar"></div>
                        </fieldset>

                    </form>
                    <?php
                    if(isset($userLogged) && $userLogged === false)
                        print '<span class="messCent error">Usuario o contraseña erroneas. </span>';
                    ?>
                </section>
            </section>

            <?php include_once 'HTMLarchive.inc.php';?>;

        </section>
        <?php include "HTMLfooter.inc.php";?>

    </body>
</html>
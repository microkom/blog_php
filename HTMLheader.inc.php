<?php
require_once "direcciones.inc.php";


//terminar la sesion del usuario
if(isset($_POST['logout'])){
	unset($_SESSION['usuario']);
}

//asignar la variable de sesion usuario a la variable $usuario
if(isset($_SESSION['usuario'])){
	$usuario = $_SESSION['usuario'];
	$show = "hidden";
	$show2 = "visible";
}else{
	$show2 = "hidden";
	$show = "visible";
}
if(isset($_SESSION['usuario']))
	$mostrarUsuario = $usuario;
else
	$mostrarUsuario ="";

$local = $_SERVER["PHP_SELF"];


/*
CABECERA

Una cabecera, puede ser un logo y/o el tema del blog, cualquiera que sea la técnica tendrá que ser un enlace a la página principal.
*/

print <<<HERE

<header>
    <section class="header"><a href="$raiz">GERMAN NAVARRO</a></section>
    <div class="menu">
        <a href="$principal">Principal</a>
        <div class="$show2">
        <div class="menuEntrada">
            <a href="$entradas">Entradas</a>
            <ul class="opcionesMenuEntrada">
                <li><a href="$crear">Crear Entrada</a></li>
                <li><a href="$borrar">Borrar Entrada</a></li><!-Solo las del usuario logueado--->
                <li><a href="$comentarios">Comentarios</a></li>
                <li><a href="$todo">Todas las Entradas</a></li>
            </ul>
        </div>
        </div>
        <div class="$show"><a href="$registro" >Registro</a></div>
        <div class="$show"><a href="$login" >Login</a></div>

        <div class="$show2 fright">
		  <form action="$local" method="post" >
		  <button id="salir" type="submit" name="logout" >Salir</button></form></div>
 <div  class="$show2 fright"><a href="$login" class="$show2 ">Listas Entradas $mostrarUsuario</a></div>


HERE;


print '<div style=\"float:right;color:white;font-weight:500;padding:10px;\">';
print '</div></div></header>';

?>
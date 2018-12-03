<?php
require_once 'funciones.php';
session_start();

$accion = false;
if(isset($_SESSION['entradaArr']))
    $entradaArr = $_SESSION['entradaArr'];

if(!isset($_SESSION['entradaArr']))
    $_SESSION['entradaArr'] =$entradaArr;

if(isset($_GET['idEntrada']))
    $idEntrada = $_GET['idEntrada'];

if(isset($_GET['accion']))
    $accion = $_GET['accion'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Guardar entrada
    if(isset($_POST['crearEntrada'])){
        $idEntrada = $_POST['idEntrada'];
        $fechaHora = $_POST['fechaHora'];
        $titulo = $_POST['titulo'];
        $usuario = $_POST['usuario'];
        $texto = $_POST['texto'];

        $texto = nl2br($texto);

        $tempEntrada = new Entrada($idEntrada, $fechaHora, $titulo, $usuario, $texto);

        $entradaArr->addEntrada($tempEntrada);

        print "<script>alert(\"Entrada guardada correctamente\")</script>";
    }


    $_SESSION['entradaArr'] = $entradaArr;
    $accion = "mostrar";
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require 'HTMLheadTag.inc.php'; ?>
        <title>Editar y Crear Entradas</title>
    </head>
    <body>
        <?php include "HTMLheader.inc.php";?>
        <?php include "HTMLsearch.inc.php";?>
        <section class="main">
            <section class="principal">
                <article>
                    <?php

                    if($accion !== false){
                        switch($accion){
                            case 'crear': print $entradaArr->crearEntrada();break; 
                            case 'mostrar': print $entradaArr->imprimirEntrada($idEntrada);break;
                            case 'guardarEntrada': print $entradaArr->guardarEntrada($idEntrada);break;
                            case 'editar': print $entradaArr->editarEntrada($idEntrada);break;
                            default:print "No hay articulos para mostrar";break;
                        }
                    }else{
                        print '<a href="index.php">Home</a>';
                    }
                    ?>
                </article>
            </section>                
            <?php require_once 'HTMLarchive.inc.php';?>       
        </section>   
        <?php include "HTMLfooter.inc.php";?>

    </body>
</html>
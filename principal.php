<?php 
require_once 'funciones.php';

$accion = false;
session_start();
if(isset($_SESSION['entradaArr']))
    $entradaArr = $_SESSION['entradaArr'];

if(!isset($_SESSION['entradaArr']))
    $_SESSION['entradaArr'] =$entradaArr;

?>

<?php 
//añadir Comentario a una entrada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['guardarNuevoCommentario'])){
        $commentId = $_POST['commentId'];
        $idEntrada = $_POST['idEntrada'];
        $fechaHora = $_POST['fechaHora'];
        $autor = $_POST['autor'];
        $texto = $_POST['texto'];


        $texto = nl2br($texto);
        $newComment = new Comentario($commentId, $idEntrada, $fechaHora, $autor, $texto);

        $tempEntrada = $entradaArr->readEntrada($idEntrada);
        $tempEntrada->setComentario($newComment);
        $accion = "mostrarComentario";
        print "<script>alert(\"Comentario guardado correctamente\")</script>";

    }
    if(isset($_POST['guardarCommentarioEditado'])){
        $idComentario = $_POST['idComentario'];
        $idEntrada = $_POST['idEntrada'];
        $fechaHora = $_POST['fechaHora'];
        $texto = $_POST['texto'];

        $texto = nl2br($texto);

        $tempEntrada = $entradaArr->readEntrada($idEntrada);
        $objetoComentario = $tempEntrada->getUnComentario($idComentario);

        if($objetoComentario->idComentario === $idComentario){
            $objetoComentario->texto=$texto;
        }
        $accion = "mostrarComentario";
        print "<script>alert(\"Comentario guardado correctamente\")</script>";

    }
    $_SESSION['entradaArr'] = $entradaArr;

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Guardar entrada
    if(isset($_POST['guardar'])){
        $idEntrada = $_POST['idEntrada'];
        $fechaHora = $_POST['fechaHora'];
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];

        $texto = nl2br($texto);
        $tempEntrada = $entradaArr->readEntrada($idEntrada);

        $tempEntrada->titulo=$titulo;
        $tempEntrada->texto=$texto;

        print "<script>alert(\"Entrada guardada correctamente\")</script>";
        $_SESSION['entradaArr'] = $entradaArr;
        $accion = "mostrar";
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['buscar'])){

        $busquedaStr = $_POST['datosBusqueda'];
        $tipo = $_POST['tipoBusqueda'];

        $busquedaArr = array();

        if($tipo == "any"){
            $busquedaArr = explode(' ',$busquedaStr);
            $idEntradaArr = $entradaArr->busqueda($busquedaArr,0);
        }else{
            $busquedaStr = trim($busquedaStr);
            $idEntradaArr = $entradaArr->busqueda($busquedaStr,1);
        }
        $accion = "mostrarBusqueda";
    }

}

if(isset($_GET['idEntrada']))
    $idEntrada = $_GET['idEntrada'];

if(isset($_GET['accion']))
    $accion = $_GET['accion'];

if(isset($_GET['year']))
    $year = $_GET['year'];

if(isset($_GET['month']))
    $month = $_GET['month'];

if(isset($_GET['idComentario']))
    $idComentario = $_GET['idComentario'];



?>
<!DOCTYPE html>
<html>

    <head>
        <?php require 'HTMLheadTag.inc.php'; ?>
        <title>
            Pagina principal
        </title>
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

case 'mostrarBusqueda': print $entradaArr->mostrarBusqueda($idEntradaArr);break;
case 'mostrar':
    print $entradaArr->imprimirEntrada($idEntrada);break;
case 'todosLasEntradas': print $entradaArr->todosLasEntradas();break;
case 'guardarEntrada': print $entradaArr->guardarEntrada($idEntrada);break;
case 'editarEntrada':  print $entradaArr->editarEntrada( $idEntrada);break;
case 'warningBorrarEntrada': print $entradaArr->warningBorrarEntrada($idEntrada) ;break;
case 'borrarEntrada': print $entradaArr->borrarEntrada($idEntrada);break;
case 'warningBorrarComentario': print $entradaArr-> warningBorrarComentario($idEntrada,$idComentario);break;
case 'borrarComentario':  print $entradaArr->borrarComentario($idEntrada, $idComentario);break;
case 'comentar': print $entradaArr->comentar($idEntrada);break;
case 'guardarComentario': print $entradaArr->guardarEntrada($idEntrada);break;
case 'editarComentario': print $entradaArr->editarComentario($idEntrada, $idComentario);break;
case 'mostrarComentario': print $entradaArr->comentarios($idEntrada);break;
case 'archivo': print $entradaArr->mostrarArchivo($year,$month);break;

                            default:print "No hay articulos para mostrar";break;
                        }
                    }

                    ?>
                </article>
            </section>                
            <?php require_once 'HTMLarchive.inc.php';?>       
        </section>  
        <?php include "HTMLfooter.inc.php";?>
    </body>
</html>
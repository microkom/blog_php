<?php 
require 'dbaseInfo.php';
require_once 'funciones.php';


session_start();
if(isset($_SESSION['entradaArr']))
    $entradaArr = $_SESSION['entradaArr'];

if(!isset($_SESSION['entradaArr']))
    $_SESSION['entradaArr'] =$entradaArr;

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'HTMLheadTag.inc.php'; ?>
        <title>German Navarro. Blog</title>
    </head>
    <body> 
        <?php include "HTMLheader.inc.php";?>
        <?php include "HTMLsearch.inc.php";?>

        <section class="main">
            <section class="principal">

                <?php
              
                $mostrarEntradas = array();
                $mostrarEntradas = $entradaArr->entradasIniciales();
                
                //control de entradas menores de 3
                if(count($mostrarEntradas)>3)
                    $long = 3;
                else
                    $long = count($mostrarEntradas);
                for($i = 0; $i <$long ;$i++){
                    print $mostrarEntradas[$i]->imprimirEntradaResumida();                
                }    


                ?>

            </section>                
            <?php include 'HTMLarchive.inc.php';?>       
        </section>


        <?php include "HTMLfooter.inc.php";?>


    </body>
</html>
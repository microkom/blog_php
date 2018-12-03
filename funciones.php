<?php

if(isset($_SESSION['userLogged']))
    $userLogged = $_SESSION['userLogged'];

require_once 'dbaseInfo.php'; //no borrar


//Conversión de meses en número a palabra
 function month($month){
    switch($month){
        case 1:  return "Enero";break;
        case 2:  return "Febrero";break;
        case 3:  return "Marzo";break;
        case 4:  return "Abril";break;
        case 5:  return "Mayo";break;
        case 6:  return "Junio";break;
        case 7:  return "Julio";break;
        case 8:  return "Agosto";break;
        case 9:  return "Septiembre";break;
        case 10:  return "Octubre";break;
        case 11:  return "Noviembre";break;
        case 12:  return "Diciembre";break;


    }
}

function quitarAcentos($texto){
    $from = array(
        'á','À','Á','Â','Ã','Ä','Å',
        'ß','Ç',
        'È','É','Ê','Ë','é',
        'Ì','Í','Î','Ï','Ñ','í',
        'Ò','Ó','Ô','Õ','Ö','ó',
        'Ù','Ú','Û','Ü','ú');

    $to = array(
        'a','A','A','A','A','A','A',
        'B','C',
        'E','E','E','E','é',
        'I','I','I','I','N','i',
        'O','O','O','O','O','o',
        'U','U','U','U','u');

    $textoNuevo = str_replace($from, $to, $texto);
    return $textoNuevo;
}

//quita los <br /> del texto almacenado al mostrarlos
function br2nl($texto){
    return preg_replace('(<br />)', " ", $texto);
}
?>
<?php
require_once 'dbaseInfo.php';
require_once 'funciones.php';

print '<aside class="side">';


$year =  array();
$month = array();

$j=0;
foreach($entradaArr->entrada as $entries){

    //almacenar los años y meses  en un array
    $year[$j] = substr($entries->fechaHora,0,4);
    $month[$j][$year[$j]] = substr($entries->fechaHora,4,2);
    $j++;
}

print "<h2>ARCHIVO</h2>";

$retainYear=null;
$retainMonth=null;

print "<ul>"; 
foreach($month as $key => $anyoArr){

    //$key es el indice
    //$anyoArr es array de los años, el índice es el año en número
    //$mesNumero es el mes en número
    foreach($anyoArr as $anyoNumero => $mesNumero){

        //comparar que los años son diferentes para no repetir la impresión
        if($retainYear != $anyoNumero){
            print "<li>$anyoNumero</li>";
            $retainYear = $anyoNumero; //variable de control para el año repetido
            $retainMonth=null; //si el año cambia el mes debe resetearse
        }

        //comparar que los meses son diferentes para no repetir la impresión
        if($retainMonth != $mesNumero ){
            echo "<ul ><li><a href=\"principal.php?year=$anyoNumero&month=$mesNumero&accion=archivo\">".month($mesNumero)."</a></li></ul>";
            $retainMonth = $mesNumero; //variable de control para el mes repetido
        }
    }                            
}
print "</ul> </aside>";

?>		
<?php
/*
Clase BD - contendrá los siguientes campos:
�? Array de entradas.
�? Array de usuarios.
*/

Class BD{



    public $entrada = array();
    public $usuario = array();


    public function addEntrada($entrada) {
        $this->entrada[] = $entrada;
    }

    public function readEntrada($idEntrada) {   //por idEntrada

        foreach($this->entrada as   $objetoEntrada){
            if( strcasecmp($objetoEntrada->idEntrada, $idEntrada)===0){
                return $objetoEntrada;
            }
        }        
    }

    public function warningBorrarEntrada($idEntrada){

        $objetoEntrada = $this->readEntrada($idEntrada);

        return "Se va a proceder al borrado de la entrada con título: <h5>$objetoEntrada->titulo</h5> Confirma el borrado de dicha entrada?  
        <a href=\"principal.php? idEntrada=$idEntrada&accion=borrarEntrada\"> Borrar</a> <a href=\"login.php\">Anular</a>";

    }

    public function _borrarEntrada($idEntrada) {   //por idEntrada

        foreach( $this->entrada as $key => $objetoEntrada){
            if(strcasecmp($objetoEntrada->idEntrada, $idEntrada)===0){
                unset($this->entrada[$key]);
                return true;
            }
        }

    }

    public function borrarEntrada($idEntrada){

        //$borrado = $this->_borrarEntrada($idEntrada);
        if($this->_borrarEntrada($idEntrada))
            print "Entrada borrada.";
        else
            print "Fallo al borrar la entrada.";
    }

    public function busqueda($busquedaArr, $tipo) {   //por string
        $idEntradaArr = array();$found =false;

        //busca 1 o más palabras en el array que recibe
        if($tipo === 0){

            foreach($busquedaArr as $busqueda){
                $busqueda = trim($busqueda);
                $busqueda = strtolower($busqueda);
                foreach( $this->entrada as $key => $objetoEntrada){
                    $texto = explode(' ',$objetoEntrada->texto);
                    $titulo = explode(' ',$objetoEntrada->titulo);

                    $texto = quitarAcentos($texto);
                    $titulo = quitarAcentos($titulo);

                    foreach($texto as $palabra){
                        if((strcasecmp($busqueda,$palabra))==0){
                            $idEntradaArr[] = $objetoEntrada->idEntrada;
                            $found = true;
                        }
                    } 
                    foreach($titulo as $palabra){
                        if((strcasecmp($busqueda,$palabra))==0){
                            $idEntradaArr[] = $objetoEntrada->idEntrada;
                            $found = true;
                        }
                    }
                    $idEntradaArr = array_unique($idEntradaArr);
                }

            }
        }else{

            //busca frases completas
            $busqueda = trim($busquedaArr);//busquedaArr aquí no es Array
            $busqueda = strtolower($busqueda);//texto de busqueda a minusculas
            $busqueda = quitarAcentos($busqueda);//quitar los acentos de la busqueda


            $busquedaArr2 = explode(' ', $busqueda);//separar el texto en un array
            $busquedaArr2 = array_filter($busquedaArr2); //limpiar los posibles espacios dobles

            $busquedaArr3 = array(); 

            foreach($busquedaArr2 as $itemBusqueda){ 
                $busquedaArr3[]= trim($itemBusqueda);//quitar espacios en los extremos de las palabras
            }

            $busqueda = implode(' ', $busquedaArr3);//pasar a string el array


            foreach( $this->entrada as $key => $objetoEntrada){

                $texto =  explode(' ',$objetoEntrada->texto);
                $texto = quitarAcentos($texto);

                $busquedaArr4 = array();
                foreach($texto as $itemBusqueda){
                    $busquedaArr4[]= trim($itemBusqueda);
                }
                $texto = implode(' ',$busquedaArr4);
                $texto = strtolower($texto);

                if(strpos($texto,$busqueda) !== false){
                    $idEntradaArr[] = $objetoEntrada->idEntrada;
                    $found = true;
                }


                $titulo = explode(' ',$objetoEntrada->titulo);
                $titulo = quitarAcentos($titulo);

                $busquedaArr5 = array();
                foreach($titulo as $itemBusqueda){
                    $busquedaArr5[]= trim($itemBusqueda);
                }
                $titulo = implode(' ',$busquedaArr5);
                $titulo = strtolower($titulo);


                if(strpos(strtolower($titulo),$busqueda) !== false){
                    $idEntradaArr[] = $objetoEntrada->idEntrada;
                    $found = true;
                }


            }

            $idEntradaArr = array_unique($idEntradaArr);
        }
        if($found)
            return $idEntradaArr;
        else
            return false;
    }

    public function mostrarBusqueda($idEntradaArr){

        if($idEntradaArr !== false){
            $textoString = "";
            foreach($idEntradaArr as $idEntrada){

                $objetoEntrada = $this->readEntrada($idEntrada);
                if($objetoEntrada->idEntrada === $idEntrada){

                    //título del artículo
                    $textoString .= 
                        "<ul>
                            <li>
                                <h4>
                                    <a href=\"./principal.php?idEntrada=
                                    $idEntrada
                                    &accion=mostrar\">
                                    $objetoEntrada->titulo
                                    </a>
                                </h4>";


                    //mostrar usuario, fecha hora, contador comentarios
                    $textoString .= 
                        '<div>
                            <div>'
                            .$objetoEntrada->_mostrarUsuarioFechaHora().'
                            </div>
                            <div>
                                <a href="./principal.php?idEntrada='
                                .$idEntrada.'
                                &accion=mostrarComentario">Comentarios:'
                                .$objetoEntrada->_contadorComentarios().'
                                </a>
                            </div>
                        </div>
                        <br>';

                    $textoString .= $objetoEntrada->_mostrarEditarBorrarEntrada();

                    $textoString .= 
                            "</li>
                        </ul>";
                }
            }
            return $textoString;
        }else{
            return "No hay conincidencias con la búsqueda.";

        }
    }

    public function entradasIniciales(){
        $contadorEntradas =0;
        $mostrarEntradas = array();

        foreach($this->entrada as $objetoEntrada){
            $contadorEntradas++;
            $mostrarEntradas[$contadorEntradas]= $objetoEntrada;
        }    

        return array_reverse($mostrarEntradas);
    }

    public function imprimirEntrada($idEntrada){


        $textoString ="";
        $objetoEntrada = $this->readEntrada($idEntrada);

        $textoString .= "<aside>";
        $textoString .= $objetoEntrada->_mostrarEditarBorrarEntrada();
        $textoString .= "</aside>";
        $textoString .= "<h3>$objetoEntrada->titulo</h3>";


        //Texto del articulo
        $textoObjetoEnt =  nl2br($objetoEntrada->texto);
        $textoString .= $textoObjetoEnt." <br>";


        //mostrar usuario, fecha hora, contador comentarios
        $textoString .= '<br><div><div> '.$objetoEntrada->_mostrarUsuarioFechaHora().'</div></div><br>';

        $textoString .= $objetoEntrada->_mostrarComentarioCompleto();

        $textoString .= '<a href="principal.php?idEntrada='.$idEntrada.'&accion=comentar">Agregar Comentario</a>';

        return $textoString; 
    }

    public function todosLasEntradas(){
        $textoString ="";
        foreach($this->entrada as $objetoEntrada){
            $textoString .= $objetoEntrada->imprimirEntradaResumida();
        }
        return $textoString;
    }

    public function todosLosComentarios(){
        $textoString ="";
        foreach($this->entrada as $objetoEntrada){
            $textoString .= $this->comentarios($objetoEntrada->idEntrada);
        }
        return $textoString;
    }

    public function editarEntrada($idEntrada){

        print "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";

        $objetoEntrada = $this->readEntrada($idEntrada);
        print "<label for='titulo'>Titulo</label><br>
    <input type='text' size='50'  name='titulo' value='$objetoEntrada->titulo'>";

        $texto =  ($objetoEntrada->texto);//nl2br agrega <br/>
        $texto = br2nl($texto);

        //Texto del articulo
        print "<br><br><label for=\"articulo\">Articulo</label><br>
     <textarea rows=\"22\" cols=\"70\" name=\"texto\">$texto</textarea><br>";

        $fechaHora = date('Ymdhis');
        //autor y fecha
        print "<table class=\"w100\"  ><tr><td>";
        print "<h5>".$objetoEntrada->usuario."</h5> </td><td class=\"right\"> <h5>".$objetoEntrada->dateTime($objetoEntrada->fechaHora)."</h5></td></tr>

    <input type=\"hidden\" name=\"fechaHora\" value=\"$fechaHora\">
    <input type=\"hidden\" name=\"idEntrada\" value=\"$idEntrada\">
    <tr><td><input type=\"submit\" name=\"guardar\" value=\"Guardar\"></td></tr>
    </table></form>";

        print $objetoEntrada->_mostrarComentarioCompleto();


    }

    public function crearEntrada(){

        print '<h2 class="width100">CREACION DE ENTRADAS</h2>';

        //get last id
        $objetoEntrada = end($this->entrada);
        $lastIdEntrada = $objetoEntrada->idEntrada;
        $pos = strpos($lastIdEntrada, "E");
        $nextEntradaId = "E".((substr($lastIdEntrada, $pos+1,10))+1);

        print "Entrada: $nextEntradaId <br> <br>

    <form action=".$_SERVER['PHP_SELF']." method=\"post\">";

        print <<<HERE

    <label class="w100" for="titulo">Titulo</label><br>
    <input   class="width100" type="text"  name="titulo" >
    <br><br>
    <label for="texto">Articulo</label><br>
    <textarea class="w100" name="texto"></textarea>

 <!--   <form action="upload.php" method="post" enctype="multipart/form-data">
        Seleccionar imagen para subir:
        <input type="file" name="fileToUpload" id="fileToUpload"><br>  <br>  
        <input type="submit" value="Subir Imagen" name="submit">
     </form>
     -->
HERE;

        $fechaHora = date('Ymdhis');
        //autor y fecha
        print "<table class=\"w100\"  >";
        print "<tr><td>".$_SESSION['usuario']." </td><td> ".$objetoEntrada->dateTime($fechaHora)."</td></tr><br>  <br>  
    <input type=\"hidden\" name=\"fechaHora\" value=\"$fechaHora\">
    <input type=\"hidden\" name=\"idEntrada\" value=\"$nextEntradaId\">
    <input type=\"hidden\" name=\"usuario\" value=\"".$_SESSION['usuario']."\">
        <tr>
            <td>
                <br>  <br>  
                <input type=\"submit\" name=\"crearEntrada\" value=\"Guardar\">
            </td>
        </tr>
    </table>
    </form>";

    }

    public function mostrarArchivo( $year, $month){

        $textoString ="";
        $textoString .= "<h2>ARCHIVO</h2><ul><li><h3>$year</h3><ul><li><h3>".month($month)."</h3>";

        foreach($this->entrada as $objetoEntrada){

            $anyoMes = substr($objetoEntrada->fechaHora,0,6); 

            if($anyoMes == ($year.$month)){

                //título del artículo
                $textoString .= "<ul><li><h4><a href=\"./principal.php?idEntrada=$objetoEntrada->idEntrada&accion=mostrar\">$objetoEntrada->titulo</a></h4>";

                //mostrar usuario, fecha hora, contador comentarios
                $textoString .= '<div><div> '.$objetoEntrada->_mostrarUsuarioFechaHora().'</div><div> <a href="./principal.php?idEntrada='.$objetoEntrada->idEntrada.'&accion=mostrarComentario">Comentarios: '.$objetoEntrada->_contadorComentarios().'</a></div></div><br>';

                $textoString .= $objetoEntrada->_mostrarEditarBorrarEntrada();

                $textoString .= " </li></ul><br><br>";
            }
        }
        $textoString .= "</ul></li></ul></li>";
        return $textoString;
    }

    public function comentar($idEntrada){

        $textoString ="";

        $objetoEntrada = $this->readEntrada($idEntrada);

        $textoString .= "<form action=".$_SERVER['PHP_SELF']." method='post'>";

        $comentario = $objetoEntrada->getComentario();

        //get last comment id
        if(count($comentario)>0){
            $lastComment = end($comentario);
            $lastId = $lastComment->idComentario;
            $pos = strpos($lastId, "C");
            $nextCommentId = "C".((substr($lastId, $pos+1,10))+1);
        }else{
            $nextCommentId = "C1";
        }

        $textoString .=  "<h3>AÑADIR COMENTARIO</h3>";
        $textoString .=  "Se va a añadir un comentario a la entrada \"$idEntrada$nextCommentId\". Los comentarios pueden ser moderados por el administrador del blog<br><br><h3>$objetoEntrada->titulo</h3>";

        $textoString .=  "<label for='autor'>Nombre</label><br><input type='text' size='20'  name='autor' >";

        //Texto del articulo
        $textoString .=  "<br><br><label for=\"texto\">Comentario</label><br>
     <textarea rows=\"16\" cols=\"50\" name=\"texto\" ></textarea><br>";
        $fechaHora = date('Ymdhis');

        $textoString .= "<date >".$objetoEntrada->dateTime(date('Ymdhis'))."</date> 
    <input type=\"hidden\" name=\"fechaHora\" value=\"$fechaHora\">
    <input type=\"hidden\" name=\"commentId\" value=\"$nextCommentId\">
    <input type=\"hidden\" name=\"idEntrada\" value=\"$idEntrada\">
   <br>
   <input type=\"submit\" name=\"guardarNuevoCommentario\" value=\"Guardar\"></form>
   <br>
   <br>";

        $textoString .=  $objetoEntrada->_mostrarComentarioCompleto();
        return $textoString;

    }

    public function warningBorrarComentario($idEntrada,$idComentario){

        $objetoEntrada = $this->readEntrada($idEntrada);
        $objetoComentario = $objetoEntrada->getUnComentario($idComentario);

        $comentarioBorrar = $objetoComentario->texto;

        $textoString = "Se va a proceder al borrado del comentario :<br><br>
    <h5> $comentarioBorrar </h5> <br> <br> Confirma el borrado?  
    <a href=\"principal.php?idEntrada=$idEntrada&accion=borrarComentario&idComentario=$idComentario\">Borrar</a> 
    <a href=\"login.php\">Anular</a>";
        return $textoString;

    }

    public function borrarComentario($idEntrada,$idComentario){

        $objetoEntrada = $this->readEntrada($idEntrada);
        $borrado = $objetoEntrada->_borrarComentario($idComentario);

        if($borrado)
            print "Comentario borrado.";
        else
            print "Fallo al borrar el comentario.";

    }

    public function comentarios($idEntrada){

        $objetoEntrada = $this->readEntrada($idEntrada);

        $textoString ="";

        //título del artículo
        $textoString .= "<h3>$objetoEntrada->titulo</h3>";
        $textoString .=  "...<a href=\"./principal.php?idEntrada=$objetoEntrada->idEntrada&accion=mostrar\">Leer mas.</a>";

        //Usuario y fecha update
        $textoString .=  "<table class=\"w100\"  ><tr><td><h4>".$objetoEntrada->_mostrarUsuarioFechaHora()."</h4></td></tr><tr><td>";

        $textoString .=  $objetoEntrada->_mostrarComentarioCompleto();
        $textoString .=  "</td></tr></table>";

        $textoString .=  '<a href="principal.php?idEntrada='.$objetoEntrada->idEntrada.'&accion=comentar">Agregar Comentario</a>';

        return $textoString;
    }

    public function editarComentario($idEntrada, $idComentario){

        $textoString = "";
        $textoString .= "<form action=".$_SERVER['PHP_SELF']." method=\"post\">";

        $objetoEntrada = $this->readEntrada($idEntrada);
        $comentarioArr = $objetoEntrada->comentario;

        foreach($comentarioArr as $comentario ){
            if(strcasecmp ($comentario->idComentario, $idComentario)==0){
                $objetoComentario = $comentario;
            }
        }

        $textoString .=  "<h3>$objetoEntrada->titulo</h3>Editar Comentario<br><br>";

        $textoString .=  "<label for='autor'>Autor</label><br><input type='text' size='50'  name='autor' value='$objetoComentario->autor' disabled>";

        $texto=  $objetoComentario->texto;//nl2br agrega <br/>
        $texto = br2nl($texto);

        //Texto del Comentario
        $textoString .=  '<br><br><label for="texto">Comentario</label><br><textarea rows="22" cols="70" name="texto" >'.$texto.'</textarea><br>';

        $fechaHora = date('Ymdhis');

        //autor y fecha
        $textoString .=  "<table class=\"w100\"  ><tr><td class=\"right\"> <h5>".$objetoEntrada->dateTime($objetoEntrada->fechaHora)."</h5></td> </tr>

        <input type=\"hidden\" name=\"fechaHora\" value=\"$fechaHora\">
        <input type=\"hidden\" name=\"idEntrada\" value=\"$idEntrada\">
        <input type=\"hidden\" name=\"idComentario\" value=\"$objetoComentario->idComentario\">

        <tr><td><input type=\"submit\" name=\"guardarCommentarioEditado\" value=\"Guardar\"></td></tr>
        </table></form>";

        return $textoString;

    }

    public function getTotalEntradas() {   //Devuelve 
        $contador=0;
        foreach( $this->entrada as $value){
            $contador++;

        }       
        return $contador;
    }

    public function readEntradaIndice($indice) { //por �ndice
        return  $this->entrada[$indice];        
    }

    public function addUsuario($usuario) {
        $this->usuario[] = $usuario;
    }

    public function existeUsuario($usuario, $pass) {
        foreach($this->usuario as $value){
            $usuario3 = strtolower($usuario);
            $usuario2 = strtolower($value->user);
            if($usuario3 == $usuario2 && $value->pass == $pass){
                return $value->user;
            }
        }
        return false;
    }

    public function readUsuario($usuario) {
        return  $this->usuario[$usuario];
    }
}
?>

<?php
/*
Clase Entrada - contendrá los siguientes campos:
● idEntrada: número identificativo.
● fechaHora: timestamp de la creación del comentario.
● titulo: título de la entrada.
● usuario: id del usuario que creó la entrada.
● comentarios: array con los comentarios de la entrada
*/

Class Entrada{
    private $idEntrada;
    private $fechaHora;
    private $titulo;
    private $usuario;
    private $texto;
    private $comentario = array();



    public function __construct($idEntrada, $fechaHora, $titulo, $usuario, $texto, $comentario=array()){
        $this->idEntrada = $idEntrada;
        $this->fechaHora = $fechaHora;
        $this->titulo = $titulo;
        $this->usuario = $usuario;
        $this->texto = $texto;
        $this->comentario = $comentario;

    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }                    

    public function __get($atributo){
        return $this->$atributo;
    }

    public function _borrarComentario($idComentario) {   //por idEntrada

        foreach( $this->comentario as $key => $objetoComentario){
            if($objetoComentario->idComentario === (string)$idComentario){
                unset($this->comentario[$key]);
                return true;
            }
        }

    }

    public function imprimirEntradaResumida(){  //llamado con accion=mostrar

        $textoString = "<article><h3><a href=\"principal.php?idEntrada=$this->idEntrada&accion=mostrar\">$this->titulo</a></h3>";

        //Fraccionamiento del articulo para mostrar las 30 primeras palabras
        $textoEntrada = explode(' ', $this->texto);
        $textoEntrada = array_slice($textoEntrada,0,30);
        $textoEntrada = implode(' ', $textoEntrada);

        //mostrar texto del artículo
        $textoString .= $textoEntrada;

        //mostrar texto del artículo
        $textoString .= "...<a href=\"./principal.php?idEntrada=$this->idEntrada&accion=mostrar\">Leer mas.</a><br><br>";

        //mostrar usuario, fecha hora, contador comentarios
        $textoString .= '<div><div> '.$this->_mostrarUsuarioFechaHora().'</div><div> <a href="./principal.php?idEntrada='.$this->idEntrada.'&accion=mostrarComentario">Comentarios: '.$this->_contadorComentarios().'</a></div></div><br>';

        $textoString .= $this->_mostrarEditarBorrarEntrada();
        $textoString .= "</article>";
        return $textoString;
    }

    public function _mostrarUsuarioFechaHora(){
        return $this->usuario.'  ' .$this->dateTime($this->fechaHora);
    }

    public function imprimirTituloEntrada(){

        $textoString = "";
        //título del artículo
        $textoString .= "<article>";
        $textoString .= "<h3><a href=\"./principal.php?idEntrada=$this->idEntrada&accion=mostrar\">$this->titulo</a></h3>";

        //mostrar texto del artículo
        $textoString .=  "...<a href=\"./principal.php?idEntrada=$this->idEntrada&accion=mostrar\">Leer mas.</a><br><br>";

        //mostrar usuario, fecha hora, contador comentarios
        $textoString .=  '<div><div> '.$this->_mostrarUsuarioFechaHora().'</div><div> <a href="./principal.php?idEntrada='.$this->idEntrada.'&accion=mostrarComentario">Comentarios: '.$this->_contadorComentarios().'</a></div></div><br>';

        $textoString .=  $this->_mostrarEditarBorrarEntrada();

        $textoString .=  "</td></tr></table></article>";
        return $textoString;
    }


    //formato fecha-hora: dia, mes, año, hora, minutos
    public function dateTime(){    

        $anyo = substr($this->fechaHora,0,4); 
        $mes = substr($this->fechaHora,4,2);
        $dia = substr($this->fechaHora,6,2);
        $hora = substr($this->fechaHora,8,2);
        $min = substr($this->fechaHora,10,2);

        return $dia."/".$mes."/".$anyo." ".$hora.":".$min;
    }

    public function _contadorComentarios(){
        $comments  =$this->comentario ;
        if($comments>0)
            return sizeof($comments);
        else
            return 0;

    }

    //Solo si el usuario esta logueado se mostraran estas opciones
    public function _mostrarEditarBorrarEntrada(){

        if(isset($_SESSION['usuario']) && $_SESSION['usuario'] === $this->usuario){
            return '
        <a href="principal.php?idEntrada='.$this->idEntrada.'&accion=editarEntrada">
        <img src="edit_small.png" alt="Editar Entrada" title="Editar Entrada"></a>
        <a href="principal.php?idEntrada='.$this->idEntrada.'&accion=warningBorrarEntrada">
        <img src="bin_small.png" alt="Borrar Entrada" title="Borrar Entrada"></a>';
        }
    }

    public function _mostrarComentarioCompleto(){

        $textoString ="";
        
        if(count($this->comentario)>0)
        $textoString .= "<h3>COMENTARIOS</h3>";
        
        //muestra cada comentario
        foreach($this->comentario as $commentario){

            //autor del comentario + texto del comentario
            $textoString .=  "<ul><li>".$commentario->autor.":<br>".$commentario->texto."<br>";   

            //fechahora del comentario
            $textoString .=  "<h5>".$this->dateTime($commentario->fechaHora )."</h5> ";

            if(isset($_SESSION['usuario']) && strcasecmp($_SESSION['usuario'], $this->usuario)===0){
                $textoString .= '
                <a href="principal.php?idEntrada='.$this->idEntrada. '&idComentario=' .$commentario->idComentario. '&accion=editarComentario">
                <img src="edit_small.png" alt="Editar Comentario" title="Editar Comentario"></a><a href="principal.php?idEntrada=' .$this->idEntrada. '&idComentario=' .$commentario->idComentario. '&accion=warningBorrarComentario">
                <img src="bin_small.png" alt="Borrar Comentario" title="Borrar Comentario"></a></li></ul>';

            }else{
                $textoString .='</li></ul>';
            }
        }
        $textoString .=  "<br>";
        return $textoString;
    }
    
    public function setIdEntrada($id){
        $this->idEntrada = $id;
    }
    public function setFechaHora($fechaHora){
        $this->fechaHora= $fechaHora;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setComentario($comentario){
        $this->comentario[] = $comentario;
    }

    public function getIdEntrada(){
        return $this->idEntrada;
    }
    public function getFechaHora(){
        return $this->fechaHora;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getComentario(){
        return $this->comentario;
    }
    public function getUnComentario($idComentario){
        foreach($this->comentario as $comentario){
            if(strcasecmp($comentario->idComentario, $idComentario)==0)
                 return $comentario;
        }
       
    }


    public function __toString(){
        return "IdEntrada: ".$this->idEntrada." <br>
		FechaHora: ".$this->fechaHora." <br>
		Título: ".$this->titulo." <br>
		Usuario: ".$this->usuario." <br>
		Comentario: ";//.retCom()."<br>";
    }
    function retCom(){
        $valor="";
        foreach($this->comentario as $valor){
            $valor .= $valor." ";
        }        
        return $valor;    
    }

}
?>
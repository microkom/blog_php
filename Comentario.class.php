<?php
/*
● idComentario: número identificativo.
● idEntrada: número identificativo de la entrada a la que pertenece el comentario.
● fechaHora: timestamp de la creación del comentario.
● autor: nombre del autor del comentario.
● texto: el texto del comentario.
*/

Class Comentario{
    private $idComentario;
    private $idEntrada;
    private $fechaHora;
    private $autor;
    private $texto;

    public function __construct($idComentario, $idEntrada, $fechaHora, $autor, $texto){
        $this->idComentario = $idComentario;
        $this->idEntrada = $idEntrada;
        $this->fechaHora = $fechaHora;
        $this->autor = $autor;
        $this->texto = $texto;

    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }                    

    public function __get($atributo){
        return $this->$atributo;
    }
    
   
}
    /*

	public function setIdComentario($id){
		$this->idContacto = $id;
	}
	public function setIdEntrada($id){
		$this->idEntrada = $id;
	}
	public function setFechaHora($fechaHora){
		$this->fechaHora = $fechaHora;
	}
	public function setAutor($autor){
		$this->autor = $autor;
	}
	public function setTexto($texto){
		$this->texto = $texto;
	}

	public function getIdComentario(){
		return $this->idContacto;
	}
	public function getIdEntrada(){
		return $this->idEntrada;
	}
	public function getFechaHora(){
		return $this->fechaHora;
	}
	public function getAutor(){
		return $this->autor;
	}
	public function getTexto(){
		return $this->texto;
	}
	*/
    //	public function __toString(){
    //		return "IdComentario: ".$this->idComentario." <br>
    //			IdEntrada: ".$this->idEntrada." <br>
    //			FechaHora: ".$this->fechaHora." <br>
    //			Autor: ".$this->autor." <br>
    //			Texto: ".$this->texto." <br>";
    //	}


?>
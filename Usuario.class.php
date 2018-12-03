<?php
/*
Clase Usuario - contendrá los siguientes campos:
● user: email del usuario.
● nombre: nombre del usuario.
● pass: contraseña del usuario.
● rol: tipo de usuario, que podrá ser blogger o admin.
*/

Class Usuario{

    private $user;
    private $nombre;
    private $pass;
    private $rol;

    public function __construct($user, $nombre, $pass, $rol){
        $this->user = $user;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->rol = $rol;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }                    

    public function __get($atributo){
        return $this->$atributo;
    }
    
        /*
	public function setUser($user){
		$this->user = $user;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setPass($pass){
		$this->pass = $pass;
	}
	public function setRol($rol){
		$this->rol = $rol;
	}

	public function getUser(){
		return $this->user;
	}
	public function getNombre(){
		return $this->nombre;
	}
	public function getPass(){
		return $this->pass;
	}
	public function getRol(){
		return $this->rol;
	}
*/
 
}

?>
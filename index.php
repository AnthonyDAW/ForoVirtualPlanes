<?php
session_start();
//Include las clases
require_once 'class/categorias.php';
require_once 'class/foros.php';
require_once 'class/subforos.php';
require_once 'class/temas.php';
require_once 'class/comentarios.php';
require_once 'class/sesion.php';
require_once 'class/usuarios.php';

//Incluimos la vista y el modelo
require_once 'view.php';
require_once 'model.php';

head(); //Cabecera de la página

//Creacion de objetos cada uno de cada clase para llamarlos más tarde en caso de ser necesario
$objCategorias = new Categorias();
$objForos = new Foros();
$objSubForos = new Subforos();
$objTemas = new Temas();
$objComentarios = new Comentarios();
$objUsuarios = new Usuarios();
$objSesion = new Sesion();

if(isset($_SESSION['error'])){
	error(); //Vista de error.
}
else if( ( isset($_GET['action']) && !isset($_SESSION['id']) ) || ( isset($_SESSION['action']) && !isset($_SESSION['id']) ) ) {
	
	if($_GET['action']=='register' || $_SESSION['action']=='register') {
		$_SESSION['action']='register';
		if(isset($_POST['submit']))
			$objUsuarios->nuevousuario();
		else
			registerview();	
	}
	else if($_GET['action']=='login' || $_SESSION['action']=='login') {
		$_SESSION['action']='login';
		if(isset($_POST['submit']))
			$objSesion->logueo();
		else
			loginview();	
	}
	else
		error();
	
}
else {
	index($objCategorias, $objForos, $objSubForos, $objTemas, $objComentarios);
}

foot();
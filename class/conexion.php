<?php
session_start();
abstract class Conexion {
   //*****************************************************************************
   public function conectar(){
      $mysqli = new mysqli('e87160-phpmyadmin.services.easyname.eu','u137048db1','HolaMundo1','u137048db1',3306);

      if ($mysqli->connect_errno)
         header('Location: offline.html');

      $mysqli->set_charset('utf8');
      
      return $mysqli;
   }
   //*****************************************************************************
   public static function ruta() {
      return "http://www.nicolasmeseguer.com/foro2/";
   }
   //*****************************************************************************
}
?>

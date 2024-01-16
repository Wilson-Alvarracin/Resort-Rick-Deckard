<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

 $dbserver="localhost";
 $dbuser="root";
 $dbpwd="";


 try{
 $pdo = new PDO($dbserver,$dbuser,$dbpwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

}catch(Exception $e){
  echo "Error en la conexión con la base de datos: " . $e->getMessage();
  die();
 }
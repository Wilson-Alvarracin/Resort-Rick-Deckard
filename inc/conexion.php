<?php
 $dbserver="localhost";
 $dbuser="root";
 $dbpwd="";
 $dbbasedatos="bd_restaurante";


 try{
 $conn = @mysqli_connect($dbserver,$dbuser,$dbpwd,$dbbasedatos);

}catch(Exception $e){
   echo("Error: ".$e->getMessage());
   die();
 }
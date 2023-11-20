<?php
 $dbserver="bd_restaurante";
 $dbuser="root";
 $dbpwd="";
 $dbbasedatos="ShakAndCo";


 try{
 $conn = @mysqli_connect($dbserver,$dbuser,$dbpwd,$dbbasedatos);

}catch(Exception $e){
   echo("Error: ".$e->getMessage());
   die();

}

<?php
// Set Up Database Information
$host = "localhost"; // Your Host
$db_name = "shineurl"; // Your DataBase Name
$db_username = "root"; // Your DataBase username
$db_password = "12345"; // Your Database password

// Conntect To Database

try {
$db = new PDO("mysql:host=".$host.";dbname=".$db_name. ";charset=utf8",$db_username,$db_password);
// Varible to Detect Connection Statue
$connection_statue = true;
}catch (Exception $e) {
  $error =  "<center><h2>Oops...Something is Wrong</h2></center>";
  $connection_statue = false;
  print_r($e);
}


 ?>

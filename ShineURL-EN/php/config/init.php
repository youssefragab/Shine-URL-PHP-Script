<?php
// Set Up Database Information
$host = ""; // Your Host
$db_name = ""; // Your DataBase Name
$db_username = ""; // Your DataBase username
$db_password = ""; // Your Database password

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

<?php

include "config/init.php";

$id = $_GET["id"];

$stm = $db->prepare("select * from shorted_urls where shorted_code= :id");
$stm->bindParam(":id",$id);
$stm->execute();
$count = $stm->rowCount();

if($count == 0) {
header("Location: ../404.php");
}else {
 $url = $stm->fetch();
 header("Location: " . $url["original_link"]);
}

 ?>

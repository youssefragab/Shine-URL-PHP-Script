<?php
require_once "config/init.php";

if(isset($_POST["key"]) && $_POST["key"] == "TrustedRequest") {
  if(isset($_COOKIE["user_urls"])) {
  $data = json_decode($_COOKIE['user_urls'], true);
  $sl = array_slice($data, -4, 4, true);
  $res = array();
  $i = 0;
     foreach($sl as $lin) {
       $extract = $db->prepare("select * from shorted_urls where shorted_code='".$lin . "'");
       $extract->execute();
       while($link = $extract->fetch(PDO::FETCH_ASSOC)) {
        $res[$i] =  '

        <div class="link">
        <div class="sub-link-container">
        <h3>'.$link["shorted_link"].'</h3> <img src="images/copy.png" data-clipboard-text="'.$link["shorted_link"].'" class="latest-link-copy" />
        </div>
        <div class="main-link-container">
        <h5>'.$link["original_link"].'</h5>
        </div>
        </div>


        ';
        $i++;
       }
     }

     if(isset($res[3])) {
        echo $res[3];
     }
     if(isset($res[2])) {
        echo $res[2];
     }
     if(isset($res[1])) {
        echo $res[1];
     }
     if(isset($res[0])) {
        echo $res[0];
     }


  }else {

  }

}


 ?>

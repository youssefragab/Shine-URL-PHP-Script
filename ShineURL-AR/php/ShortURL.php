<?php
require_once("config/init.php");

if(isset($_POST["key"]) && $_POST["key"] == "TrustedRequest") {
  $url = $_POST["url"];
  // check if url is valid
  if (!filter_var($url, FILTER_VALIDATE_URL)) {
    echo "NOT_VALID_URL";
  }else {
    while(true) {
    $random_short_code = generateRandomString();
    $check = $db->prepare("select * from shorted_urls where shorted_code=" . $random_short_code);
    $check->execute();
    $count = $check->fetchColumn();
    if($count == 0) {
      $short_code = $random_short_code;
      break;
    }
  }
    $original_url = $url;
    $shorted_url = $_SERVER['HTTP_HOST'] . "/l/" . $short_code ;
    date_default_timezone_set('America/Los_Angeles');
    $date = date("Y/m/d h:i");
    $insert_url = $db->prepare("insert into shorted_urls (original_link,shorted_code,shorted_link,created_date) values
    ('".$original_url."','".$short_code."','".$shorted_url."','".$date."')");
    $insert_url->execute();
    $urls = json_decode($_COOKIE['user_urls'], true);
    if(count($urls) == 0) {
    $index_num = 0;
  }else {
    $index_num_ = count($urls) - 1;
    $index_num = $index_num_ + 1;
  }
    $urls[$index_num] = $short_code;
    setcookie("user_urls",json_encode($urls), time() + 31556926 , "/");
    echo $shorted_url;

  }
}else {
  header("Location: ../404.php");
}

// generate random code
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 ?>

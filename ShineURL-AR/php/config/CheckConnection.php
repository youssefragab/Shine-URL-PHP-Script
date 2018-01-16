<?php

// include databse connection
require_once "init.php";

// Connection Check Class
class CheckConnection {

// class varibles
public $response = null;
public $statue = null;

function __construct($stat) {
  $this->statue = $stat;
}


public function Checking() {
  // Checking
if ($this->statue == true) {

  $this->response = "established";

}else {
  $this->response = "failed";
}

}

public function Response() {
  return $this->response;
}

}

if(isset($_POST["key"])) {
$Connection_Staue = new CheckConnection($connection_statue);
$Connection_Staue->Checking();
$res = $Connection_Staue->Response();
echo $res;
}

 ?>

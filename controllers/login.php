<?php

class Login extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = "Login";
    $this->view = "login/login.php";
    $this->include_header = False;
    $this->include_footer = False;
    $this->css = "register";
    $this->js = "";
    $this->accessible = "not_loggedin";
    if (Session::get("loggedin")){
      echo "404 page not found";
      return;
    }
  }

  public function run(){
    if (isset($_POST['submit'])){
      $this->model->run();
    }
    else{
      return array("access" => "denied");
    }
  }

  public function error($params = Array()){
    echo "Wrong password";
  }

}


?>

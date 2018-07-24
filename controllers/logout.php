<?php

class Logout extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $accessible;

  public function __construct(){
    $this->title = "Log Out";
    $this->view = "logout/logout.php";
    $this->include_header = False;
    $this->include_footer = False;
    $this->css = "";
    $this->js = "";
    $this->accessible = "loggedin";
    Session::init();
    Session::destroy();
    header("Location: home");
    exit();
  }

}


?>

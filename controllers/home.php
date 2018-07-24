<?php

class Home extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = "Home";
    $this->view = "views/index.php";
    $this->include_header = True;
    $this->include_footer = False;
    $this->css = "home";
    $this->js = "home";
    $this->accessible = "all";
  }
}


?>

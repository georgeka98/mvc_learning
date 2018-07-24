<?php

class Index extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $path;
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the footer of the page should be included;
  public $css;
  public $js;

  public function __construct($path){
    $this->title = "Home";
    $this->view = $path;
    $this->path = "index.php";
    $this->include_footer = True;
    $this->include_header = True;
    $this->css = "";
    $this->js = "";
  }
}

?>

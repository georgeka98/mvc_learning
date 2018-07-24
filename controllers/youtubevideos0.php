<?php

class Youtubevideos extends Controller{

  private $title; //title of the controller (page)
  private $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;

  public function __construct(){
    $this->title = "About";
    $this->view = "views/about.php";
    $this->include_footer = False;
  }

  public function run(){
    $this->model->videos();
  }
}


?>

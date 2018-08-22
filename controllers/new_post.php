<?php

class New_post extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = "Create New Post";
    $this->view = "new_post/new_post.php";
    $this->include_header = False;
    $this->include_footer = False;
    $this->css = "new_post";
    $this->js = "new_post";
    $this->accessible = "allbutmbmebers";
  }
}
?>

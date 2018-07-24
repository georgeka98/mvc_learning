<?php

class Blog extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = YOUTUBE_CHANNEL_NAME;
    $this->view = "blog/blog.php";
    $this->include_header = True;
    $this->include_footer = True;
    $this->css = "blog";
    $this->js = "blog";
    $this->accessible = "all";
  }

  public function article($params){
    return $this->model->get_article(str_replace("-"," ",$params[0]));
  }

}


?>

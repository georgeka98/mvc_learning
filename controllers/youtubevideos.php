<?php

class Youtubevideos extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  //public $path; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = YOUTUBE_CHANNEL_NAME;
    $this->view = "youtubevideos/youtubevideos.php";
    // $this->path = "youtubevideos/youtubevideos.php";
    $this->include_header = True;
    $this->include_footer = True;
    $this->css = "youtubevideos";
    $this->js = "youtubevideos";
    $this->accessible = "all";
  }

  public function videos($params){
    return array("video_list" => $this->model->videos());
  }

  public function more_videos($params){ //executes on ajax request
    $video_num = $params[0];
    $data = $this->model->load_more($video_num);
    echo $data; //loads the "load_more" method from the youtubevideos_model model
  }

}


?>

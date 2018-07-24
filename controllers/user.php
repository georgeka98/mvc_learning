<?php

class User extends Controller{

  public $title; //title of the controller (page)
  public $view; //page
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = "User";
    $this->view = "user/user.php";
    $this->include_header = False;
    $this->include_footer = False;
    $this->css = "user";
    $this->js = "user";
    $this->accessible = "all";
  }

  public function id($params){
    $user_info = $this->model->get_user_info($params[0]);
    if ($this->title == "User"){ //doesnt work
      $this->title = $user_info['firstname']." ".$user_info['lastname'];
    }
    if ($params[0] == Session::user_data("ID") && Session::user_data("profilesetupstatus") < 4){
      header("Location: http://192.168.64.2/mvclearn/profile_setup/page/".Session::user_data("profilesetupstatus"));
      exit();
    }
    return $this->model->get_user_info($params[0]);
  }

  public function comments($params){
    echo $this->model->get_user_comments($params[0],$params[1],$params[2]);
  }
}


?>

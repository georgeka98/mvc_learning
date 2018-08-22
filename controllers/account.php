<?php

class Account extends Controller{

  public $view; //page
  public $title; //title of the controller (page)
  public $include_footer; //boolean determining whether the footer of the page should be included;
  public $include_header; //boolean determining whether the header of the page should be included;
  public $css;
  public $js;
  public $accessible;

  public function __construct(){
    $this->title = "Edit Account";
    $this->view = "account/account.php";
    $this->include_header = False;
    $this->include_footer = False;
    $this->css = "account";
    $this->js = "account";
    $this->accessible = "loggedin";
    if (Session::get("loggedin")){
      echo "404 page not found";
      return;
    }
  }

  public function edit($page){
    if (Session::user_data("profilesetupstatus") < 4){
      header("Location: http://192.168.64.2/mvclearn/profile_setup/page/".$page[0]);
      exit();
    }
    return array("page" => $page[0]);
    exit();
  }

  public function save($page){
    header("Location: http://192.168.64.2/mvclearn/account/edit/".$page[0]);
    return array("error_msg" => $this->model->save_details($page[0]), "page" => $page[0]);
    exit();
  }

}


?>

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
    if (count($params) == 1){
      return $this->model->get_article(str_replace("-"," ",$params[0]));
    }
  }

  public function feedback($params){
    echo $this->model->feedback($params);
  }

  public function comm_sect_pages($params){
    if (count($params) == 2){
      $blogId = $params[0];
      $display = $params[1];
      echo $this->model->comments_pages($blogId, $display);
    }
  }

  public function comments($params){
    if (count($params) == 4){
      $blogId = $params[0];
      $order = $params[1];
      $display = $params[2];
      $page = $params[3];
      echo $this->model->comments($blogId, $order, $display, $page);
    }
    else{
      echo "error";
    }
  }

  public function more_replies($params){
    if (count($params) == 3){
      $rootID = $params[0];
      $blogId = $params[1];
      $order = $params[2];
      echo $this->model->more_replies($rootID, $blogId, $order);
    }
    else{
      echo "error";
    }
  }

  public function submit_comment($params){
    if (Session::get("loggedin")){
      if (count($params) == 2){
        $comment = $params[0];
        $blogId = $params[1];
        echo $this->model->submit_comment($comment, $blogId);
      }
      else{
        echo "error";
      }
    }
  }

  public function submit_reply($params){
    if (Session::get("loggedin")){
      if (count($params) == 5){
        $comment = $params[0];
        $blogId = $params[1];
        $replied_to_comm_ID = $params[2];
        $replied_to_user_ID = $params[3];
        $root_ID = $params[4];
        echo $this->model->submit_reply($comment, $blogId, $replied_to_comm_ID, $replied_to_user_ID, $root_ID);
      }
      else{
        echo "error";
      }
    }
  }

  public function delete_comment($params){
    if (Session::get("loggedin")){
      if (count($params) == 3){
        $root_ID = $params[0];
        $comm_ID = $params[1];
        $blog_ID = $params[2];
        echo $this->model->delete_comment($root_ID, $comm_ID, $blog_ID);
      }
    }
  }

  public function edit_comment($params){
    if (Session::get("loggedin")){
      if (count($params) == 3){
        $comm_ID = $params[0];
        $blog_ID = $params[1];
        $edited_comment = $params[2];
        echo $this->model->edit_comment($comm_ID, $blog_ID, $edited_comment);
      }
    }
  }

  public function vote($params){
    if (Session::get("loggedin")){
      if (count($params) == 3){
        $comm_ID = $params[0];
        $blog_ID = $params[1];
        $vote = $params[2]; //like or dislike
        echo $this->model->vote($comm_ID, $blog_ID, $vote);
      }
    }
  }

  public function report_comment($params){
    if (count($params) == 2){
      $msg = $params[0];
      $comm_ID = $params[1];
      $user_ID = 0;
      if (Session::get("loggedin")){
        $user_ID = Session::user_data("ID");
      }

      echo $this->model->report($msg, $comm_ID, $user_ID);
    }
  }

}

?>

<?php

class View{

  public $data;
  public $css;
  public $js;
  public $title;

  function __construct($data = array(), $css = "", $js = "", $title = ""){
    $this->title = $title;
    $this->data = $data;
    $this->css = $css;
    $this->js = $js;
  }

  public function render($path, $render_footer, $render_header){
    include "views/includes/top.php";
    if($render_header == True){
      include "views/includes/header.php";
    }
    else{
      echo '</header>
            <div class="cont container">';
    }
    include "views/".$path;
    if($render_footer == False){
      echo '</div>';
    }
    else if($render_footer == True){
      include "views/includes/footer.php";
    }
    include "views/includes/copyright.php";
  }
}


?>

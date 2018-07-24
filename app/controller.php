<?php

/**
 *
 */
class Controller{

  function __construct(){
    echo "Main controller";
  }

  public function loadModel($name){
    $path = 'models/'.$name.'_model.php';
    if (file_exists($path)){
      require 'models/'.$name.'_model.php';
      $modelName = $name . '_model';
      $this->model = new $modelName;
      if (method_exists($this->model, "data")){ //method exists
        return $this->model->data();
      }
      return "";
    }
    return "";
  }

  public function accessible(){
    if (Session::get("loggedin")):
      return true;
    else:
      return false;
    endif;
  }
}


?>

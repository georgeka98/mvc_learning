<?php

require "app/controller.php";

class Bootstrap{

  protected $controller = DEFAULT_CONTROLLER;
  protected $method = DEFAULT_ACTION;
  protected $params = [];

  function __construct(){

    $this->controller = DEFAULT_CONTROLLER;
    $this->method = DEFAULT_ACTION;
    $this->params = [];

    $url = [];
    if (!isset($_GET['url']))
      $url = explode('/', rtrim(DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION, '/'));
    else
      $url = explode('/', rtrim($_GET['url'], '/'));
    // print_r($url); //debug

    print_r($url);

    if (isset($url[0])){
      if (file_exists("controllers/" . $url[0] . '.php')){

        require_once "controllers/" . $url[0] . '.php';
        $this->controller = new $url[0];

        if(isset($url[1])){
          if (method_exists($this->controller, $url[1])){
            $this->method = $url[1];
            unset($url[0]);
            unset($url[1]);
          }
          else{
            echo "404 page not found";
            return;
          }
        }

        $this->params = $url;
        call_user_func_array([$this->controller,$this->method],$this->params);

      }
      else{
        echo "404 page not found";
        return;
      }
    }
  }
}


?>

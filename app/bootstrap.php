<?php

require "app/controller.php";

class Bootstrap{

  protected $controller;
  protected $method;
  protected $params;
  protected $ajax;

  function __construct(){

    $this->controller = DEFAULT_CONTROLLER;
    $this->method = DEFAULT_ACTION;
    $this->params = [];
    $this->ajax = False;

    $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : null;
    // print_r($url); //debug

    if (isset($url[0]) && $url[0] != "home"){
      if (file_exists("controllers/" . $url[0] . '.php')){

        require_once "controllers/" . $url[0] . '.php';
        $this->controller = new $url[0];

        Session::init();

        //checking whether user is allowed to access this page
        if ($this->controller->accessible != "all"){
          if($this->controller->accessible == "loggedin" && !Session::get("loggedin")){
            echo "404 page not found";
            return;
          }else if($this->controller->accessible == "not_loggedin" && Session::get("loggedin")){
            echo "404 page not found";
            return;
          }
          else if($this->controller->accessible == 'allbutmbmebers' && (!Session::get("loggedin") || Session::get("role") == "member" || Session::get("role") == "subscriber")){
            echo "404 page not found";
            return;
          }
        }

        $view = new View();
        $view->title = $this->controller->title;
        $view->css = $this->controller->css;
        $view->js = $this->controller->js;

        $view->data = $this->controller->loadModel($url[0]);

        if(isset($url[1])){

          if ($url[1] == "ajax"){
            unset($url[0]);
            $url = array_values($url);
            $this->ajax = True;
          }

          if (method_exists($this->controller, $url[1])){
            $this->method = $url[1];
            unset($url[0]);
            unset($url[1]);
            $url = array_values($url);

            $view->data = $this->controller->{$this->method}($url);
          }
          else{
            echo "404 page not found";
            return;
          }
        }

        $this->params = $url;

        if ($this->ajax != True){
          if (is_array($view->data) && array_key_exists("access", $view->data) && $view->data["access"] == "denied"){
            echo "404 page not found";
            return;
          }
          else{
            if (is_array($view->data) && array_key_exists("title", $view->data)){
              $view->title = $view->data["title"];
            }
            $view->render($this->controller->view, $this->controller->include_footer, $this->controller->include_header);
          }
        }

      }
      else{
        echo "404 page not found";
        return;
      }
    }
    else{
      if ((isset($url[0]) && count($url) == 1) || !isset($url[0])){
        require_once "controllers/index.php";
        $index = new Index("home/home.php");
        $view = new View(array(),$index->css,$index->js,$index->title);

        $view->render($index->view, $index->include_footer, $index->include_footer);
      }
      else{
        echo "404 page not found";
        return;
      }
    }
  }
}


?>

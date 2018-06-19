<?php

/**
 *
 */
class Bootstrap{

  function __construct(){

      $url = explode('/', rtrim($_GET['url'], '/'));
      // print_r($url); //debug

      //checking if file exists
      // try {
      //   include_once "controllers/" . $url[0] . '.php';
      // } catch (Exception $e) {
      //   echo "File not found";
      // }

      if (file_exists("controllers/" . $url[0] . '.php')){

        require_once "controllers/" . $url[0] . '.php';

        $controller = new $url[0];

        if (isset($url[2])){
          $controller->{$url[1]}($url[2]);
        }
        else if (isset($url[1])){
          $controller->{$url[1]}();
        }

      }
      else{
        require "controllers/error.php";
        $controller = new Errors();
        //throw new Exception("The page: $url[0] You requested doenst exist");
      }

  }

}


?>

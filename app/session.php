<?php

class Session{

  public function init(){
    if(!isset($_SESSION))
    {
        session_start();
    }
  }

  public function set($key, $value){
    $_SESSION[$key] = $value;
  }

  public function get($key){
    if (isset($_SESSION[$key])){
      return $_SESSION[$key];
    }
    return False;
  }

  public function user_data($key){
    if (isset($_SESSION['auth'][$key])){
      return $_SESSION['auth'][$key];
    }
    return False;
  }

  public function user_all_data(){
    return $_SESSION['auth'];
  }

  public function update_all_data($data){
    $_SESSION['auth'] = $data;
  }

  public function destroy(){
    session_destroy();
  }

}

?>

<?php

  class Login_model extends Model{

    public function __construct(){
      parent::__construct();
    }

    public function run(){

      $email       = htmlspecialchars($_POST['email'], ENT_QUOTES, UTF-8);
      $pwd         = htmlspecialchars($_POST['pwd'], ENT_QUOTES, UTF-8);
      $remember_me = isset($_POST['remember_me']) ? htmlspecialchars($_POST['remember_me'], ENT_QUOTES, UTF-8) : "";

      $auth = $this->db->prepare("SELECT * FROM users WHERE email = :email");
      $auth->execute(array(':email' => $email));
      $data = $auth->fetchAll();
      $rows = $auth->rowCount();

      if($rows == 0){
        header("Location: ../login?error=wrong-details"); //error: email and passwod do not match
        exit();
      }

      $hashed_pwd = $data[0]['pwd'];
      $hash = password_verify($pwd, $hashed_pwd);

      if ($hash == 0){
        header("Location: ../login?error=wrong-details"); //error: email and passwod do not match
        exit();
      }
      else{

        $user = $this->db->prepare("SELECT * FROM users WHERE email = :email && pwd = :pwd");
        $user->execute(array(':email' => $email, ':pwd' => $hashed_pwd));
        $user_info = $user->fetch(PDO::FETCH_ASSOC);

        if ($user_info != False){

          include_once "remember-me.php";
          remember_me($remember_me, $email,$pwd);

          //adding country flag name
          $user_info["country-flag"] = $user_info['country']; //used to get the flag of the country which includes dashes "-"
          $user_info["country"] = str_replace("-", " ", $user_info['country']);

          //checking if profile pcture exists
          if ($user_info["profile_icon"] == NULL){
            $user_info["profile_icon"] = "default-profile-picture.jpg";
          }

          Session::init();
          $_SESSION['loggedin'] = True;
          $_SESSION['auth'] = $user_info;

          header("Location: .."); //error: email and passwod do not match
          exit();
        }
        else{
          header("Location: ../login?error=wrong-details"); //error: email and passwod do not match
          exit();
        }
      }
    }
  }

?>

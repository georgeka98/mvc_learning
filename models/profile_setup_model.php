<?php

class Profile_setup_model extends Model{

  public function __construct(){
    parent::__construct();
    $this->id = Session::user_data("ID");
  }

  public function save_details($page){
    if($page == 2){
      $first_name = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
      $middle_name = htmlspecialchars($_POST['middlename'], ENT_QUOTES, 'UTF-8');
      $last_name = htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8');
      $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
      $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
      $birthday = htmlspecialchars($_POST['birthDate_year']."-".$_POST['birthDate_month']."-".$_POST['birthDate_day'], ENT_QUOTES, 'UTF-8');
      $country= htmlspecialchars(str_replace(" ", "-", $_POST['country']), ENT_QUOTES, 'UTF-8');
      $about_me = htmlspecialchars($_POST['about_me'], ENT_QUOTES, 'UTF-8');
      $interests = htmlspecialchars($_POST['interests'], ENT_QUOTES, 'UTF-8');
      $main_website = htmlspecialchars($_POST['main_website'], ENT_QUOTES, 'UTF-8');

      echo $middle_name;

      // $user = $this->db->prepare("UPDATE users SET firstname=:firstname, middlename=:middlename, lastname=:lastname, username=:username,
      //                                               gender=:gender, birthday=:birthday, country=:country, about_me=:about_me, interests=:interests,
      //                                               main_website=:main_website WHERE ID=:id");
      //$user->execute(array(":firstname" => $first_name, ":middlename" => $middle_name, ":lastname" => $last_name, ":username" => $username, ":gender" => $gender, ":birthday" => $birthday, ":country" => $country, ":about_me" => $about_me, ":interests" => $interests, ":main_website" => $main_website, ':id' => $this->id));
      $user = $this->db->prepare("UPDATE users SET firstname=?, middlename=?, lastname=?, username=?,
                                                     gender=?, birthday=?, country=?, about_me=?, interests=?,
                                                     main_website=? WHERE ID=?");
      $user->execute(array($first_name, $middle_name, $last_name, $username, $gender, $birthday, $country, $about_me, $interests, $main_website, $this->id));

      $user = $this->db->prepare("SELECT * FROM users WHERE ID = :id");
      $user->execute(array(':id' => $this->id));
      $info = $user->fetch(PDO::FETCH_ASSOC);
      //print_r($info); //debug
      Session::update_all_data($info);
    }
    else if($page == 3){

      $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
      //$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
      $cur_password = htmlspecialchars($_POST['cur_password'], ENT_QUOTES, 'UTF-8');
      $new_password = htmlspecialchars($_POST['new_password'], ENT_QUOTES, 'UTF-8');
      $new_conf_password = htmlspecialchars($_POST['new_conf_password'], ENT_QUOTES, 'UTF-8');
      $country_telephone_code = htmlspecialchars($_POST['country_telephone_code'], ENT_QUOTES, 'UTF-8');
      $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
      $address_1 = htmlspecialchars($_POST['address_1'], ENT_QUOTES, 'UTF-8');
      $address_2 = htmlspecialchars($_POST['address_2'], ENT_QUOTES, 'UTF-8');
      $town = htmlspecialchars($_POST['town'], ENT_QUOTES, 'UTF-8');
      $state = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
      $postcode = htmlspecialchars($_POST['postcode'], ENT_QUOTES, 'UTF-8');

      //$user = $this->db->prepare("UPDATE users SET title=:title, email=:email, birthday=:birthday, address_1=:address_1, address_2=:address_2, town=:town, state=:state, postcode_or_zipcode=:postcode_or_zipcode, country=:country WHERE ID=:id");
      //$user->execute(array(":title" => $title, ":email" => $email, ":country_telephone_code" => $country_telephone_code, ":phone_number" => $phone_number, ":address_1" => $address_1, ":address_2" => $address_2, ":town" => $town, ":state" => $state, ":postcode_or_zipcode" => $postcode, ':id' => $this->id));

      $user = $this->db->prepare("UPDATE users SET title=?, country_telephone_code=?, phone_number=?address_1=?, address_2=?, town=?, state=?, postcode_or_zipcode=? WHERE ID=?");

      $user->execute(array($title, $country_telephone_code, $phone_number, $address_1, $address_2, $town, $state, $postcode, $this->id));

      $user = $this->db->prepare("SELECT * FROM users WHERE ID = :id");
      $user->execute(array(':id' => $this->id));
      $info = $user->fetch(PDO::FETCH_ASSOC);
      //print_r($info); //debug
      Session::update_all_data($info);

    }
  }

  public function update_progress($page){

    $user = $this->db->prepare("SELECT * FROM users WHERE ID = :id");
    $user->execute(array(':id' => $this->id));
    $info = $user->fetch(PDO::FETCH_ASSOC);

    if ($info["profilesetupstatus"] < $page){
      $user = $this->db->prepare("UPDATE users SET profilesetupstatus=:profilesetupstatus WHERE ID=:id");
      $user->execute(array(":profilesetupstatus" => $page, ':id' => $this->id));
      $info["profilesetupstatus"] = $page;
    }

    Session::update_all_data($info);
  }

}


?>

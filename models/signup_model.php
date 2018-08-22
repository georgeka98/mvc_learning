<?php

class Signup_model extends Model{

  public function __construct(){
    parent::__construct();
  }

  public function run(){

    $first       = htmlspecialchars($_POST['first-name'], ENT_QUOTES, 'UTF-8');
    $last        = htmlspecialchars($_POST['last-name'], ENT_QUOTES, 'UTF-8');
    $uid         = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $email       = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $pwd         = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');
    $pwd_ver     = htmlspecialchars($_POST['ver-pwd'], ENT_QUOTES, 'UTF-8');
    $remember_me = isset($_POST['remember_me']) ? htmlspecialchars($_POST['remember_me'], ENT_QUOTES, 'UTF-8') : "";

    $return = $this->error_check($first,$last,$uid,$email,$pwd,$pwd_ver);

    if ($return != "true"){
      header("Location: ../signup&error=".$return);
    }
    else {
      //tocken generation

      include_once "remember-me.php";

      remember_me($remember_me, $email,$pwd);

      $confirmToken = "";

      $NonSymbols = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
      $arrLen = count($NonSymbols);
      for($i = 0; $i<64; $i++){
        $int = mt_rand(0, $arrLen-1); //generates a random integer using the Mersenne Twister algorithm. Its 4 times faster and produces a better random value than the rand() function
        $char = $NonSymbols[$int];
        $confirmToken = $confirmToken.$char; //creating the token
      }

      $message =
      "
      Please follow the instruction below to confirm your email:

      Click on this link: http://".BASE_DIR."email_confirmation/tk/".$confirmToken." to validate your email address. If you encounter any issues, please contact us by clicking on this link: http://".BASE_DIR."contact_us

      Please ignore this email if your received this by mistake.

      Enjoy.

      The TechPocket team
      ";

      mail($email,"TECHPOCKET: EMAIL CONFIRMATION",$message,"FROM: donotreply@techpocketnews.com");

      $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
      $confirmed = "0";
	    $date_joined = date("Y-m-d");

      $user = $this->db->prepare("INSERT INTO users (date_joined, firstname, lastname, email, username, pwd, confirmCode, confirmed, profilesetupstatus)
                                            VALUES (:date_joined, :firstname, :lastname, :email, :username, :pwd, :confirmCode, :confirmed, :profilesetupstatus)");
      $user->execute(array(':date_joined' => $date_joined, ':firstname' => $first, ':lastname' => $last, ':email' => $email, ':username' => $uid, ':pwd' => $hash_pwd, ':confirmCode' => $confirmToken, ':confirmed' => $confirmed, ":profilesetupstatus" => "1"));

      //echo $user;

      //**** CREATING THE PREPARED STATEMENT ****
      $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username"); //creating the prepared statement and runs it into the server database
      $stmt->execute(array(':username' => $uid)); //binding the user input (in this case is the email)
      $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
      //$userInfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE username = '".$uid."'"));

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
      header('Location: ../profile_setup/page/1');
      exit();
    }

  }

  public function error_check($first,$last,$uid,$email,$pwd,$pwd_ver){
    $acceptableChar = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","'","-");
    $alphabet = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $numbers = array("1","2","3","4","5","6","7","8","9","0");

    $return = $this->nameVal($acceptableChar, $first, "null");
    if($return != "true"){
      if ($return == "empty"){
        return "empty_first_name";
      }
			return $return;
		}
		$return = $this->nameVal($acceptableChar, $last, "null");
		if($return != "true"){
      if ($return == "empty"){
        return "empty_last_name";
      }
			return $return;
		}
		$return = $this->uidVal($uid, $pwd);
		if($return != "true"){
      if ($return == "empty"){
        return "empty_user_name";
      }
			return $return;
		}
		$return = $this->emailVal($email);
		if($return != "true"){
      if ($return == "empty"){
        return "empty_email";
      }
			return $return;
		}
		$return = $this->pwdVal($alphabet, $numbers, $pwd, $first, $last, $uid);
		if($return != "true" && $return != "passAndVerTrue"){
      if ($return == "empty"){
        return "empty_password";
      }
			return $return;
		}
		$return = $this->pwdVer($pwd, $pwd_ver);
		if($this->pwdVer($pwd, $pwd_ver) != "true"){
      if ($return == "empty"){
        return "empty_password_confirm";
      }
			return $return;
		}
    return $return;
  }

  public function nameVal($characters, $val){
    if($val == ""){
      return "empty";
    }
    else if($val == ""){
      return "none"; //no border colour change or message to be printed is needed
    }
    for($i = 0; $i<strlen($val); $i++){
      for($char = 0; $char<count($characters); $char++){
        if(strtoupper($val[$i]) == $characters[$char]){
          break;
        }
        if($char == count($characters)-1){
          return "firstNoAlphabet";
        }
      }
    }
    return "true";
  }

  function uidVal($uid, $pwd){

    $user = $this->db->prepare("SELECT username FROM users WHERE username = :username");
    $user->execute(array(':username' => $uid));
    $rows = $user->rowCount();

    if($rows >= 1){
      return "uidExists";
    }
    else if($uid !== "" && strpos(strtoupper($pwd), strtoupper($uid)) !== false){
      return "containsUid";
    }
    else if($uid == ""){
      return "empty";
    }
    else{
      return "true";
    }
  }

  function emailVal($email){
		$hasAt = false; //Email contains at (@) symbol
		$DotAfterAt = false; //Email contains a domain name (contains a dot '.' after the host name).
		$hasMoreAt = false; //Email contains more than 1 @ symbols
		$UnallowedChar = true; //if character which is not allwed is found
		$UserName = ""; //username
		$hostName = ""; //host name
		$domain = ""; //domain name
		$acceptedChar = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0","-","!","#","$","%","&","'","*","+","/","=","?","^","_","`","{","|","}","~",";"); //all the accepted characters in the email
		if($email == ""){
			return "emptyEmail";
		}
		for($i = 0; $i<strlen($email); $i++){
			for($c = 0; $c<count($acceptedChar); $c++){ //first child loop (loops through each character from the acceptedChar array in order to check whether the current charactrer form the email is allowed or not)
				if($c > 36 && $hasAt == true){ //if the host nane part is being validated
					if($UnallowedChar == true){ //if an unallowed character is found
						return "UnallowedChar";
					}
					break; //break the first child loop
				}
				if($acceptedChar[$c] == $email[$i]){ //if the current character of the email matches with the currect character from the acceptedChar array. Used to determine whether the current character of the email is allowed
					$UnallowedChar = false;
				}
				else if($email[$i] == "@" && $hasAt != true){ //if the @ symbol is found (the first @ symbol found)
					$hasAt = true;
					break;
				}
				else if($email[$i] == "@" && $hasAt == true){ //if more than 1 @ symbol is found
					$hasMoreAt = true;
					return "MoreThanOneAt";
				}
				else if($email[$i] == "." && $hasAt == true && $DotAfterAt == false){
					$DotAfterAt = true; //if a . character is found after the @ symbol
					break;
				}
				else if($email[$i] == "." && $hasAt == true && $DotAfterAt != false){
					return "WrongDot";
				}
				else if($hasAt == false){ //if @ symbol is not found yet (username part)
					$UserName = $UserName.$email[$i];
					break;
				}
				else if($hasAt == true && $DotAfterAt == false){ //if @ symbol is found but not a . character (host name part)
					$hostName = $hostName.$email[$i];
					break;
				}
				else if($hasAt == true && $DotAfterAt == true){ //if a . character is found (domnain name part)
					$domain = $domain.$email[$i];
					break;
				}
			}
			if($i == strlen($email) - 1){
				if($hasAt == false){
					return "NoAtSymbol";
				}
			}
		}
		if($UserName != "" && $hostName != "" && $domain != ""){

      $user = $this->db->prepare("SELECT email FROM users WHERE email = :email");
      $user->execute(array(':email' => $email));
      $rows = $user->rowCount();

			if($rows >= 1){
				return "emailExists";
			}
			else{
				return "true";
			}
		}
		else if($UserName == ""){
			return "noUserName";
		}
		else if($hostName == ""){
			return "noHostName";
		}
		else if($domain == ""){
			return "noDomain";
		}
	}

  function pwdVal($alphabet, $numbers, $pwd, $first, $last, $uid){
    $pwdInRange = true;
    $hasNumber = true;
    $hasLetter = true;
    // $hasSpecialChar = false;
    if($pwd == ""){
      return "empty";
    }
    if(strlen($pwd) < 8 || strlen($pwd) > 32){
      $pwdInRange = false;
    }
    if(!$pwdInRange){
      return "OffRange";
    }
    else if($first !== "" && strpos(strtoupper($pwd), strtoupper($first)) !== false){
      return "containsFirst";
    }
    else if($last !== "" && strpos(strtoupper($pwd), strtoupper($last)) !== false){
      return "containsLast";
    }
    else if($uid !== "" && strpos(strtoupper($pwd), strtoupper($uid)) !== false){
      return "containsUid";
    }
    else if($pwdInRange && $hasNumber && $hasLetter){
      $this->pwdMeter($pwd);
      return "true";
    }
  }

  function pwdMeter($pwd){
    $letters = array();
    $numbers = array("0","1","2","3","4","5","6","7","8","9");
    $specialChar = array("!","@","#","$","%","^","&","*","(",")","_","+","{","}",":",'"',"|","<",">","?");
    $NonSymbols = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    $letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $score = 0;

    //************* SCORE ADDITIONS **************

  //Number of characters
    $length = strlen($pwd);
    $ScoreNumOfChar = $length*4;  //number of characters score (n*4)
  //Number of Uppercase letters
    $upperLetters = 0;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($letters); $c++){
        if(strtoupper($letters[$c]) == $pwd[$i]){ //checking if the looped uppercase letter matches the looped letter of the password.
          $upperLetters = $upperLetters + 1;
          break;
        }
      }
      if($i == strlen($pwd)-1 && $upperLetters == 0){ //if there are no uppercase letters and the last character is looped from the password
        $upperLetters = $length;
      }
    }
    $upperLetScore = ($length - $upperLetters)*2; //number of characters score (length-n)*4
  //Number of Lowercase letters
    $lowerLetters = 0;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($letters); $c++){
        if(strtolower($letters[$c]) == $pwd[$i]){
          $lowerLetters = $lowerLetters + 1;
          break;
        }
      }
      if($i == strlen($pwd)-1 && $lowerLetters == 0){
        $lowerLetters = $length;
      }
    }
    $lowerLetScore = ($length - $lowerLetters)*2; //number of characters score (length-n)*4
  //Number of numerical characters (0-9)
    $NumOfNumbers = 0;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($numbers); $c++){
        if($numbers[$c] == $pwd[$i]){
          $NumOfNumbers = $NumOfNumbers + 1;
          break;
        }
      }
    }
    $NumbersScore = $NumOfNumbers*4; //number of characters score n*4
  //Number of symbols
    $NumOfSymbols = 0;
    for($i = 0; $i<strlen($pwd); $i++){
      for($j = 0; $j<count($NonSymbols); $j++){
        if(strtoupper($pwd[$i]) == $NonSymbols[$j]){
          break;
        }
        if($j == count($NonSymbols)-1){
          $NumOfSymbols = $NumOfSymbols + 1;
        }
      }
    }
    $SymbolScore = $NumOfSymbols*6; //number of characters score n*6 $letters
  //Number of Middle Numbers or Symbols (MNS)
    $NumOfMNS = 0;
    for($i = 1; $i<strlen($pwd)-1; $i++){
      for($j = 0; $j<count($letters); $j++){
        if(strtoupper($pwd[$i]) == $letters[$j]){ //checking if the looped character is letter.
          break;
        }
        if($j == count($letters)-1){ //if the looped character is not a leter (but symbol or number)
          $NumOfMNS = $NumOfMNS + 1;
        }
      }
    }
    $ScoreOfMNS = $NumOfMNS*2; //Score of Middle Numbers or Symbols (MNS)
  //Requirements:
  //* 8 characters in length
  //* Contains 3/4 of the following items:
  //  - Uppercase Letters
  //  - Lowercase Letters
  //  - Numbers
  //  - Symbols
    $Requirements = 0;
    $RequirementsScore = 0;
    if($upperLetScore > 0){
      $Requirements = $Requirements + 1;
    }
    if($lowerLetScore > 0){
      $Requirements = $Requirements + 1;
    }
    if($NumbersScore > 0){
      $Requirements = $Requirements + 1;
    }
    if($SymbolScore > 0){
      $Requirements = $Requirements + 1;
    }
    if($Requirements == 3 && $length >= 8){
      $RequirementsScore = 8;
    }
    else if($Requirements == 4 && $length >= 8){
      $RequirementsScore = 10;
    }

    //*********** SCORE DEDUCTIONS ***********

  //Only letters
    $lettersOnly = 0;
    for($c = 0; $c<strlen($pwd); $c++){
      for($i = 0; $i<count($letters); $i++){
        if($letters[$i] == strtoupper($pwd[$c])){
          $lettersOnly = $lettersOnly + 1;
          break;
        }
        if($i == count($letters)-1){
          $lettersOnly = 0;
        }
      }
      if($lettersOnly == 0){
        break;
      }
    }
    $lettersOnly = $lettersOnly*(-1);
  //Only numbers
    $numbersOnly = 0;
    for($c = 0; $c<strlen($pwd); $c++){
      for($i = 0; $i<count($numbers); $i++){
        if($numbers[$i] == ($pwd[$c])){
          $numbersOnly = $numbersOnly + 1;
          break;
        }
        if($i == count($numbers)-1){
          $numbersOnly = 0;
        }
      }
      if($numbersOnly == 0){
        break;
      }
    }
    $numbersOnly = $numbersOnly*(-1);
  //Consecutive Uppercase Letters
    $consecutiveUpper = 0;
    $UpperCounter = 0; //counts how many uppercase letters are repeated
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($letters); $c++){
        if(strtoupper($letters[$c]) == $pwd[$i]){
          $UpperCounter = $UpperCounter + 1;
          if($i == strlen($pwd)-1){
            $consecutiveUpper = $consecutiveUpper + $UpperCounter - 1;
          }
          break;
        }
        else if($c == count($letters)-1 && $UpperCounter != 0){
          $consecutiveUpper = $consecutiveUpper + $UpperCounter - 1;
          $UpperCounter = 0;
        }
      }
    }
    $consecutiveUpper = $consecutiveUpper*(-2);
  //Consecutive Lowercase Letters
    $consecutiveLower = 0;
    $LowerCounter = 0; //counts how many lowercase letters are repeated
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($letters); $c++){
        if(strtolower($letters[$c]) == $pwd[$i]){
          $LowerCounter = $LowerCounter + 1;
          if($i == strlen($pwd)-1){
            $consecutiveLower = $consecutiveLower + $LowerCounter - 1;
          }
          break;
        }
        else if($c == count($letters)-1 && $LowerCounter != 0){
          $consecutiveLower = $consecutiveLower + $LowerCounter - 1;
          $LowerCounter = 0;
        }
      }
    }
    $consecutiveLower = $consecutiveLower*(-2);
  //Consecutive numbers
    $consecutiveNumbers= 0;
    $NumberCounter = 0; //counts how many numbers are repeated
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($numbers); $c++){
        if($numbers[$c] == $pwd[$i]){
          $NumberCounter = $NumberCounter + 1;
          if($i == strlen($pwd)-1){
            $consecutiveNumbers = $consecutiveNumbers + $NumberCounter - 1;
          }
          break;
        }
        else if($c == count($numbers)-1 && $NumberCounter != 0){
          $consecutiveNumbers = $consecutiveNumbers + $NumberCounter - 1;
          $NumberCounter = 0;
        }
      }
    }
    $consecutiveNumbers = $consecutiveNumbers*(-2);
  //Sequential letters (abc...)
    $SequentialLetters = 0;
    $count = 0;
    $inc = true;
    $dec = true;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($letters); $c++){
        if(strtoupper($letters[$c]) == strtoupper($pwd[$i])){
          $arrIndex = array_search(strtoupper($pwd[$i]), $letters);
          if($count == 0){
            $count = $count + 1;
          }
          else if($i != 0){
            if($arrIndex > 0 && $letters[$arrIndex-1] == strtoupper($pwd[$i-1]) && $dec == true){
              $count = $count + 1;
              $dec = true;
              $inc = false;
            }
            else if($arrIndex < count($letters) - 1 && $letters[$arrIndex+1] == strtoupper($pwd[$i-1]) && $inc == true){
              $count = $count + 1;
              $inc = true;
              $dec = false;
            }
            else{
              $count = 0;
              $inc = true;
              $dec = true;
            }
          }
          if($count >= 3){
            $SequentialLetters = $SequentialLetters + 1;
          }
          break;
        }
      }
    }
    $SequentialLetters = $SequentialLetters*(-3);
  //Sequential numbers (123...)
    $SequentialNumbers = 0;
    $count = 0;
    $inc = true;
    $dec = true;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($numbers); $c++){
        if($numbers[$c] == $pwd[$i]){
          $arrIndex = array_search($pwd[$i], $numbers);
          if($count == 0){
            $count = $count + 1;
          }
          else if($i != 0){
            if($arrIndex > 0 && $numbers[$arrIndex-1] == $pwd[$i-1] && $dec == true){
              $count = $count + 1;
              $dec = true;
              $inc = false;
            }
            else if($arrIndex < count($numbers) - 1 && $numbers[$arrIndex+1] == $pwd[$i-1] && $inc == true){
              $count = $count + 1;
              $inc = true;
              $dec = false;
            }
            else{
              $count = 0;
              $inc = true;
              $dec = true;
            }
          }
          if($count >= 3){
            $SequentialNumbers = $SequentialNumbers + 1;
          }
          break;
        }
      }
    }
    $SequentialNumbers = $SequentialNumbers*(-3);
  //Sequential special characters (!@#...)
    $SequentialSpecial = 0;
    $count = 0;
    $inc = true;
    $dec = true;
    for($i = 0; $i<strlen($pwd); $i++){
      for($c = 0; $c<count($specialChar); $c++){
        if($specialChar[$c] == $pwd[$i]){
          $arrIndex = array_search($pwd[$i], $specialChar);
          if($count == 0){
            $count = $count + 1;
          }
          else if($i != 0){
            if($arrIndex > 0 && $specialChar[$arrIndex-1] == $pwd[$i-1] && $dec == true){
              $count = $count + 1;
              $dec = true;
              $inc = false;
            }
            else if($arrIndex < count($specialChar) - 1 && $specialChar[$arrIndex+1] == $pwd[$i-1] && $inc == true){
              $count = $count + 1;
              $inc = true;
              $dec = false;
            }
            else{
              $count = 0;
              $inc = true;
              $dec = true;
            }
          }
          if($count >= 3){
            $SequentialSpecial = $SequentialSpecial + 1;
          }
          break;
        }
      }
    }
    $SequentialSpecial = $SequentialSpecial*(-3);

    $score = $ScoreNumOfChar + $upperLetScore + $lowerLetScore + $NumbersScore + $SymbolScore + $ScoreOfMNS + $RequirementsScore + $lettersOnly + $numbersOnly + $consecutiveUpper +  $consecutiveLower + $consecutiveNumbers + $SequentialLetters + $SequentialNumbers + $SequentialSpecial;
    // echo "<br/>".$ScoreNumOfChar."<br/>";
    // echo $upperLetScore."<br/>";
    // echo $lowerLetScore."<br/>";
    // echo $NumbersScore."<br/>";
    // echo $SymbolScore."<br/>";
    // echo $ScoreOfMNS."<br/>";
    // echo $RequirementsScore."<br/>";
    // echo $lettersOnly."<br/>";
    // echo $numbersOnly."<br/>";
    // echo $consecutiveUpper."<br/>";
    // echo $consecutiveLower."<br/>";
    // echo $consecutiveNumbers."<br/>";
    // echo $SequentialLetters."<br/>";
    // echo $SequentialNumbers."<br/>";
    // echo $SequentialSpecial."<br/>";

    if($score > 100){
      return 100;
    }
    else if($score < 0){
      return 0;
    }
    return $score;
  }

  function pwdVer($pwd, $pwd_ver){
    if($pwd == $pwd_ver && $pwd_ver != ""){
      return "true";
    }
    else if($pwd_ver == ""){
      return "empty";
    }
    else{
      return "pwdNotMatch";
    }
  }
}


?>

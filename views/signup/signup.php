<section class="login-form">
  <div class="vertical">
    <div class="login_wrapper">
      <hi class="title">Sign in</hi>
      <div class="fields_wrapper">
        <form action="signup/run" method="POST" class="form">
          <div class="table-wrapper">
            <?php
              if (isset($_GET["error"])){
                if($_GET["error"] == "uidExists"){
  								echo "<p class='error_msg'>Username already exists.</p>";
  							}
  							else if($_GET["error"] == "emailExists"){
  								echo "<p class='error_msg'>Email already exists.</p>";
  							}
  							else if($_GET["error"] == "UnallowedChar"){ //if the password is not between 8 and 72 characters in length
  								echo "<p class='error_msg'>Email contains an unallowed character</p>";
  							}
  							else if($_GET["error"] == "MoreThanOneAt"){ //if passwod contains first name inputted
  								echo "<p class='error_msg'>Email must not contain more than one @ symbol</p>";
  							}
  							else if($_GET["error"] == "WrongDot"){ //if passwod contains last name inputted
  								echo "<p class='error_msg'>Email contains one or more dots in the wrong position</p>";
  							}
  							else if($_GET["error"] == "NoAtSymbol"){ //if password contains the inputted username
  								echo "<p class='error_msg'>Email must contain an @ symbol</p>";
  							}
  							else if($_GET["error"] == "noUserName"){ //if passwod contains first name inputted
  								echo "<p class='error_msg'>Email doesn't contain the username part before tha @ symbol.</p>";
  							}
  							else if($_GET["error"] == "noHostName"){ //if passwod contains last name inputted
  								echo "<p class='error_msg'>Email doesn't contain the hostname part after the @ symbol.</p>";
  							}
  							else if($_GET["error"] == "noDomain"){ //if password contains the inputted username
  								echo "<p class='error_msg'>Email doesn't contain the domain part at the end.</p>";
  							}
  							else if($_GET["error"] == "empty_first_name"){
  								echo "<p class='error_msg'>First name cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "empty_last_name"){
  								echo "<p class='error_msg'>Last name cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "empty_user_name"){
  								echo "<p class='error_msg'>User name cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "empty_email"){
  								echo "<p class='error_msg'>Email cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "empty_password"){
  								echo "<p class='error_msg'>Password cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "empty_password_confirm"){
  								echo "<p class='error_msg'>Password confirmation cannot be left blank.</p>";
  							}
                else if($_GET["error"] == "OffRange"){
  								echo "<p class='error_msg'>Password must be Between 8 and 32 characters.</p>";
  							}
                else{
                  echo "<p class='error_msg'>An uknown error occured. Please, try again or try later.</p>";
                }
              }
						?>
            <div class="class-form-wrapper">
              <div class="social_login fields">
                <a type="text" class="facebook_login">
                  <span class="facebook-icon"></span>
                  Facebook Sign Up
                </a>
                <a type="text" class="twitter_login">
                  <span class="twitter-icon"></span>
                  Twitter Sign Up
                </a>
                <a type="text" class="google_login">
                  <span class="google-icon"></span>
                  Google Sign Up
                </a>
              </div>
              <div class="seperator">
                <span class="line"></span>
                <p>or</p>
              </div>
              <div class="login fields">
                <input type="text" placeholder="First Name" name="first-name" class="first-name">
                <input type="text" placeholder="Last Name" name="last-name" class="last-name">
                <input type="text" placeholder="Username" name="username" class="username">
                <input type="email" placeholder="Email" name="email" class="email">
                <input type="password" placeholder="New Password" name="pwd" class="pwd">
                <input type="password" placeholder="Verify Password" name="ver-pwd" class="ver-pwd">
                <div class="remember_me_wrapper input">
                  <input type="checkbox" id="remember_me" class="checkbox" name="remember_me" />
                  <label class="remember_me_label" for="remember_me">
                    <span></span>
                    Remember Me
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="input">
            <input type="checkbox" id="terms_of_service" class="checkbox" name="terms_of_service" checked />
            <label class="terms_of_service_label" for="terms_of_service">
              <span></span>
              I understand the terms of service and I accept
            </label>
          </div>
          <div class="input">
            <input type="checkbox" id="email_not" class="checkbox" name="email_not" checked />
            <label class="email_not_label" for="email_not">
              <span></span>
              I want to receive email notifications
            </label>
          </div>
          <input type="submit" name="submit" class="submit" value="Sign up">
        </form>
      </div>
      <p>Don't have an account? Login <a href="login" class="login">here</a></p>
      <div class="login_end_separator">

      </div>
      <p>By proceeding, you agree to our <a href="terms_of_service" class="terms_of_service">Terms of Service</a>. To find out what personal data we collect and how we use it, please visit our <a href="privacy_policy" class="privacy_policy">Privacy Policy</a> to learn more.</p>
    </div>
  </div>
</section>

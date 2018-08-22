
<!-- <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.0'
    });

    FB.AppEvents.logPageView();

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,  // enable cookies to allow the server to access
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script> -->
<section class="login-form">
  <div class="vertical">
    <div class="login_wrapper">
      <hi class="title">Welcome back, user</hi>
      <div class="fields_wrapper">
        <form action="login/run" method="POST" class="form">
          <div class="table-wrapper">
            <?php if(isset($_GET["error"]) && $_GET["error"] == "wrong-details"): ?>
              <p class="error_msg">Either email or password is wrong. Please, try again or reset your password.</p>
            <?php endif; ?>
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

                <!--
                  Below we include the Login Button social plugin. This button uses
                  the JavaScript SDK to present a graphical Login button that triggers
                  the FB.login() function when clicked.
                -->

                <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                </fb:login-button> -->
                <input type="email" placeholder="example@me.com" class="email" name="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} else{echo "";};?>">
                <input type="password" placeholder="Password" class="pwd" name="pwd" value="<?php if(isset($_COOKIE['pwd'])){echo $_COOKIE['pwd'];} else{echo "";};?>">
                <div class="remember_me_wrapper input">
                  <input type="checkbox" id="remember_me" class="checkbox" name="remember_me" value="scales" />
                  <label class="remember_me_label" for="remember_me">
                    <span></span>
                    Remember Me
                  </label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" name="submit" class="submit" value="Log in">
        </form>
      </div>
      <p>Don't have an account? Signup <a href="signup" class="signup">here</a></p>
      <a href="forgot_password" class="signup">Forgot Password?</a>
      <div class="login_end_separator">

      </div>
      <p>By proceeding, you agree to our <a href="terms_of_service" class="terms_of_service">Terms of Service</a>. To find out what personal data we collect and how we use it, please visit our <a href="privacy_policy" class="privacy_policy">Privacy Policy</a> to learn more.</p>
    </div>
  </div>
</section>

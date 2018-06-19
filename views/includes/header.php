<?php

  session_start();
  include_once "config/config.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <title><?=$_GET['controller']?></title>
    <link href="css/main.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <header>
      <div class="top">
        <span class="social">
          <a href="https://www.facebook.com/techpocketofficial"><img src="<?=MEDIA_STORAGE_URL?>fb.png" alt="FB" class="facebook"></a>
          <a href="https://twitter.com/techpocket1"><img src="<?=MEDIA_STORAGE_URL?>twitter.png" alt="T" class="twitter"></a>
          <a href="https://plus.google.com/+techpocketvideo"><img src="<?=MEDIA_STORAGE_URL?>g+.png" alt="G" class="google_plus"></a>
        </span>
        <span class="join">
          <?php if (!isset($_SESSION['auth']) ?>
          <a href="views/login" class="login">Log in</a>
          <a href="views/signup" class="signup">Sign up</a>
          <?php   if ($_SESSION['auth']['subscribe'] == 0) ?>
          <a href="#" class="subscribe">Subscribe</a>
          <?php else ?>
          <a href="views/account" class="subscribe">Subscribe</a>
        </span>
      </div>
      <div class="header">

      </div>
    </header>
  </body>
</html>

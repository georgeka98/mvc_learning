<?php

  Session::init();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title><?=$this->title?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="<?= BASE_DIR?>views/css/main.sass" rel="stylesheet" type="text/css"/>
    <link href="<?= BASE_DIR?>views/css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600" rel="stylesheet">
    <?= $this->css != "" ? '<link href='.BASE_DIR.'views/css/'.$this->css.'.css rel="stylesheet" type="text/css"/>' : "" ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'
      https://www.facebook.com https://www.youtube.com https://fonts.googleapis.com https://cdnjs.cloudflare.com http://assets.pinterest.com;
      script-src http://assets.pinterest.com https://connect.facebook.net 'self';
      connect-src 'self';
      img-src 'self';
      style-src 'self' 'unsafe-inline';
      object-src 'none';">
      <!-- MUST DO look up what the 'strict-dynamic' does to script-src -->
  </head>
  <body oncopy="return false" oncut="return false" onpaste="return false">
    <script>
  //if CSP is supported this will not run
  window.onload=function(){
      var jsNode = document.getElementById("jsNode");
      jsNode.innerHTML = "<h3> CSP Not Supported</h3> Your browser does not support CSP, the inline script executed and replaced this div content";
      jsNode.className = "alert alert-danger";
  };
</script>
<div id="jsNode"></div>
    <header>
      <section class="top">
        <div class="cont cont-top">
          <span class="social">
            <!-- <a href="https://www.facebook.com/techpocketofficial"><img src="<?=MEDIA_STORAGE_URL?>fb.png" alt="FB" class="facebook"></a>
            <a href="https://twitter.com/techpocket1"><img src="<?=MEDIA_STORAGE_URL?>twitter.png" alt="T" class="twitter"></a>
            <a href="https://plus.google.com/+techpocketvideo"><img src="<?=MEDIA_STORAGE_URL?>g+.png" alt="G" class="google_plus"></a> -->
            <a href="https://www.facebook.com/techpocketofficial" target="_blank"></a>
            <a href="https://twitter.com/techpocket1" target="_blank"></a>
            <a href="https://plus.google.com/+techpocketvideo" target="_blank"></a>
          </span>
          <span class="join">
            <?php if (Session::get("loggedin") == False): ?>
            <a href="<?= BASE_DIR?>login" class="login">Log in</a>
            <a href="<?= BASE_DIR?>signup" class="signup">Sign up</a>
            <?php else: ?>
            <a id="account"><?=Session::user_data("firstname")." ".Session::user_data("lastname")?></a>
            <div id="js-profile-popup">
  						<ul id="profile-popup-options">
  							<li class="view_profile bottom-border"><a href="<?= BASE_DIR?>user/id/<?=Session::user_data("ID")?>">View profile</a>
  							</li><li class="edit-profile bottom-border"><a href="<?= BASE_DIR?>account/edit/1">Edit profile</a>
  							</li><li class="comments-posted bottom-border"><a href="comment_activity.php?id=<?php echo $_SESSION['userInfo']['ID'];?>">Comments</a>
                <?php if (!(Session::user_data("role") == "member" || Session::user_data("role") == "subscriber")): ?>
                </li><li class="new-post bottom-border"><a href="<?= BASE_DIR?>new_post">New Post</a>
                <?php endif; ?>
  							</li><li class="logout"><a href="<?= BASE_DIR?>logout">Log out</a>
  						</ul>
  					</div>
            <a href="<?= BASE_DIR?>logout" class="logout">Log out</a>
            <?php endif; ?>
          </span>
        </div>
      </section>

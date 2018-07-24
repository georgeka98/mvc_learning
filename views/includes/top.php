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
    <?= $this->css != "" ? '<link href='.BASE_DIR.'views/css/'.$this->css.'.css rel="stylesheet" type="text/css"/>' : "" ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
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
  							</li><li class="logout"><a href="<?= BASE_DIR?>logout">Log out</a>
  						</ul>
  					</div>
            <a href="<?= BASE_DIR?>logout" class="logout">Log out</a>
            <?php endif; ?>
          </span>
        </div>
      </section>

<div class="wrapper">
  <div class="user-info-wrap">
    <div class="user-key-info">
      <div class="profile-pic-wrapper">
        <img src="<?= BASE_DIR.MEDIA_STORAGE_URL."profile_pics/".$this->data["profile_icon"];?>" alt="" class="profile-pic"/>
      </div>
      <div class="key-info">
        <?php if ($this->data["date_joined"]): ?>
        <div class="join-date-wrap">
          <div class="icon-wrapper">
            <span class="join-date-indicator"></span>
          </div>
          <div>
            <p class="join-date"><?=$this->data["date_joined"];?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["firstname"] && $this->data["lastname"]): ?>
        <div class="full-name-wrap">
          <div class="icon-wrapper">
            <span class="full-name-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"]?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["about_me"]): ?>
        <div class="about-me-wrap">
          <div class="icon-wrapper">
            <span class="about-me-indicator"></span>
          </div>
          <div>
            <p class="about-me"><?= $this->data["about_me"];?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["birthday"] && $this->data["birthday"] != "0000-00-00"): ?>
        <div class="dob-wrap">
          <div class="icon-wrapper">
            <span class="dob-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="dob"><?= $this->data["birthday"];?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["country"]): ?>
        <div class="location-wrap">
          <div class="icon-wrapper">
            <span class="location-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="location"><?= $this->data["country"];?></p>
            <span class="flag">
              <img class="country-flag" src='<?php echo BASE_DIR.MEDIA_STORAGE_URL."country-flags/country-flag-".$this->data["country-flag"].".png"; ?>'
               alt='<?= $this->data["country"]; ?>'/>
             </span>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["interests"]): ?>
        <div class="occupation-wrap">
          <div class="icon-wrapper">
            <span class="occupation-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="occupation"><?= $this->data["interests"];?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["gender"]): ?>
        <div class="gender-wrap">
          <div class="icon-wrapper">
            <span class="gender-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="gender"><?= $this->data["gender"];?></p>
          </div>
        </div>
        <?php endif;?>
        <?php if ($this->data["role"]): ?>
        <div class="role-wrap">
          <div class="icon-wrapper">
            <span class="role-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="role"><?= $this->data["role"];?></p>
          </div>
        </div>
        <?php endif;?>
        <!-- <div class="email-wrap">
          <div class="icon-wrapper">
            <span class="email-indicator"></span>
          </div>
          <div class="info-wrapper">
            <p class="email"></p>
          </div>
        </div> -->
        <?php if ($this->data["main_website"]): ?>
        <div class="personal-website-wrap">
          <div class="icon-wrapper">
            <span class="personal-website-indicator"></span>
          </div>
          <div class="info-wrapper">
            <a href="http://<?= $this->data["main_website"];?>" class="personal-website"><?= $this->data["main_website"];?></a>
          </div>
        </div>
        <?php endif;?>
        <div class="social-media-wrap">
          <div class="icon-wrapper">
            <span class="social-media-indicator"></span>
          </div>
          <!-- <a href="<?= $this->data["facebook"];?>" class="personal-website"><?= $this->data["facebook"];?></a>
          <a href="<?= $this->data["twitter"];?>" class="personal-website"><?= $this->data["twitter"];?></a>
          <a href="<?= $this->data["google+"];?>" class="personal-website"><?= $this->data["google+"];?></a>
          <a href="<?= $this->data["youtube"];?>" class="personal-website"><?= $this->data["youtube"];?></a> -->
        </div>
      </div>
    </div>
  </div>
  <div class="user-actions-wrap">
    <div class="user-actions">
      <div class="articles">

      </div>
      <div class="all-comments">
        <div class="comments-options">
  				<div class="comment-type">
  					<a id="comments" class="active" data-user-id="<?= $this->data["ID"];?>" data-button-count="1">Comments
  					</a><a id="replies" data-user-id="<?= $this->data["ID"];?>" data-button-count="2">Replies</a>
  				</div>
  				<div class="order-by">
  					<p>Order by:</p>
  					<a id="newest" class="active" data-user-id="<?= $this->data["ID"];?>" data-button-count="3">Newest
  					</a><a id="rating" data-user-id="<?= $this->data["ID"];?>" data-button-count="4">Top rated</a>
  				</div>
  			</div>
        <div class="comments" data-profile-user-id="<?= $this->data["ID"];?>"></div>
      </div>
    </div>
  </div>
</div>

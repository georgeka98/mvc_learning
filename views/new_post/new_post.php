<div class="cover">
  <div class="cover-overlay">
    <div class="cont container">
      <h1 class="article-headline headline-title">WELCOME BACK, <?=strtoupper(Session::user_data("firstname"));?>!</h1>
      <h1 class="article-headline headline-subtitle">Ready for your new post?</h1>
    </div>
  </div>
  <div class="cover-img" style="background-image: url('<?=BASE_DIR.MEDIA_STORAGE_URL.BLOG_STORAGE;?>new_post/welcome-bg.jpg')">
  </div>
</div>
<div class="container cont">
  <form action="#" method="POST">
    <div class="post-cont-wrapper">
      <div class="headlines">
        <div class="title-wrapper">
          <label class="title-label" for="post-title">Title</label>
          <input class="post-title" type="text" placeholder="Title" name="title"/>
          <p>What is this?</p>
        </div>
        <div class="teaser-wrapper">
          <label class="teaser-label" for="title">Teaser paragraph</label>
          <input class="post-teaser" type="text" placeholder="Title" name="teaser"/>
          <p>What is this?</p>
        </div>
      </div>
      <div class="post-body">
        <div class="post-wrapper">
          <label class="content-label" for="post-title">Content</label>
          <textarea class="post-content" type="text" placeholder="content" name="content"></textarea>
          <p>What is this?</p>
        </div>
      </div>
    </div>
    <div class="settings-wrapper">

    </div>
    <input type="submit" value="Submit" />
  </form>
</div>

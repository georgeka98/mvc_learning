<div class="cover">
  <div class="cover-overlay">
    <div class="cont container">
      <h1 class="article-headline" id="<?=$this->data["ID"];?>"><?=$this->data["title"];?></h1>
    </div>
  </div>
  <div class="cover-img" style="background-image: url('<?=BASE_DIR.MEDIA_STORAGE_URL.BLOG_STORAGE;?>article-<?=$this->data["ID"];?>/<?=$this->data["cover-photo"];?>')">
  </div>
</div>

<div class="messege-box-overlay msg_box_cont">
  <div class="messege-box-wrap fade__out">
    <div class="messege-box">
      <p>Do you really want to remove this comment? It will be gone forever!</p>
      <div class="msg-box-btns-center">
        <div class="msg-box-btns">
          <button class="action__button close-msg-box">cancel</button>
          <button class="action__submit remove-comment-final-warning" data-remove-id="">Please, remove it!</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="messege-box-overlay report_submitted msg_box_cont">
  <div class="messege-box-wrap fade__out">
    <div class="messege-box">
      <p>Report submitted. We are sorry you had this experience.</p>
      <div class="msg-box-btns-center">
        <div class="msg-box-btns">
          <button class="action__submit close-msg-box">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="report-comment-window  msg_box_cont">
  <div class="report-wrapper fade__out">
    <div class="report-box">
      <div class="report-descripction report-title">
        <p>See something suspicious or innaproprate in this comment? Let us know!</p>
      </div>
      <form class="all-report-options">
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-1" name="option" value="It's annoying or distasteful">
          <label for="opt-1">It's annoying or distasteful</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-2" name="option" value="It's pornography">
          <label for="opt-2">It's pornography</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-3" name="option" value="It goes against my views">
          <label for="opt-3">It goes against my views</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-4" name="option" value="It advocates violence or harm to a person or animal">
          <label for="opt-4">It advocates violence or harm to a person or animal</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-5" name="option" value="It's a fake comment">
          <label for="opt-5">It's a fake comment</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-6" name="option" value="I think it's an unauthorized use of my intellectual property">
          <label for="opt-6">I think it's an unauthorized use of my intellectual property</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-7" name="option" value="It shows someone harming themself or planning to harm themself">
          <label for="opt-7">It shows someone harming themself or planning to harm themself</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-8" name="option" value="It's spam">
          <label for="opt-8">It's spam</label>
        </div>
        <div class="report-opt">
          <input type="radio" class="report-ans" id="opt-9" name="option" value="Something else">
          <label for="opt-9">Something else</label><br>
          <textarea id="report-something-else-textbox"></textarea>
        </div>
        <button type="button" class="action__button close-msg-box">cancel</button>
        <button type="button" class="action__submit submit_comment_report" data-remove-id="">Yes, report it!</button>
        <div class="cation-message">
          <p>CATION: </p>
          <p>We take reports very seriously to maintain the peace in this website. Click on the submit button only if you REALLY believe that this comment doesn't follow the rules according to our <a href="privacy#">privacy</a>. If we realise that there isn't something that doesn't obey our rules, depending on the situation, you may lose the ability to report content.</p>
          <input type="checkbox" class="report_agreement"><p>I acknowledge this and I obey the rules</p>
        </div>
      </form>
    </div>
    <div class="report-box-message">
      <div class="report-title">
        <p>Note</p>
      </div>
      <div class="report-message-wrapper">
        <p id="report-message"></p>
      </div>
    </div>
  </div>
</div>

<div class="container" style="display: table;">
  <div class="left-cont">
    <div class="author-wrapper">
      <div class="author">
        <div class="main-info">
          <div class="author-prof-wrapper">
            <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>">
          </div>
          <div class="personal-info">
            <a href="<?=BASE_DIR;?>user/id/<?=$this->data["authorID"];?>" class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></a>
            <p class="description"><?=$this->data["about_me"];?></p>
          </div>
        </div>
        <div class="connect-with-author">
          <p class="connect-label">Connect with <?=$this->data["firstname"]?>:</p>
        </div>
        <div class="authors-website">
          <p class="website-label">Visit <?=$this->data["firstname"]?>'s website:</p>
          <a class="website-link" href="https://<?=$this->data["main_website"]?>"><?=$this->data["main_website"]?></a>
        </div>
      </div>
    </div>
    <div class="ver-sharing-wrap">
      <div class="ver-sharing">
        <ul class="share-to-soc-media">
          <li>
            <div class="shares-wrapper">
              <p class="tot-shares">7</p>
            </div>
          </li>
          <li>
            <div id="fb-share-button" data-href="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
              <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/facebook.png" alt="FB"/>
              </a>
            </div>
          </li>
          <li>
            <a class="twitter-share-button" title="Twitter" target="_blank" rel="canonical" href="https://twitter.com/intent/tweet?text=Check%20this%20article%20out%20by%20@TechPocket1&url=http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-size="large">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/twitter.png" alt="T"/>
            </a>
          </li>
          <li>
            <a class="google-share" target="_blank" title="Google+" href="https://plus.google.com/share?url=https://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/google+.png" alt="G+"/>
            </a>
          </li>
          <li>
            <a class="pinterest-share pinterest" data-pin-do="save" and data-pin-custom="true">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/pinterest.png" alt="Pin"/>
            </a>
          </li>
          <!-- <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
          <script type="IN/Share" data-url="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control"></script>  -->
          <li>
            <a class="linkedin-share" target="_blank" title="Linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&title=<?=$this->data["title"];?>&summary=Check%20out%20this%20article%20by%20<?=WEBSITE_NAME?>&source=<?=WEBSITE_NAME?>">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/linkedin.png" alt="LN"/>
            </a>
          </li>
          <li>
            <a class="tumblr-share" target="_blank" title="Tumblr" href="https://www.tumblr.com/widgets/share/tool/preview?posttype=photo&content=<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>&caption=<?=$this->data["title"];?>&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&clickthroughUrl=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&caption=<?=$this->data["title"];?>">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/tumblr.png" alt="Tu"/>
            </a>
          </li>
          <li>
            <!--MySpace Share button Start-->
             <!--Created By Merelesson.com-->
             <a href='https://myspace.com' target="_blank" onclick='window.open(&apos;https://myspace.com/post?u=&apos;+encodeURIComponent(location.href)+&apos;&amp;bodytext=&amp;tags=&amp;title=&apos;+encodeURIComponent(document.title));return false;' rel='nofollow' style='text-decoration:none;' title='Share on Myspace'>
               <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/myspace.png"/>
             </a>
            <!--MySpace Share Button End-->
          </li>
          <li>
            <a class="whatsapp-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
              <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/whatsapp.png" alt="WhatsApp"/>
            </a>
          </li>
          <li>
            <a class="messenger-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
              <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/messenger.png" alt="Messenger"/>
            </a>
          </li>
          <!-- <li>
            <a class="flickr-share" target="_blank" title="Flickr">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/flickr.png" alt="Fl"/>
            </a>
          </li> -->
          <!-- <li><a class="reddit-share"><img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/reddit.png" alt="Re"/></a></li> -->
          <li>
            <a class="email-share" target="_blank" title="email" href="mailto:?subject=<?=$this->data["title"];?>&body=Hey,%20check%20out%20this%20article%20I%20found%20on%20the%20<?=WEBSITE_NAME?>%20website:%20http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
              <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/mail icon.png" alt="Email"/>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="article-cont">
    <div class="teaser-paragraph-wrapper">
      <p class="teaser-paragraph"><?=$this->data["teaser_paragraph"];?></p>
    </div>
    <div class="sharing">
      <ul class="share-to-soc-media">
        <li>
          <div class="shares-wrapper">
            <p class="tot-shares">7</p>
          </div>
        </li>
        <li>
          <div id="fb-share-button" data-href="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
            <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/facebook.png" alt="FB"/>
            </a>
          </div>
        </li>
        <li>
          <a class="twitter-share-button" title="Twitter" target="_blank" rel="canonical" href="https://twitter.com/intent/tweet?text=Check%20this%20article%20out%20by%20@TechPocket1&url=http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-size="large">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/twitter.png" alt="T"/>
          </a>
        </li>
        <li>
          <a class="google-share" target="_blank" title="Google+" href="https://plus.google.com/share?url=https://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/google+.png" alt="G+"/>
          </a>
        </li>
        <li>
          <a class="pinterest-share pinterest" data-pin-do="save" and data-pin-custom="true">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/pinterest.png" alt="Pin"/>
          </a>
        </li>
        <!-- <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
        <script type="IN/Share" data-url="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control"></script>  -->
        <li>
          <a class="linkedin-share" target="_blank" title="Linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&title=<?=$this->data["title"];?>&summary=Check out this article by <?=WEBSITE_NAME?>&source=<?=WEBSITE_NAME?>.com">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/linkedin.png" alt="LN"/>
          </a>
        </li>
        <li>
          <a class="tumblr-share" target="_blank" title="Tumblr" href="https://www.tumblr.com/widgets/share/tool/preview?posttype=photo&content=<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>&caption=<?=$this->data["title"];?>&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&clickthroughUrl=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&caption=<?=$this->data["title"];?>">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/tumblr.png" alt="Tu"/>
          </a>
        </li>
        <li>
          <!--MySpace Share button Start-->
           <!--Created By Merelesson.com-->
           <a href='https://myspace.com' target="_blank" onclick='window.open(&apos;https://myspace.com/post?u=&apos;+encodeURIComponent(location.href)+&apos;&amp;bodytext=&amp;tags=&amp;title=&apos;+encodeURIComponent(document.title));return false;' rel='nofollow' style='text-decoration:none;' title='Share on Myspace'>
             <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/myspace.png"/>
           </a>
          <!--MySpace Share Button End-->
        </li>
        <li>
          <a class="whatsapp-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/whatsapp.png" alt="WhatsApp"/>
          </a>
        </li>
        <li>
          <a class="messenger-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/messenger.png" alt="Messenger"/>
          </a>
        </li>
        <!-- <li>
          <a class="flickr-share" target="_blank" title="Flickr">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/flickr.png" alt="Fl"/>
          </a>
        </li> -->
        <!-- <li><a class="reddit-share"><img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/reddit.png" alt="Re"/></a></li> -->
        <li>
          <a class="email-share" target="_blank" title="email" href="mailto:?subject=<?=$this->data["title"];?>&body=Hey,%20check%20out%20this%20article%20I%20found%20on%20the%20<?=WEBSITE_NAME?>%20website:%20http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/mail icon.png" alt="Email"/>
          </a>
        </li>
      </ul>
    </div>
    <div class="article-meta">
      <span class="date-posted-wrapper">
        <span class="date-posted-icon"></span>
        <p class="date-posted"><?=$this->data["date-posted"];?></p>
      </span>
      <span class="read-time-wrapper">
        <span class="book-icon"></span>
        <p class="read-time"><?=$this->data["read_time"];?></p>
      </span>
    </div>
    <div class="article-wrapper">
      <pre class="article" data-article-id="<?=$this->data["ID"]?>" style="white-space: pre-wrap; font-family: Arial">
        <?=$this->data["post"];?>
      </pre>
    </div>
    <div class="sharing">
      <ul class="share-to-soc-media">
        <li>
          <div class="shares-wrapper">
            <p class="tot-shares">7</p>
          </div>
        </li>
        <li>
          <div id="fb-share-button" data-href="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
            <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
              <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/facebook.png" alt="FB"/>
            </a>
          </div>
        </li>
        <li>
          <a class="twitter-share-button" title="Twitter" target="_blank" rel="canonical" href="https://twitter.com/intent/tweet?text=Check%20this%20article%20out%20by%20@TechPocket1&url=http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-size="large">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/twitter.png" alt="T"/>
          </a>
        </li>
        <li>
          <a class="google-share" target="_blank" title="Google+" href="https://plus.google.com/share?url=https://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/google+.png" alt="G+"/>
          </a>
        </li>
        <li>
          <a class="pinterest-share pinterest" data-pin-do="save" and data-pin-custom="true">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/pinterest.png" alt="Pin"/>
          </a>
        </li>
        <!-- <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
        <script type="IN/Share" data-url="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control"></script>  -->
        <li>
          <a class="linkedin-share" target="_blank" title="Linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&title=<?=$this->data["title"];?>&summary=Check out this article by <?=WEBSITE_NAME?>&source=<?=WEBSITE_NAME?>.com">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/linkedin.png" alt="LN"/>
          </a>
        </li>
        <li>
          <a class="tumblr-share" target="_blank" title="Tumblr" href="https://www.tumblr.com/widgets/share/tool/preview?posttype=photo&content=<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>&caption=<?=$this->data["title"];?>&url=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&clickthroughUrl=<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>&caption=<?=$this->data["title"];?>">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/tumblr.png" alt="Tu"/>
          </a>
        </li>
        <li>
          <!--MySpace Share button Start-->
           <!--Created By Merelesson.com-->
           <a href='https://myspace.com' target="_blank" onclick='window.open(&apos;https://myspace.com/post?u=&apos;+encodeURIComponent(location.href)+&apos;&amp;bodytext=&amp;tags=&amp;title=&apos;+encodeURIComponent(document.title));return false;' rel='nofollow' style='text-decoration:none;' title='Share on Myspace'>
             <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/myspace.png"/>
           </a>
          <!--MySpace Share Button End-->
        </li>
        <li>
          <a class="whatsapp-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/whatsapp.png" alt="WhatsApp"/>
          </a>
        </li>
        <li>
          <a class="messenger-share" target="_blank" title="WhatsApp" href="whatsapp://send?text='<?=$this->data["title"];?>%20<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>'">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/messenger.png" alt="Messenger"/>
          </a>
        </li>
        <!-- <li>
          <a class="flickr-share" target="_blank" title="Flickr">
            <img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/flickr.png" alt="Fl"/>
          </a>
        </li> -->
        <!-- <li><a class="reddit-share"><img src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/reddit.png" alt="Re"/></a></li> -->
        <li>
          <a class="email-share" target="_blank" title="email" href="mailto:?subject=<?=$this->data["title"];?>&body=Hey,%20check%20out%20this%20article%20I%20found%20on%20the%20<?=WEBSITE_NAME?>%20website:%20http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
            <img data-pin-nopin src="<?=BASE_DIR.MEDIA_STORAGE_URL;?>soc_med_icons/mail icon.png" alt="Email"/>
          </a>
        </li>
      </ul>
    </div>
    <div class="feedback">
      <span class="feedback-teaser">
        <h1>Leave a feedback:</h1>
        <p>Let the future readers and <?=$this->data["firstname"]?> (the author) know how this article made you feel.</p>
        <?php if (Session::get("loggedin") != True): ?>
          <p>You need to <a href="<?=BASE_DIR?>login">login</a> or <a href="<?=BASE_DIR?>signup">signup</a> to leave a feedback</p>
        <?php endif; ?>
      </span>
      <?php if (Session::get("loggedin") == True): ?>
        <div class="feedback-options">
          <a class="f-love" data-feedback="love"></a>
          <a class="f-wow" data-feedback="wow"></a>
          <a class="f-happy" data-feedback="happy"></a>
          <a class="f-funny" data-feedback="funny"></a>
          <a class="f-neutral" data-feedback="neutral"></a>
          <a class="f-sad" data-feedback="sad"></a>
          <a class="f-angry" data-feedback="angry"></a>
        </div>
        <div class="feedback_cont">
          <canvas id="feedback_results" style="background: white;">
          </canvas>
          <legend class="graph_memorandum" for="feedback_results"></legend>
          <div class="feedback-tip-wrap">
            <div class="feedback-tip">
              <div class="arrow bottom right"></div>
              <span class="feedback-tip-label"></span>
            </div>
          </div>
        </div>
      <?php endif;?>
    </div>
  </div>

  <div class="right-cont">
    <div class="hot-articles">
      <h2>Hot Now</h2>
      <div class="ver-article-list">
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
        <div class="article-link-wrap">
          <a class="article-link" href="<?=BASE_DIR?>blog/article/greeks-urged-to-leave-homes-as-wildfires-near-athens-rage-out-of-control">
            <div class="hot-article-cover-wrap">
              <img class="hot-article-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
            </div>
            <div class="hot-title-wrap">
              <p class="hot-title"><?=$this->data['title'];?></p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="section about-author">
  <div class="section-label">
    <span class="text-label">About the Author</span>
  </div>
  <div class="prof-wrapper">
    <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>">
  </div>
  <div class="main-info">
    <a href="<?=BASE_DIR;?>user/id/<?=$this->data["authorID"];?>" class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></a>
    <p class="description"><?=$this->data["about_me"];?></p>
  </div>
  <div class="connect-with-author">
    <p class="connect-label">Connect with <?=$this->data["firstname"]?>:</p>
  </div>
  <div class="authors-website">
    <p class="website-label">Visit <?=$this->data["firstname"]?>'s website:</p>
    <a class="website-link" href="https://<?=$this->data["main_website"]?>"><?=$this->data["main_website"]?></a>
  </div>
</div>

<div class="section recommended-articles">
  <div class="section-label">
    <span class="text-label">Recommended</span>
  </div>
  <div class="articles-promote news-articles-wrapper">
    <div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div>
  </div>
</div>

<div class="section newest-articles">
  <div class="section-label">
    <span class="text-label">Newest</span>
  </div>
  <div class="articles-promote news-articles-wrapper">
    <div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div>
  </div>
</div>


<div class="section comments">
  <div class="section-label">
    <span class="text-label">Comments</span>
  </div>
  <div class="comments-wrapper">
    <div class="post-comment">
      <?php if (Session::get("loggedin") == True): ?>
        <form class="comment-box">
          <div class="user-info">
            <img class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=Session::user_data("profile_icon");?>">
            <p class="firstname"><?=Session::user_data("firstname");?></p>
          </div>
          <div class="comment-input-wrapper">
            <textarea class="comment-input" placeholder="We can’t wait to read your response."></textarea>
            <button type="button" class="action__submit submit-comment">Post comment</button>
          </div>
        </form>
      <?php else: ?>
        <p>You need to <a href="<?= BASE_DIR?>login">login</a> or <a href="<?= BASE_DIR?>signup">signup</a> to join the discussion</p>
      <?php endif; ?>
    </div>
    <div class="comments-settings">
      <div class="order">
        <p class="order-par">Order:</p>
        <ul class="comments__options__dropdown order-dropdown">
          <li class="selected__item">
            <button class="button__toggle" data-order="recommended"><span class="option-title">recommended</span></button>
            <ul class="comments__options__dropdown__toggle">
              <li class="popup__item">
                <button class="popup__action" data-order="newest"><span class="option-title">newest</span></button>
              </li>
              <li class="popup__item">
                <button class="popup__action" data-order="oldest"><span class="option-title">oldest</span></button>
              </li>
              <li class="popup__item">
                <button class="popup__action" data-order="recommended"><span class="option-title">recommended</span></button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="display">
        <p class="display-par">Display:</p>
        <ul class="comments__options__dropdown display-dropdown">
          <li class="selected__item">
            <button class="button__toggle" data-display="20"><span class="option-title">20</span></button>
            <ul class="comments__options__dropdown__toggle">
              <li class="popup__item">
                <button class="popup__action" data-display="5"><span class="option-title">5</span></button>
              </li>
              <li class="popup__item">
                <button class="popup__action" data-display="10"><span class="option-title">10</span></button>
              </li>
              <li class="popup__item">
                <button class="popup__action" data-display="20"><span class="option-title">20</span></button>
              </li>
              <li class="popup__item">
                <button class="popup__action" data-display="40"><span class="option-title">40</span></button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="pages">
        <ul class="comments_pages_list">
        </ul>
      </div>
    </div>
    <div class="comments-list">

    </div>
    <div class="comments-settings">
      <div class="pages">
        <ul class="comments_pages_list">
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="section hot-now-articles">
  <div class="section-label">
    <span class="text-label">Hot Now</span>
  </div>
  <div class="articles-promote news-articles-wrapper">
    <div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div><div class="column-item-cont">
      <div class="column-item row-item">
        <div class="item-img-cover">
          <img class="article-item-cover" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>blog/article-<?=$this->data['ID'];?>/<?=$this->data["cover-photo"];?>"/>
        </div>
        <div class="item-body">
          <div class="article-item-title">
            <p>
              <?=$this->data["title"];?>
            </p>
          </div>
          <span class="body-separator"></span>
          <div class="article-item-author">
            <div class="item-author-profile-pic">
              <img data-pin-nopin class="author-prof" src="<?=BASE_DIR.MEDIA_STORAGE_URL?>profile_pics/<?=$this->data["profile_icon"];?>"/>
            </div>
            <div class="item-author-info">
              <p class="full-name"><?=$this->data["firstname"]." ".$this->data["lastname"];?></p>
              <p class="date-posted"><?=$this->data["date-posted"];?></p>
            </div>
          </div>
        </div>
      </div>
      <a class="article-item-link" href="<?=BASE_DIR?>blog/article/<?=$this->data["title"]?>"></a>
    </div>
  </div>
</div>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<script async defer data-pin-hover="true" data-pin-tall="true" data-pin-lang="en" data-pin-save="true"  src="//assets.pinterest.com/js/pinit.js"></script>

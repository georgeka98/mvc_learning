<div class="channel-info">
  <div class="header-wrapper"><h1 class="title-label"><?php if(isset($this->data["channel_name"])){echo $this->data["channel_name"];}else{echo "TechPocket.";} ?> YouTube channel</h1></div>
  <div class="youtube-logo"></div>
  <div class="label-subtitle">
    <div class="videos-wrapper">
      <span class="videos-icon"></span>
      <p><?php if(isset($this->data["videos"])){ echo $this->data["videos"];} else{echo "400+";} ?> ᛫</p>
    </div>
    <div class="views-wrapper">
      <span class="view-icon"></span>
      <p><?php if(isset($this->data["view_count"])){ echo $this->data["view_count"];} else{echo "9000000+";} ?> ᛫</p>
    </div>
    <div class="subscribers-wrapper">
      <span class="subscribers-icon"></span>
      <p><?php if(isset($this->data["subscribers"])){ echo $this->data["subscribers"];} else{echo "24000+";} ?> ᛫</p>
    </div>
    <div class="region-wrapper">
      <span class="globe-icon"></span>
      <span class="country-flag-wrapper">
        <img class="country-flag" src='<?php if(isset($this->data["region"])){ echo BASE_DIR.MEDIA_STORAGE_URL."country-flags/country-flag-".$this->data["region"].".png";} else{echo "Greece";} ?>'
           alt='<?php if(isset($this->data["region"])){ echo $this->data["region"];} else {echo "UK";} ?>'/>
      </span>
    </div>
  </div>
  <div class="note-wrapper"><p class="note">Video fetching from the channel can be slow. If this is the case, check <a href="https://www.youtube.com/channel/UCjtakVAGquXU74GthNKdCYQ" target="_blank">TechPocket</a> here.</p></div>
</div>
<div class="videos-cont" id="videos-list">
  <?php if(isset($this->data["video_list"])){ echo $this->data["video_list"];} ?>
</div>
<div id="loader"></div>
<button id="load_more_videos" data-total-videos="12">Load More +</button>

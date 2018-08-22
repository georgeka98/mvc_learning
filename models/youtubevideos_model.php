<?php

class Youtubevideos_model extends Model
{

  public function __construct(){
    parent::__construct();
    $this->output = "";
    $this->API_key = "AIzaSyByiqfEBuAB4E8cNAY9Eq3mOMoFR2Cu2cs";
    $this->channel_id = "UCjtakVAGquXU74GthNKdCYQ";
    $this->max_results = 12;
    $this->videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channel_id.'&maxResults='.$this->max_results.'&key='.$this->API_key.''));
    $this->channel = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet&id='.$this->channel_id.'&key='.$this->API_key));
    $this->subscriptions = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$this->channel_id.'&fields=items&key='.$this->API_key));
    $this->brandingSettings = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id='.$this->channel_id.'&fields=items&key='.$this->API_key));
    return $this->data();
  }

  private function youtube_analytics($params){
    $videoID = $params['id']; // view id here
    $API_key = $params['api_key'];
    $json = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" . $videoID . "&key=".$API_key);
    $jsonData = json_decode($json);
    $views = $jsonData->items[0]->statistics->viewCount;
    $likes = $jsonData->items[0]->statistics->likeCount;
    $dislikes = $jsonData->items[0]->statistics->dislikeCount;
    $comments = $jsonData->items[0]->statistics->commentCount;
    return array("views" => number_format($views), "likes" => number_format($likes), "dislikes" => number_format($dislikes), "comments" => number_format($comments));
  }

  private function date_friendly_format($day, $month, $year){
    $months = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "May", "06" => "Jun", "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
    if (strlen($month) == 1){
      $month = "0".$month;
    }
    if($day[0] == "0" && isset($day[1])){
      $day = $day[1];
    }
    if($day[strlen($day)-1] == "1"){
      $day = $day.'<span class="day-prefix">st</span>';
    }
    else if($day[strlen($day)-1] == "1"){
      $day = $day.'<span class="day-prefix">nd</span>';
    }
    else if($day[strlen($day)-1] == "1"){
      $day = $day.'<span class="day-prefix">rd</span>';
    }
    else{
      $day = $day.'<span class="day-prefix">th</span>';
    }
    return $months[$month]." ".$day." ".$year;
  }

  //check for links
  private function description_modifier($description){
    $link_part = "http://"; //beginning of the link
    $link = "";
    $l_index = 0; //keyword index
    $desc_modified = "";

    for($c = 0; $c < strlen($description); $c++){
      if ($l_index == strlen($link_part) - 1 || $description[$c] == $link_part[$l_index]){
        if ($l_index < strlen($link_part) - 1){
          $link = $link.$link_part[$l_index];
          $l_index++;
        }
        else if($description[$c] == " "){
          $l_index = 0;
          $link = "<a href='".$link."' target='_blank'>".$link."</a>";
          $desc_modified = $desc_modified.$link." ";
        }
        else{
          $link = $link.$description[$c];
        }
      }
      else if($description[$c] != $link_part[$l_index]){
        if($l_index != 0){
          $l_index = 0;
          $desc_modified = $desc_modified.$link;
          $link = "";
        }
        $desc_modified = $desc_modified.$description[$c];
      }
    }
    return $desc_modified;
  }

  private function video_info($item){
    if(isset($item->id->videoId)){
        $description = $item->snippet->description;

        //video info
        $video_info = $this->youtube_analytics(array("id" => $item->id->videoId, "api_key" => $this->API_key));

        $published_date = $item->snippet->publishedAt;
        $day = substr($published_date,8,10);
        $month = substr($published_date,5,2);
        $year = substr($published_date,0,4);

        $this->output = $this->output.'<div class="youtube-video">
                <h2 class="video-title">'. $item->snippet->title .'</h2>
                <iframe class="video-frame" width="256" height="144" src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>
                <div class="basic-info"><span class="date-uploaded"><p class="data date-uploaded-value">'.$this->date_friendly_format($day, $month, $year).'</p></span>
                <span class="views"><p class="data views-value">'.str_replace(",", "",$video_info["views"]).'</p></span></div>
                <div class="ratings"><span class="comments"><p class="data comments-value">'.$video_info["comments"].'</p></span>
                <span class="dislikes"><p class="data dislikes-value">'.$video_info["dislikes"].'</p></span>
                <span class="likes"><p class="data likes-value">'.$video_info["likes"].'</p></span></div>
                <p class="video-description">'.$this->description_modifier($description).' </p>
                <p class="more"><a href="https://www.youtube.com/watch?v='.$item->id->videoId.'" target="_blank">more</a></p>
            </div>';
    }
  }

  public function data(){
    return array("channel_name" => $this->channel->items[0]->snippet->title, "videos" => $this->subscriptions->items[0]->statistics->videoCount, "view_count" => $this->subscriptions->items[0]->statistics->viewCount, "subscribers" => $this->subscriptions->items[0]->statistics->subscriberCount, "region" => $this->brandingSettings->items[0]->brandingSettings->channel->country);
  }

  public function videos(){

    // require_once 'vendor/autoload.php';
    //
    //$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channel_id.'&maxResults='.$this->max_results.'&key='.$this->API_key.''));
    //
    // /**
    //  * Library Requirements
    //  *
    //  * 1. Install composer (https://getcomposer.org)
    //  * 2. On the command line, change to this directory (api-samples/php)
    //  * 3. Require the google/apiclient library
    //  *    $ composer require google/apiclient:~2.0
    //  */
    //
    // if (!file_exists($file = __DIR__ . '/vendor/autoload.php')) {
    //   throw new \Exception('please run "composer require google/apiclient:~2.0" in "' . __DIR__ .'"');
    // }
    // require_once __DIR__ . '/vendor/autoload.php';
    // session_start();
    //
    // /*
    //  * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
    //  * Google Developers Console: https://console.developers.google.com/
    //  * Please ensure that you have enabled the YouTube Data API for your project.
    //  */
    // define('CREDENTIALS_PATH', '~/php-yt-oauth2.json');
    //
    // function getClient() {
    //   $client = new Google_Client();
    //   $client->setApplicationName('API Samples');
    //   $client->setScopes('https://www.googleapis.com/auth/youtube.force-ssl');
    //   // Set to name/location of your client_secrets.json file.
    //   $client->setAuthConfig('/opt/lampp/htdocs/mvclearn/views/youtubevideos/vendor/google/apiclient/src/Google/client_secrets.json');
    //   $client->setAccessType('offline');
    //
    //   // Load previously authorized credentials from a file.
    //   $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
    //   if (file_exists($credentialsPath)) {
    //     $accessToken = json_decode(file_get_contents($credentialsPath), true);
    //   } else {
    //     // Request authorization from the user.
    //     $authUrl = $client->createAuthUrl();
    //     printf("Open the following link in your browser:\n%s\n", $authUrl);
    //     print 'Enter verification code: ';
    //     $authCode = trim(fgets(STDIN));
    //
    //     // Exchange authorization code for an access token.
    //     $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    //
    //     // Store the credentials to disk.
    //     if(!file_exists(dirname($credentialsPath))) {
    //       mkdir(dirname($credentialsPath), 0700, true);
    //     }
    //     file_put_contents($credentialsPath, json_encode($accessToken));
    //     printf("Credentials saved to %s\n", $credentialsPath);
    //   }
    //   $client->setAccessToken($accessToken);
    //
    //   // Refresh the token if it's expired.
    //   if ($client->isAccessTokenExpired()) {
    //     $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    //     file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
    //   }
    //   return $client;
    // }
    //
    // /**
    //  * Expands the home directory alias '~' to the full path.
    //  * @param string $path the path to expand.
    //  * @return string the expanded path.
    //  */
    // function expandHomeDirectory($path) {
    //   $homeDirectory = getenv('HOME');
    //   if (empty($homeDirectory)) {
    //     $homeDirectory = getenv("HOMEDRIVE") . getenv("HOMEPATH");
    //   }
    //   return str_replace('~', realpath($homeDirectory), $path);
    // }
    //
    // // Define an object that will be used to make all API requests.
    // $client = getClient();
    // $service = new Google_Service_YouTube($client);
    //
    // if (isset($_GET['code'])) {
    //   if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    //     die('The session state did not match.');
    //   }
    //
    //   $client->authenticate($_GET['code']);
    //   $_SESSION['token'] = $client->getAccessToken();
    //   header('Location: ' . $redirect);
    // }
    //
    // if (isset($_SESSION['token'])) {
    //   $client->setAccessToken($_SESSION['token']);
    // }
    //
    // if (!$client->getAccessToken()) {
    //   print("no access token, whaawhaaa");
    //   exit;
    // }
    //
    // // Add a property to the resource.
    // function addPropertyToResource(&$ref, $property, $value) {
    //     $keys = explode(".", $property);
    //     $is_array = false;
    //     foreach ($keys as $key) {
    //         // For properties that have array values, convert a name like
    //         // "snippet.tags[]" to snippet.tags, and set a flag to handle
    //         // the value as an array.
    //         if (substr($key, -2) == "[]") {
    //             $key = substr($key, 0, -2);
    //             $is_array = true;
    //         }
    //         $ref = &$ref[$key];
    //     }
    //
    //     // Set the property value. Make sure array values are handled properly.
    //     if ($is_array && $value) {
    //         $ref = $value;
    //         $ref = explode(",", $value);
    //     } elseif ($is_array) {
    //         $ref = array();
    //     } else {
    //         $ref = $value;
    //     }
    // }
    //
    // // Build a resource based on a list of properties given as key-value pairs.
    // function createResource($properties) {
    //     $resource = array();
    //     foreach ($properties as $prop => $value) {
    //         if ($value) {
    //             addPropertyToResource($resource, $prop, $value);
    //         }
    //     }
    //     return $resource;
    // }
    //
    // function uploadMedia($client, $request, $filePath, $mimeType) {
    //     // Specify the size of each chunk of data, in bytes. Set a higher value for
    //     // reliable connection as fewer chunks lead to faster uploads. Set a lower
    //     // value for better recovery on less reliable connections.
    //     $chunkSizeBytes = 1 * 1024 * 1024;
    //
    //     // Create a MediaFileUpload object for resumable uploads.
    //     // Parameters to MediaFileUpload are:
    //     // client, request, mimeType, data, resumable, chunksize.
    //     $media = new Google_Http_MediaFileUpload(
    //         $client,
    //         $request,
    //         $mimeType,
    //         null,
    //         true,
    //         $chunkSizeBytes
    //     );
    //     $media->setFileSize(filesize($filePath));
    //
    //
    //     // Read the media file and upload it chunk by chunk.
    //     $status = false;
    //     $handle = fopen($filePath, "rb");
    //     while (!$status && !feof($handle)) {
    //       $chunk = fread($handle, $chunkSizeBytes);
    //       $status = $media->nextChunk($chunk);
    //     }
    //
    //     fclose($handle);
    //     return $status;
    // }
    //
    // /***** END BOILERPLATE CODE *****/
    //
    // // Sample php code for videos.getRating
    //
    // function videosGetRating($service, $id, $params) {
    //     $params = array_filter($params);
    //     $response = $service->videos->getRating(
    //         $id,
    //         $params
    //     );
    //
    //     print_r($response);
    // }
    //
    // videosGetRating($service,
    //   'Ks-_Mh1QhMc,c0KYU2j0TM4,eIho2S0ZahI',
    //   array('onBehalfOfContentOwner' => ''));
    //
    // $client = new Google_Client();
    // $client->setDeveloperKey($API_key);
    //
    // // Define an object that will be used to make all API requests.
    // $youtube = new Google_YoutubeService($client);

    foreach($this->videoList->items as $item){
      //Embed video
      $this->video_info($item);
    }

    return $this->output;
  }

  public function load_more($videos_loaded){

    $videos_loaded = $videos_loaded + $this->max_results;
    $this->videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$this->channel_id.'&maxResults='.$videos_loaded.'&key='.$this->API_key.''));
    $index = 0; //count how many videos have been fetched

    foreach($this->videoList->items as $item){
      //Embed video
      if($videos_loaded - $this->max_results <= $index){
        $this->video_info($item);
      }
      $index++;
    }
    return $this->output;
  }
}


?>

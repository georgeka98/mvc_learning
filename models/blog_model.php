<?php

class Blog_model extends Model
{

  public function __construct(){
    parent::__construct();
  }

  //GETTING ARTICLE

  public function get_article($title){
    $post = $this->db->prepare("SELECT * FROM blog WHERE lower(title) = :title");
    $post->execute(array(':title' => strtolower($title)));
    $info = $post->fetch(PDO::FETCH_ASSOC);

    $user = $this->get_author_data($info["authorID"]);
    $readtime = $this->read_time($info["post"]);

    return $info + $user + $readtime;
  }

  //getting the author's personal information (some of them)
  private function get_author_data($id){
    if ($id >= 0){
      $user = $this->db->prepare("SELECT firstname, lastname, username, main_website, about_me, profile_icon FROM users WHERE ID = :id");
      $user->execute(array(':id' => $id));
      $info = $user->fetch(PDO::FETCH_ASSOC);

      return $info;
    }
    return array();
  }

  //GETTING POLL
  public function get_poll($blog_ID){

  }

  //GETTING FEEDBACKS

  //feedback types
  private function feedback_emotions(){
    return array("love", "wow", "happy", "funny", "neutral", "sad", "angry");
  }

  //creates the feedback tables
  private function feedback_database(){
    $emotions = $this->feedback_emotions();
    $feedback_table = $this->db->prepare("CREATE TABLE IF NOT EXISTS blog_feedback (
                                            ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                            blog_ID int(11) NOT NULL,
                                            love int(11) DEFAULT 0,
                                            wow int(11) DEFAULT 0,
                                            happy int(11) DEFAULT 0,
                                            funny int(11) DEFAULT 0,
                                            neutral int(11) DEFAULT 0,
                                            sad int(11) DEFAULT 0,
                                            angry int(11) DEFAULT 0,
                                            FOREIGN KEY (blog_ID) REFERENCES blog(ID)
                                          )");
    $feedback_table->execute();

    for ($e = 0; $e < count($emotions); $e++){
      $emotions = $this->feedback_emotions();
      $emotion_table = $this->db->prepare("CREATE TABLE IF NOT EXISTS blog_".$emotions[$e]." (
                                              ID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                              blog_ID int(11) NOT NULL,
                                              ".$emotions[$e]."By int(11) DEFAULT 0,
                                              FOREIGN KEY (".$emotions[$e]."By) REFERENCES users(ID)
                                            )");
      $emotion_table->execute();
    }
  }

  //returns whether the user has already voted
  private function user_feedback($userID, $blog_ID){
    $emotions = $this->feedback_emotions();

    foreach($emotions as $emotion){
      $feedback = $this->db->prepare("SELECT * FROM blog_".$emotion." WHERE blog_ID = :blog_ID AND ".$emotion."By = :userID");
      $feedback->execute(array(':blog_ID' => $blog_ID, ':userID' => $userID));
      $voted = $feedback->fetchAll(PDO::FETCH_ASSOC);
      if (count($voted) == 1){
        return "<user>".$emotion."</user>";
      }
    }
    return "<user>none</user>";
  }

  //returns the results of the feedback
  private function feedback_results($blog_ID){

    $XML = '';

    //get all feedback votes for this blog article
    //checking if there exist a row for that blog in the blog_feedback table
    $feedback = $this->db->prepare("SELECT * FROM blog_feedback WHERE blog_ID = :blog_ID");
    $feedback->execute(array(':blog_ID' => $blog_ID));
    $emotions = $feedback->fetch(PDO::FETCH_ASSOC);

    //add row if it doesn't exist
    if (!$emotions){
      $add_feedback_row = $this->db->prepare("INSERT INTO blog_feedback (blog_ID, love, wow, happy, funny, neutral, sad, angry)
                                              VALUES (:blog_ID, 0,0,0,0,0,0,0)");
      $add_feedback_row->execute(array(':blog_ID' => $blog_ID));

      $feedback = $this->db->prepare("SELECT * FROM blog_feedback WHERE blog_ID = :blog_ID");
      $feedback->execute(array(':blog_ID' => $blog_ID));
      $emotions = $feedback->fetch(PDO::FETCH_ASSOC);
    }

    //create XML file to return the emotion votes
    $index = 0;
    foreach($emotions as $em => $value){
      $em_array = $this->feedback_emotions();
      if(in_array($em, $em_array)){
        $XML .= "<".$em.">".$value."</".$em.">";
      }
    }

    $XML .= $this->user_feedback(Session::user_data("ID"), $blog_ID);

    return $XML; //return XML
  }

  //determines wehther the user has logged in to print the feedback results if he voted or to allow him to vote if he's logged
  public function feedback($blog){

    header("Content-Type: text/xml");

    $XML = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
            <response>';

    $blog_ID = $blog[0];

    if(Session::get("loggedin")){

      $this->feedback_database(); //create feedback tables if they do not exist

      if (isset($blog[1])){ //if the user has voted
        $vote = $blog[1];

        $emotions = $this->feedback_emotions();

        $voted = 0;
        foreach($emotions as $emotion){
          $feedback = $this->db->prepare("SELECT * FROM blog_".$emotion." WHERE blog_ID = :blog_ID AND ".$emotion."By = :userID");
          $feedback->execute(array(':blog_ID' => $blog_ID, ':userID' => Session::user_data("ID")));
          $voted = count($feedback->fetchAll(PDO::FETCH_ASSOC));
          if ($voted > 0){
            break;
          }
        }

        if($voted == 0){

          $add_vote = $this->db->prepare("INSERT INTO blog_".$vote." (blog_ID, ".$vote."By) VALUES (:blog_ID, :userID)");
          $add_vote->execute(array(':blog_ID' => $blog_ID ,'userID' => Session::user_data("ID")));

          $update_feedback = $this->db->prepare("UPDATE blog_feedback SET ".$vote." = ".$vote." + 1 WHERE blog_ID = :blog_ID");
          $update_feedback->execute(array(':blog_ID' => $blog_ID));

        }
        else{
          return $XML.$this->feedback_results($blog_ID)."</response>";
        }
      }
      else{
        if ($this->user_feedback(Session::user_data("ID"), $blog_ID) != "none"){
          return $XML.$this->feedback_results($blog_ID)."</response>";
        }
      }
      return $XML.$this->feedback_results($blog_ID)."</response>";
    }

  }

  //calculates average read time of the article
  private function read_time($article){
    $words = count(explode(" ",$article)); //total words of the article
    $avg_wpm = 200; //average word per minute read by the average person
    $readtime = round($words/$avg_wpm); //calculates the read time

    $time = "";
    if ($readtime == 1){ //if the read time is 1 minute
      $time = $readtime." minute";
    }
    else{
      $time = $readtime." minutes";
    }

    return array("read_time" => $time);
  }

  //COMMENT SECTION

  //checking whether comment is root
  private function reply_or_root($comm_id, $replied_to_user){

    if ($comm_id >= 0):
      return '<span class="reply-img"></span>
              <a href="'.BASE_DIR.'user/id/'.$comm_id.'" "="">'.$replied_to_user["username"].'</a>';
    endif;

    return '<span class="wrote-img"></span>';

  }

  //getting user info given his ID.
  private function get_user_info($id){

    $user = $this->db->prepare("SELECT * FROM users WHERE ID = :id");
    $user->execute(array(':id' => $id));
    $info = $user->fetch(PDO::FETCH_ASSOC);

    $info["country-flag"] = $info['country']; //used to get the flag of the country which includes dashes "-"
    $info["country"] = str_replace("-", " ", $info['country']);

    if (empty($info["profile_icon"])){
      $info["profile_icon"] = "default-profile-picture.jpg";
    }

    return $info;
  }

  //gets total comments of the user by its ID on this article
  private function user_total_comments($id, $blog_ID){
    $comments = $this->db->prepare("SELECT * FROM comments WHERE userID = :id AND articleID = :articleID");
    $comments->execute(array(':id' => $id, ':articleID' => $blog_ID));
    $num_of_comments = count($comments->fetchAll(PDO::FETCH_ASSOC));

    return $num_of_comments;
  }

  //prints the date in a friendly format (NOT USED)
  private function date_friendly_format($date){

    $minute = mb_substr($date,14,16, 'UTF-8');
    $hour = mb_substr($date,11,13, 'UTF-8');
    $day = mb_substr($date,8,10, 'UTF-8');
    $month = mb_substr($date,5,2, 'UTF-8');
    $year = mb_substr($date,0,4, 'UTF-8');

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

    //time
    if ($hour[0] == "0" && strlen($hour) == 2){
      $hour = $hour[1];
    }
    return $months[$month]." ".$day.", ".$year." ".$hour.":".$minute."         date: ".$date." length: ".strlen($date);
  }

  //creates the HTML code of the given comment info
  private function commentHTML($route_ID, $comment_info, $author_info, $reply_or_root, $blog_ID){
    //if user is an editor or admin
    $root_comment_id = $route_ID;
    $comment_ID = $comment_info["ID"];
    $comment = $comment_info["comment"];
    $likes = $comment_info["likes"];
    $dislikes = $comment_info["dislikes"];
    $authorID = $author_info["ID"];
    $author_username = $author_info["username"];
    $author_role = $author_info["role"];
    $author_prof_icon = $author_info["profile_icon"];
    $author_region_flag = $author_info["country-flag"];
    $author_region = $author_info["country"];
    $author_total_comms = $this->user_total_comments($authorID, $blog_ID); //getting total comments written by this author

    $display_role = "";
    if ($author_role != "member"){
      $display_role = $author_role;
    }

    //checking if the logged user has voted this comment
    $vote_up_img = "vote-up"; //voted up image
    $vote_down_img = "vote-down"; //voted up image

    //checking if the user liked this comment
    $check_vote = $this->db->prepare("SELECT * FROM likes WHERE commID = :commID AND likedBy = :userID");
    $check_vote->execute(array(':commID' => $comment_ID, ':userID' => Session::user_data("ID")));
    $liked = count($check_vote->fetchAll(PDO::FETCH_ASSOC));
    if ($liked > 0){
      $vote_up_img = "voted-up";
    }
    //chcking if the user has disliked this comment
    $check_vote = $this->db->prepare("SELECT * FROM dislikes WHERE commID = :commID AND dislikedBy = :userID");
    $check_vote->execute(array(':commID' => $comment_ID, ':userID' => Session::user_data("ID")));
    $disliked = count($check_vote->fetchAll(PDO::FETCH_ASSOC));
    if ($disliked > 0){
      $vote_down_img = "voted-down";
    }

    //date posted

    $datetime = new DateTime($comment_info["postDate"]);
    $time_now = new DateTime('now');

    $published_date = $datetime->format('M jS, Y \a\t G:i'); // Updated ISO8601
    $diff = $datetime->diff($time_now);

    $time_elapsed = explode(",", $diff->format('%y, %m, %d, %h, %i, %s'));

    if($time_elapsed[2] <= 2){
      if ($time_elapsed[2] >= 1){
        $published_date = $time_elapsed[2]." days ago";
        if ($time_elapsed[2] == 1){
          $published_date = $time_elapsed[2]." day ago";
        }
      }
      else if($time_elapsed[3] >= 1 && $time_elapsed[3] <= 23){
        $published_date = $time_elapsed[3]." hours ago";
        if ($time_elapsed[3] == 1){
          $published_date = $time_elapsed[3]." hour ago";
        }
      }
      else if($time_elapsed[4] >= 1 && $time_elapsed[4] <= 59){
        $published_date = $time_elapsed[4]." minutes ago";
        if ($time_elapsed[4] == 1){
          $published_date = $time_elapsed[4]." minute ago";
        }
      }
      else if($time_elapsed[5] >= 0 && $time_elapsed[5] <= 59){
        $published_date = $time_elapsed[5]." seconds ago";
        if ($time_elapsed[5] == 1){
          $published_date = $time_elapsed[5]." second ago";
        }
      }
    }
    //$published_date = $datetime->format('M jS Y \o\n D \a\t G:i'); // Updated ISO8601

    $commentHTML = '<div class="post" data-root-id="'.$root_comment_id.'" id="comment-'.$comment_ID.'" data-comment-id="'.$comment_ID.'" data-comment-author-id="'.$authorID.'">
              <div class="comm-rapper">
                <div class="opt-wrapper">
                  <div class="user-profile-picture">
                    <div class="user-prof-pic-wrap">
                      <img data-pin-nopin class="user-prof" src="'.BASE_DIR.MEDIA_STORAGE_URL.'profile_pics/'.$author_prof_icon.'"><br>
                      <span class="region-flag-wrapper">
                        <img data-pin-nopin class="region-flag" src='.BASE_DIR.MEDIA_STORAGE_URL."country-flags/country-flag-".$author_region_flag.".png".'
                       title="'.$author_region.'" alt="'.$author_region.'"/>
                      </span>
                      <span><p class="tot-comments"><span class="comments-icon"></span> '.$author_total_comms.'</p></span>
                    </div>
                  </div>
                  <div class="root-comment-cont">
                    <div class="comment-wrapper reply-list-wrapper">
                      <div class="comment-post-head">
                        <div class="comment-post-info">
                          <div class="comment-user-info">
                            <div class="comment-author">
                              <div class="comment-user-wrote">
                                <a href="'.BASE_DIR.'user/id/'.$authorID.'" "="">'.$author_username.'</a> '.ucfirst($display_role).'
                                '.$reply_or_root;

    if ($comment_info['edited'] == 1){
      $commentHTML .= '<p class="edited-label">(edited)</p>';
    }
      $commentHTML .= ':      </div>
                              <div class="posted-date-wrapper">
                                <div class="posted-date-img"></div>
                                <span class="date">'.$published_date." ".'</span>
                              </div>
                            </div><!-- member type can be: admin, moderator, editor, or just member -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="comment comment-post-body">
                      <p class="comment-output" id="comment-post-manage-2">'.$comment.'</p>
                    </div>
                    <div class="options comment-options comment-post-foot">
                      <div class="vote-report">';
    if (Session::user_data("ID") == $authorID){
      $commentHTML .= '<span class="edit-btn-wrap">
                        <button class="comment-edit-btn action__button" data-comment-id="'.$comment_ID.'">
                          Edit
                        </button>
                      </span>
                      <span class="delete-btn-wrap">
                        <button class="comment-delete-btn action__button" data-comment-id="'.$comment_ID.'">
                          Delete
                        </button>
                      </span>';
    }
    if (Session::get("loggedin")){
      $commentHTML .= '<span class="reply-btn-wrap">
                          <button class="reply-btn action__button" data-comment-id="'.$comment_ID.'">
                            Reply
                          </button>
                        </span>';
    }
    $commentHTML .= ' <span class="vote-up">
                        <button class="vote-up-btn" data-comment-id="'.$comment_ID.'">
                          <img data-pin-nopin class="vote-up-img" src="'.BASE_DIR.MEDIA_STORAGE_URL.$vote_up_img.'.png">
                        </button>
                        <p class="total-up-votes">'.$likes.'</p>
                      </span>
                      <span class="vote-down">
                        <button class="vote-down-btn" data-comment-id="'.$comment_ID.'">
                          <img data-pin-nopin class="vote-down-img" src="'.BASE_DIR.MEDIA_STORAGE_URL.$vote_down_img.'.png">
                        </button>
                        <p class="total-down-votes">'.$dislikes.'</p>
                      </span>
                      <span class="report">
                        <button class="report-btn" data-comment-id="'.$comment_ID.'">
                          <img title="Report" data-pin-nopin class="vote-down-img" src="'.BASE_DIR.MEDIA_STORAGE_URL.'report-flag.png">
                        </button>
                      </span>
                    </div>
                  </div></div></div>';
    if (Session::get("loggedin")){
      $commentHTML .= '<div class="reply-input-wrapper">
                    <textarea class="comment-input" placeholder="Have something to add to '.$author_username.'?."></textarea>
                    <button type="button" class="cancel-reply action__button">cancel</button>
                    <button type="button" data-comment-id="'.$comment_ID.'" class="submit-reply action__submit">Post reply</button>
                  </div>';
    }
    //<button type="button" class="comm-preview action__button">preview</button>
    return $commentHTML;
  }

  //calculates the rating score given the amount of likes and dislikes of a comment.
  private function rating_score($likes, $dislikes){
    $a = 1 + $likes;
    $b = 1 + $dislikes;
    $score = $a/($a+ $b) - 1.65*sqrt(($a*$b)/(($a+$b)*($a+$b)*($a+$b+1)));
    return $score;
  }

  //sorts comments (using bubble sort) based on their rating scores calculated by the rating_score function.
  private function bubble_sort_ratings($comments_list){
    $n = count($comments_list);
    while ($n > 0){
      $newn = 0;
      for ($i = 1; $i < $n; $i++){
        if ($this->rating_score($comments_list[$i-1]["likes"],$comments_list[$i-1]["dislikes"]) < $this->rating_score($comments_list[$i]["likes"],$comments_list[$i]["dislikes"])){
          $swap = $comments_list[$i];
          $comments_list[$i] = $comments_list[$i-1];
          $comments_list[$i-1] = $swap;
          $newn = $i;
        }
      }
      $n = $newn;
    }
    return $comments_list;
  }

  //outputs the list of comments from the database based of that blog and on the given order. The newest comments will be printed if the order paremeter is not set
  private function comments_list_output($blog_ID, $order = "newest"){

    $SQL_stmt = "SELECT * FROM comments WHERE articleID = :articleID ORDER BY ID ASC";

    if ($order == "newest"){
      $SQL_stmt = "SELECT * FROM comments WHERE articleID = :articleID ORDER BY ID DESC";
    }

    $comments = $this->db->prepare($SQL_stmt);
    $comments->execute(array(':articleID' => $blog_ID));
    $comments_list = $comments->fetchAll(PDO::FETCH_ASSOC);

    if($order == "recommended"){
      $comments_list = $this->bubble_sort_ratings($comments_list);
    }

    return $comments_list;
  }

  //gets a single row of a comment given its ID and the article it's written
  private function single_comment_output($comm_ID, $blog_ID){
    $comment = $this->db->prepare("SELECT * FROM comments WHERE ID = :id AND articleID = :articleID");
    $comment->execute(array(':id' => $comm_ID, ":articleID" => $blog_ID));
    $comment_row = $comment->fetch(PDO::FETCH_ASSOC);

    return $comment_row;
  }

  //returns the full html code of all comments retrieved according to the user input (article ID, order, display -> how many comments to show per page and page number)
  public function comments($blog_ID, $order, $display, $page){ //retrieve comments (READ)

    $comments_output = "";
    $comments_list = $this->comments_list_output($blog_ID, $order);

    $comm_count = 0;

    foreach ($comments_list as $comment){

      if(!($comment["repliedToCommentId"] > -1)){ //if this is a root comment

        if ($comm_count >= ($display * ($page - 1)) && $comm_count < $display * $page){

          $root_author = $this->get_user_info($comment["userID"]); //getting the info of this root comment author

          $comment_HTML = $this->commentHTML($comment["ID"], $comment, $root_author, '<span class="wrote-img"></span>', $blog_ID);
          $comments_output .= $comment_HTML.'<div class="reply-comments-list">'; //opening the div to add possible replies

          $replies_index = 0;

          //getting the total amount of reply comments to that root comment
          $comment_replies = $this->db->prepare("SELECT * FROM comments WHERE rootCommentId = :id AND articleID = :articleID");
          $comment_replies->execute(array(':id' => $comment["ID"], ':articleID' => $blog_ID));
          $total_replies = count($comment_replies->fetchAll(PDO::FETCH_ASSOC));

          if ($total_replies > 0){
            foreach ($comments_list as $c){ //iterating again through the list of all comments to find which comments are replies to the root

              if ($c["rootCommentId"] == $comment["ID"]){ //if this comment is replied to the root comment ID

                if ($replies_index < 3){ //3 is the maximum number of replies shown without clicking the view more replies button
                  $reply_author = $this->get_user_info($c["userID"]);
                  $replied_to_user = $this->get_user_info($c["repliedToUserId"]);
                  $reply_or_root = $this->reply_or_root($c["repliedToUserId"], $replied_to_user); //html code indicating that the user "replied to" or "wrote to"
                  $num_of_comments = $this->user_total_comments($reply_author["ID"], $blog_ID); //getting total comments written by this author

                  $comment_HTML = $this->commentHTML($c["rootCommentId"], $c, $reply_author, $reply_or_root, $blog_ID);
                  $comments_output .= $comment_HTML.'</div></div>';
                }
                else{
                  $comments_output .= "<button type='button' class='load-more-replies more-replies-btn-".$comment["ID"]." action__submit' data-root-id='".$comment["ID"]."'>+ ".($total_replies-3)." more replies</button>";
                  break;
                }
                $replies_index = $replies_index + 1;
              }
            }
          }
          $comments_output .= '</div></div></div>';

        }
        else{
          if ($comm_count >= $display * $page){
            break;
          }
        }
        $comm_count = $comm_count + 1;
      }
    }

    return $comments_output;
  }

  //loads more reply comments. Triggered only when the "+load more" button is pressed by the user.
  public function more_replies($root_ID, $blog_ID, $order){
    //tweak needed : this loads all comments instead form that blog instead of only the replies to the given root commend id.
    $replies_list = $this->comments_list_output($blog_ID, $order);

    $comments_output = ""; //output;

    $reply_counter = 0; //used to check if the first 3 iterations are done, since the first 3 replies are already shown.

    foreach($replies_list as $r){
      if ($r["rootCommentId"] == $root_ID){ //if this comment is replied to the root comment ID
        if ($reply_counter >= 3){

          $reply_author = $this->get_user_info($r["userID"]);
          $replied_to_user = $this->get_user_info($r["repliedToUserId"]);
          $reply_or_root = $this->reply_or_root($r["repliedToUserId"], $replied_to_user); //html code indicating that the user "replied to" or "wrote to"
          $num_of_comments = $this->user_total_comments($reply_author["ID"], $blog_ID); //getting total comments written by this author

          $comment_HTML = $this->commentHTML($r["rootCommentId"], $r, $reply_author, $reply_or_root, $blog_ID);
          $comments_output .= $comment_HTML.'</div></div></div>';

        }
        else{
          $reply_counter = $reply_counter + 1;
        }
      }
    }

    return $comments_output;
  }

  //returns the ammount of comment pages needed to display all comments
  public function comments_pages($blog_ID, $display){
    $comments_list = $this->comments_list_output($blog_ID);
    $all_comments = count($comments_list);
    for ($comm = 0; $comm < $all_comments; $comm++){
      if($comments_list[$comm]["repliedToCommentId"] > -1){ //if this isn't a root comment
        unset($comments_list[$comm]);
      }
    }
    $root_comments = count($comments_list);
    return ceil($root_comments/$display);
  }

  //submits a new comment
  public function submit_comment($comment, $blog_ID){ //Create comment (CREATE)

    // inserting the comment into the database
    if ($comment != ""){
      //Session::init();
      $publish = $this->db->prepare("INSERT INTO comments (userID, comment, articleID, postDate, likes, dislikes, score, rootCommentId, repliedToCommentId, repliedToUserId, edited)
                                                  VALUES (:userID, :comment, :articleID, :postDate, :likes, :dislikes, :score, :rootCommentId, :repliedToCommentId, :repliedToUserId, :edited)");
      $publish->execute(array(':userID' => Session::user_data("ID"), ':comment' => $comment, ':articleID' => $blog_ID, 'postDate' => date("Y-m-d H:i:s"), ':likes' => '0', ':dislikes' => '0', ':score' => '0', ':rootCommentId' => '-1', ':repliedToCommentId' => '-1', ':repliedToUserId' => '-1', ':edited' => 0));
      $comment_ID = $this->db->lastInsertId();

      $comm_inserted = $this->single_comment_output($comment_ID, $blog_ID);

      $time_now = new DateTime('now');

      $comment_HTML = $this->commentHTML($comment_ID, $comm_inserted, Session::user_all_data(), '<span class="wrote-img"></span>', $blog_ID);
      return $comment_HTML.'<div class="reply-comments-list"></div></div></div></div>';
    }
    return "<p class='comment_error_msg'>error</p>";
  }

  //submits a new reply comment
  public function submit_reply($comment, $blog_ID, $replied_to_comm_ID, $replied_to_user_ID, $root_ID){ //Create reply comment (CREATE)

    // inserting the comment into the database
    if ($comment != " " && $comment != ""){
      //Session::init();
      $publish = $this->db->prepare("INSERT INTO comments (userID, comment, articleID, postDate, likes, dislikes, score, rootCommentId, repliedToCommentId, repliedToUserId, edited)
                                      VALUES (:userID, :comment, :articleID, :postDate, :likes, :dislikes, :score, :rootCommentId, :repliedToCommentId, :repliedToUserId, :edited)");
      $publish->execute(array(':userID' => Session::user_data("ID"), ':comment' => $comment, ':articleID' => $blog_ID, 'postDate' => date("Y-m-d H:i:s"), ':likes' => '0', ':dislikes' => '0', ':score' => '0', ':rootCommentId' => $root_ID, ':repliedToCommentId' => $replied_to_comm_ID, ':repliedToUserId' => $replied_to_user_ID, ':edited' => 0));
      $comment_ID = $this->db->lastInsertId();

      $reply_or_root = $this->reply_or_root($root_ID, $this->get_author_data($replied_to_user_ID));
      $comm_inserted = $this->single_comment_output($comment_ID, $blog_ID);

      $time_now = new DateTime('now');

      $comment_HTML = $this->commentHTML($root_ID, $comm_inserted, Session::user_all_data(), $reply_or_root, $blog_ID);
      return $comment_HTML.'</div></div></div>';
    }
    return "<p class='comment_error_msg'>error</p>";
  }

  //submits an edited comment
  public function edit_comment($comm_ID, $blog_ID, $edited_comment){ //Edit comment (UPDATE)

    //checking if this comment which is about ot be deleted belongs to the logged user
    if ($edited_comment != " " && $edited_comment != ""){
      $comment_row = $this->single_comment_output($comm_ID, $blog_ID);

      if ($comment_row['userID'] == Session::user_data("ID") && $comment_row['articleID'] == $blog_ID && $comment_row['comment'] != $edited_comment){ //if this comment belongs to the user (prevent possible JS modification)

        $edit = $this->db->prepare("UPDATE comments SET comment = :comment, edited = :edited, postDate = :postDate WHERE ID = :id AND articleID = :articleID");
        $edit->execute(array(':comment' => $edited_comment, ':edited' => 1, ':postDate' => date("Y-m-d H:i:s"), ':id' => $comm_ID, ':articleID' => $blog_ID));

        $reply_or_root = $this->reply_or_root($comment_row["repliedToCommentId"], $this->get_author_data($comment_row["repliedToUserId"]));
        $comment = $this->single_comment_output($comm_ID, $blog_ID);

        $comment_HTML = $this->commentHTML($comment["repliedToCommentId"], $comment, Session::user_all_data(), $reply_or_root, $blog_ID);
        return $comment_HTML.'</div></div></div>';

      }
      return "error";
    }
    return "error";
  }

  //removes a comment
  public function delete_comment($rootId, $comm_ID, $blog_ID){ //Delete comment (DELETE)

    //checking if this comment which is about ot be deleted belongs to the logged user
    $comment_row = $this->single_comment_output($comm_ID, $blog_ID);

    if ($comment_row['userID'] == Session::user_data("ID") && $comment_row['articleID'] == $blog_ID){ //if this comment belongs to the user

      $remove = $this->db->prepare("DELETE FROM comments WHERE ID = :id AND articleID = :articleID");
      $remove->execute(array(':id' => $comm_ID, ':articleID' => $blog_ID));

      if ($rootId == $comm_ID){ //if this comment is a root comment

        $remove = $this->db->prepare("DELETE FROM comments WHERE rootCommentId = :rootCommentId");
        $remove->execute(array(':rootCommentId' => $rootId));

      }
      return "comment removed";
    }
    return "error";
  }

  //submits a vote
  public function vote($comm_ID, $blog_ID, $vote){

    //checking if this comment which is about to be voted is on the same blog
    $comment_row = $this->single_comment_output($comm_ID, $blog_ID);

    if ($comment_row['articleID'] == $blog_ID && ($vote == "upvote" || $vote == "downvote")){ //if this comment belongs to the user

      $votedBy = "likedBy";
      $votes = "likes";
      $vote_type = "like";

      if($vote == "downvote"){
        $votedBy = "dislikedBy";
        $votes = "dislikes";
        $vote_type = "dislike";
      }

      $check_vote = $this->db->prepare("SELECT * FROM ".$votes." WHERE commID = :commID AND ".$votedBy." = :userID");
      $check_vote->execute(array(':commID' => $comm_ID, ':userID' => Session::user_data("ID")));
      $voted = count($check_vote->fetchAll(PDO::FETCH_ASSOC));

      $total_votes = $comment_row[$votes]; //getting the total votes (either likes or dislikes) for this comment
      $return_result = "like";

      //checking if the user has already voted (liked or disliked) this comment
      if ($voted > 0){
        //removing the vote
        $remove = $this->db->prepare("DELETE FROM ".$votes." WHERE commID = :commID AND ".$votedBy." = :userID");
        $remove->execute(array(':commID' => $comm_ID, ':userID' => Session::user_data("ID")));

        //substracting one vote for this comment
        $total_votes = $comment_row[$votes] - 1;
        $return_result = "un-".$vote_type;
      }
      else {
        //adding the vote
        $add = $this->db->prepare("INSERT INTO ".$votes." (commID, ".$votedBy.") VALUES (:commID, :userID)");
        $add->execute(array(':commID' => $comm_ID, ':userID' => Session::user_data("ID")));

        //adding one vote for this comment
        $total_votes = $comment_row[$votes] + 1;
        $return_result = $vote_type;

        //checking if the user has disliked or liked already the comment (switching votes possibility)
        $other_votes = "likes";
        $other_votedBy = "likedBy";
        $other_vote = "like";
        if ($vote == "upvote"){
          $other_votes = "dislikes";
          $other_votedBy = "dislikedBy";
          $other_vote = "dislike";
        }
        $check_vote = $this->db->prepare("SELECT * FROM ".$other_votes." WHERE commID = :commID AND ".$other_votedBy." = :userID");
        $check_vote->execute(array(':commID' => $comm_ID, ':userID' => Session::user_data("ID")));
        $voted = count($check_vote->fetchAll(PDO::FETCH_ASSOC));
        if ($voted > 0){
          //removing the other vote (so for example, if the user liked this comment but already disliked, the dislike will be removed)
          $remove = $this->db->prepare("DELETE FROM ".$other_votes." WHERE commID = :commID AND ".$other_votedBy." = :userID");
          $remove->execute(array(':commID' => $comm_ID, ':userID' => Session::user_data("ID")));

          if ($comment_row[$other_votes] > 0){
            //substracting the other vote (so for example, if the user liked this comment but already disliked, the dislike will be substracted)
            $other_total_votes = $comment_row[$other_votes] - 1;
            $substract = $this->db->prepare("UPDATE comments SET ".$other_votes." = :".$other_votes." WHERE ID = :id AND articleID = :articleID");
            $substract->execute(array(':'.$other_votes => $other_total_votes, ':id' => $comm_ID, ':articleID' => $blog_ID));
            $return_result = "switched-".$vote_type;
          }
        }
      }

      $edit = $this->db->prepare("UPDATE comments SET ".$votes." = :".$votes." WHERE ID = :id AND articleID = :articleID");
      $edit->execute(array(':'.$votes => $total_votes, ':id' => $comm_ID, ':articleID' => $blog_ID));

      return $return_result;
    }
    return "error";
  }

  function getUserIP(){
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {

      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];

    }

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }
    else{
        $ip = $remote;
    }

    return $ip;
}


  function report($violation, $comm_ID, $user_ID = 0){
    $id = $this->getUserIP();

    //chcking whether the same report has been dne by the same user in the past
    $duplicate = $this->db->prepare("SELECT * FROM `commentreports` WHERE commID = :commID AND report = :report AND userID = :userID)");
    $duplicate->execute(array(':commID' => $comm_ID, ':report' => $violation, ':userID' => $user_ID));
    $result = count($check_vote->fetchAll(PDO::FETCH_ASSOC));

    if ($result == 0){
      $add_report = $this->db->prepare("INSERT INTO `commentreports` (`commID`, `report`, `userID`, `IPaddress`) VALUES (:commID, :report, :userID, :IPaddress)");
      $add_report->execute(array(':commID' => $comm_ID, ':report' => $violation, ':userID' => $user_ID, ':IPaddress' => $id));
    }
  }

}

?>

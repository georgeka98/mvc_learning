<?php

class Blog_model extends Model
{

  public function __construct(){
    parent::__construct();
  }

  public function get_article($title){
    $post = $this->db->prepare("SELECT * FROM blog WHERE lower(title) = :title");
    $post->execute(array(':title' => strtolower($title)));
    $info = $post->fetch(PDO::FETCH_ASSOC);

    return array("article" => $info["post"], "title" => $info["title"]);
  }
}


?>

<?php

class Model{

  function __construct(){
    try{
      $this->db = new Database();
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }
    catch(PDOException $e){
      print "error in connection" . $e->getMessage();
    }
  }

}


?>

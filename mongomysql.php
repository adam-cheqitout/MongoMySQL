<?php
  class mongomysql {
    var $db;
    var $table;
    var $user;
    var $pass;
    var $conn;
    function __construct($host, $db, $table, $user, $pass) {
      $this->table = $table;
      $this->conn = new mysqli($host, $user, $pass, $db);
    }

    function find($restraints, $sort){
      $query = "SELECT * FROM " . $this->table;
      if(count($restraints) > 0){
        $query .= " WHERE ";
        foreach($restraints as $key => $value){
          $cond = $key . "=" . "'" . $value . "' ";
          $query .= $cond;
        }
        if(count($sort) > 0){
          foreach($sort as $key => $value){
            if($key == "limit"){
              $query .= "LIMIT " . $value . " ";
            }
            if($key == "sort" && $value == -1){
              $query .= "ORDER BY ID DESC";
            }
            if($key == "sort" && is_array($value)){
              if($value[array_keys($value)[0]] == -1){
                $query .= "ORDER BY " . array_keys($value)[0] . " DESC";
              } else {
                $query .= "ORDER BY " . array_keys($value)[0] . " ASC";
              }
            }
          }
        }
      }
      return json_encode(mysqli_fetch_array(mysqli_query($this->conn, $query)));
    }

    function findOne($restraints){
      $query = "SELECT * FROM " . $this->table;
      if(count($restraints) > 0){
        $query .= " WHERE ";
        foreach($restraints as $key => $value){
          $cond = $key . "=" . "'" . $value . "' ";
          $query .= $cond;
        }
      }
      return json_encode(mysqli_fetch_array(mysqli_query($this->conn, $query)));
    }
    //TODO: add update, insert methods
  }
?>

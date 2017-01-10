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
      if(count($restraints) > 1){
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
      $res;
      try {
        $res = json_encode(mysqli_fetch_all(mysqli_query($this->conn, $query), MYSQLI_ASSOC));
      } catch(Exception $e){
        $res = $e;
      }
      return $res;
    }

    function findOne($restraints){
      //UNTESTED
      $query = "SELECT * FROM " . $this->table;
      if(count($restraints) > 0){
        $query .= " WHERE ";
        foreach($restraints as $key => $value){
          $cond = $key . "=" . "'" . $value . "' ";
          $query .= $cond;
        }
        $query .= "LIMIT 1";
      }
      $res;
      try {
        $res = json_encode(mysqli_fetch_array(mysqli_query($this->conn, $query)));
      } catch(Exception $e){
        $res = $e;
      }
      return $res;
    }

    function insert($data){
      $query = "INSERT INTO " . $this->table;
      $keys = " (id, ";
      $values = "(null, ";
      $numItems = count($data);
      $i = 0;
      foreach($data as $key => $value){
        if(++$i === $numItems) {
          $keys .= "". $key ."";
          $values .= "'" . $value . "'";
        } else {
          $keys .= "". $key .",";
          $values .= "'" . $value . "',";
        }
      }
      $query .= $keys . ") VALUES " . $values . ")";

      $res;
      try {
        $res = json_encode(mysqli_query($this->conn, $query));
      } catch(Exception $e){
        $res = $e;
      }

      return $res;
    }

    function update($restraints, $data){
      //UNTESTED
      $query = "UPDATE " . $this->table . " SET ";
      foreach($data as $key => $value){
        $query .= $key . "='" . $value . "'";
      }
      $query .= "WHERE ";
      foreach($restraints as $key => $value){
        $cond = $key . "=" . "'" . $value . "' ";
        $query .= $cond;
      }
      $res;
      try {
        $res = json_encode(mysqli_fetch_array(mysqli_query($this->conn, $query)));
      } catch(Exception $e){
        $res = $e;
      }
      return $res;
    }

  }
?>

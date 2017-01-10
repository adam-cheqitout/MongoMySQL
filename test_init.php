<?php
  function test_init($host, $user, $pass){
    $query = "CREATE DATABASE mongomysql";
    $res = mysqli_query(new mysqli($host, $user, $pass), $query);
    $query = "CREATE TABLE posts (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, post CHAR(250))";
    $res = mysqli_query(new mysqli($host, $user, $pass, "mongomysql"), $query);
    return $res;
  }
?>

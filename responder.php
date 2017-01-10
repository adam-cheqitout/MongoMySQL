<?php
  //
  //TODO
  //
  //Sanitize Inputs
  //

  require("mongomysql.php");
  require("test_init.php");
  if(isset($_POST['init'])){
    //THIS IS SET TO DEFAULT VALUES, SHOULD BE CHANGED TO YOUR DB LOCATION, USERNAME AND PASSWORD
    echo test_init("localhost", "root", "");
  }
  if(isset($_POST['collection'])){

    //initialize
    $collection = new mongomysql("localhost", "mongomysql", $_POST['collection'], "root", "");

    //if method exists
    if(isset($_POST['method'])){

      //find request
      if($_POST['method'] == "find"){
        $posts = $collection->find(json_decode($_POST['restraints']), json_decode($_POST['sort']));
        echo $posts;
      }
      if($_POST['method'] == "findOne"){
        $post = $collection->findOne(json_decode($_POST['restraints']));
        echo $post;
      }
      if($_POST['method'] == "insert"){
        $insert = $collection->insert(json_decode($_POST['data']));
        echo $insert;
      }
      if($_POST['method'] == "update"){
        $update = $collection->update(json_decode($_POST['restraints']), json_decode($_POST['data']));
        echo $update;
      }
    }
  }

?>

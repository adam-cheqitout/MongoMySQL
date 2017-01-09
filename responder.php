<?php
  require("mongomysql.php");
  if(isset($_POST['collection'])){
    $collection = new mongomysql("localhost", "wordpress", $_POST['collection'], "root", "");
    if(isset($_POST['restraints']) && !empty($_POST['restraints'])) {
        $posts = $collection->find(json_decode($_POST['restraints']), json_decode($_POST['sort']));
        echo $posts;
    }
  }
  //TODO: split methods for find, findOne, insert and update
?>

<?php
    include("../admin/functions.php");

    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }

   header('Content-Type: application/json');

   $stmt = $pdo->prepare('SELECT * FROM articles  WHERE view_flg=true ORDER BY indate DESC');
   $status = $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $filtered = array_filter($result,function($rec){
       $tags = explode(",",$rec["tag"]);
       return(in_array($_POST["tag"],$tags));
   });
    
   $res = json_encode($filtered);
   echo $res;
?>
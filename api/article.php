<?php
    include("../admin/functions.php");

    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }

   header('Content-Type: application/json');

   if(!isset($_POST["id"])){
   $stmt = $pdo->prepare('SELECT * FROM articles  WHERE view_flg=true ORDER BY indate DESC LIMIT 1');
   $status = $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $res = json_encode($result);
   echo $res;
   }else{
   $stmt = $pdo->prepare('SELECT * FROM articles  WHERE id=:id');
   $stmt->bindValue(':id', $_POST["id"]);
   $status = $stmt->execute();
   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $res = json_encode($result);
   echo $res;
   }
?>
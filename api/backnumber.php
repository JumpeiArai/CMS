<?php
    include("../admin/functions.php");

    try {
      $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
      exit('データベースに接続できませんでした。'.$e->getMessage());
    }

   header('Content-Type: application/json');

       $stmt = $pdo->prepare('SELECT indate FROM articles WHERE view_flg=true ORDER BY indate DESC');
       $status = $stmt->execute();
       $bnarr = [];
       while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
           $bnarr[] = explode("-",$result["indate"]);
       };

    $year = NULL;
    $years = [];
    $changed = -1;
    foreach ($bnarr as $date){

        if(isset($year) && $year === $date[0]){
            $years[$changed]["cnt"] += 1;
        }else{
            $year = $date[0];
            array_push($years,["year" => $year,"cnt" => 1]);
            $changed += 1;
        }
    }
    $res = json_encode($years);
    echo $res;
?>

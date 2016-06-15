<?php
/************************************************************
 *  ログイン認証OKの場合表示
 ************************************************************/
//1. SESSION開始
session_start();
include("func.php");

//2. セッションチェック(前ページのSESSION＿IDと現在のsession_idを比較)
sessionCheck();

//★SESSION IDを確認したい場合(検証→Resources→Cookies)

//セッションハイジャック対策（追加してください！）
loginRollSet();

//2. 認証後にSetされたSESSION変数を受け取り表示
$name = "<p>名前： " . $_SESSION["name"] . "</p>";

//3. 管理者FLGを表示
if( $_SESSION["kanri_flg"]==1 ) {
  $admin  =  "<p>権限：管理者</p>";
  $admin .=  '<p><a href="ucv.php">管理者メニュー</a></p>';
}else if( $_SESSION["kanri_flg"]==0 ){
  $admin = "<p>権限：一般</p>";
}

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}


$stmt = $pdo->prepare("SELECT * FROM articles");
$status = $stmt->execute();


//３データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){
    $view .= '<p><a href="update_detail.php?id='.$result["id"].'">'.$result["title"]." : ".$result["detail"].'    date:'.$result["indate"].'</a></p>';
  }
}


?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta title="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">データ登録</a>
        <p>
            <?=$name?>
        </p>
        <p>
            <?=$admin?>
        </p>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  
</div>
<!-- Main[End] -->
<footer>
    <button><a href="add.php">記事投稿</a></button>
    <button><a href="logout.php">ログアウト</a></button>
</footer>
</body>
</html>

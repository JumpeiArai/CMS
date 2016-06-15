<?php
include("./functions.php");


//1. POSTデータ取得
$id   = (int)$_POST["id"];
$title   = $_POST["title"];
$detail  = $_POST["detail"];
$view_flg = $_POST["view_flg"];

$detail_ch = str_replace(array("\r\n", "\r", "\n"), "\n", $detail);

//2. DB接続します(エラー処理追加)
$pdo = db_con();
//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO articles(id, title, detail, indate, view_flg )VALUES(NULL, :a1, :a2, sysdate(),:a3)");
$stmt->bindvalue(':a1',$title);
$stmt->bindvalue(':a2',$detail_ch);
$stmt->bindvalue(':a3',1);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  db_error($stmt);
}else{
  header("Location: select.php");
  exit;
}
?>

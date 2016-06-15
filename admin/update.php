<?php
include("./functions.php");

//入力チェック(受信確認処理追加)
//if(
//  !isset($_POST["id"]) || $_POST["id"] == ""||
//  !isset($_POST["title"]) || $_POST["title"]=="" ||
//  !isset($_POST["detail"]) || $_POST["detail"]==""
//){
//  exit('ParamError');
//}

//1. POSTデータ取得
$id   = (int)$_POST["id"];
$title   = $_POST["title"];
$detail  = $_POST["detail"];
$view_flg = $_POST["view_flg"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();
//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE articles SET title= ? , detail= ?, view_flg= ? WHERE id=?");
$stmt->bindparam(1,$title);
$stmt->bindparam(2,$detail);
$stmt->bindparam(3,$view_flg);
$stmt->bindparam(4,$id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  db_error($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: ./update_detail.php?id=".$id);
  exit;
}
?>

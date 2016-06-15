<?php
include("functions.php");
$id = (int)$_POST["id"];
$pdo = db_con();
$stmt = $pdo->prepare("DELETE FROM articles WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    db_error($stmt);
}else{
    //５．index.phpへリダイレクト
    header("Location: ./select.php");
    exit;
}
?>
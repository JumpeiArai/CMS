<?php
include("functions.php");
//1.GETでidを取得
$id = $_GET["id"];
//2.DB接続など
$pdo = db_con();
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
$result = $stmt->fetch();
var_dump($result["detail"]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="./update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>記事</legend>
     <label>TITLE：<input type="text" name="title" value="<?=$result["title"]?>"></label><br>
     <label><textArea name="detail" rows="4" cols="40"><?=$result["detail"]?></textArea></label><br>
     <label>VIEW_FLG：<input type="text" name="view_flg" value="<?=$result["view_flg"]?>"></label><br>
     <input type="hidden" name="id" value=<?=$id?>>
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>

<form method="post" action="delete.php">
    <input type="submit" value="削除する">
    <input type="hidden" name="id" value=<?=$id?>>
</form>
<button><a href="./select.php">List</a></button>
<!-- Main[End] -->


</body>
</html>







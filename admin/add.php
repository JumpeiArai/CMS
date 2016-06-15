<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>BLOG記事投稿</title>
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
<form method="post" action="./insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>記事</legend>
     <label>TITLE：<input type="text" name="title"></label><br>
     <label><textArea name="detail" rows="4" cols="40"></textArea></label><br>
     <label>VIEW_FLG：<input type="text" name="view_flg"></label><br>
     <input type="submit" value="投稿">
    </fieldset>
  </div>
</form>
<button><a href="./select.php">List</a></button>
<!-- Main[End] -->


</body>
</html>
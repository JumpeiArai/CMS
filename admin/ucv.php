<?php
session_start();
include("func.php");

//2. セッションチェック(前ページのSESSION＿IDと現在のsession_idを比較)
sessionCheck();

//★SESSION IDを確認したい場合(検証→Resources→Cookies)

//セッションハイジャック対策（追加してください！）
loginRollSet();

//2. 認証後にSetされたSESSION変数を受け取り表示
$name = "<p>名前： " . $_SESSION["name"] . "</p>";

//1.  DB接続します
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();
$result = $stmt->fetchAll();
$dataJ = json_encode($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>div{padding: 10px;font-size:16px;}</style>
    <title><?=$title?></title>
    <link rel="stylesheet" href="css/main.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/riot/2.4.1/riot+compiler.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<body>
<script>
   var data = <?=$dataJ?>;
   var name= <?='"'.$_SESSION["name"].'"'?>;
   console.log(data);
</script>

<header>
    <h1>登録ユーザーリスト</h1>
    <button><a href="logout.php">ログアウト</a></button>
</header>

<User-Controll></User-Controll>


<script type="riot/tag">
<User-Controll>
<table>
<th>DB-ID</th><th>NAME</th><th>ID</th><th>PW</th><th>ADMIN</th>
<tr each={data} class={itsyou:itsyou}><td>{id}</td><td>{name}</td><td>{lid}</td><td>{lpw}</td><td>{kanri_flg == 1 ? 'admin' : 'general'}</td></tr>
<table>
this.data=data;
this.name=name;
this.on('mount',function(){
    this.data.forEach(function(a){
    a.itsyou = (a.name === this.name);
    });
    this.update();
});
console.log(data);

/**STYLE**/
<style>
*{
width:400px;
margin:20px;
}

.itsyou{
 background-color:lightblue;
}

li {
  list-style:none;
}
</style>
</User-Controll>
</script>

<script>
    riot.mount('*');
</script>
</body>
</html>
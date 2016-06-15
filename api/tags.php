<?php
    include("../admin/functions.php");

try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
}

header('Content-Type: application/json');

$stmt = $pdo->prepare('SELECT tag FROM articles WHERE view_flg=true');
$status = $stmt->execute();
$namearr = [];
while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $namearr[] = explode(",",$r["tag"]);
};


$tags = [];
$namecache = [];
foreach($namearr as $arr){
    foreach($arr as $str){
        if(!in_array($str,$namecache)){
            $namecache[] = $str;
            $tags[$str] = 1;
        }else{
            $tags[$str] += 1;
        }
    }
}

$res = json_encode($tags);
echo $res;
?>
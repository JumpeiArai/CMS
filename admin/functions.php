<?php
//共通で使うものを別ファイルにしておきましょう。

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

//DB接続関数（PDO）
function db_con(){
  try {
    return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
}

//SQL処理エラー
function db_error($stmt){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

?>

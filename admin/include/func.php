<?php
//DB接続
function db(){
  return new PDO('mysql:dbname=gs_db;host=localhost', 'root', '');
}

//認証OK時の初期値セット
function loginSessionSet($val){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
}

//セッションチェック用関数
function sessionCheck(){
  if(isset($_SESSION["chk_ssid"]) != session_id()){
      echo "ログインしてください";
      exit();
  }else{
     session_regenerate_id(true);
     $_SESSION["chk_ssid"] = session_id();
  }
}

//HTML XSS対策
function htmlEnc($value) {
    return htmlspecialchars($value,ENT_QUOTES);
}
?>

<?php
//DB接続
function db(){

}

//認証OK時の初期値セット
function loginSessionSet(){

}

//セッションチェック用関数
function sessionCheck(){
    if( !isset($_SESSION["chk_ssid"]) || ($_SESSION["chk_ssid"] != session_id()) ){
        echo "LOGIN ERROR";
        exit();
    }
}

//ログイン時のセッションへの情報セット
function loginRollSet(){
    session_regenerate_id();
    $_SESSION["chk_ssid"]=session_id();
}

//HTML XSS対策
function htmlEnc($value) {
    return htmlspecialchars($value,ENT_QUOTES);
}
?>

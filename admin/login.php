<?php
//1. HTML_STARTをインクルード
$title = "LOGIN"; //html_start.phpのtitleタグに表示
include("html_start.php");
?>

<!-- login_act.php は認証処理用のPHPです。 -->
<header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header>
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form>


<?php

session_start();

$id = session_id();

echo $id;

$_SESSION["name"]="Yamazaki";

?>
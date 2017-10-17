<?php
//データベースの接続と選択
$server = "";  
$userName = ""; 
$password = ""; 
$dbName = "";

$mysqli = new mysqli($server, $userName, $password, $dbName);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}else{
	$mysqli->set_charset("utf-8");
}

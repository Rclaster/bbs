<?php
//データベースの接続と選択
$server = "202.221.137.203";  
$userName = "hiroki_takeuchi"; 
$password = "Hiroki19970121"; 
$dbName = "dev_bbs";

$mysqli = new mysqli($server, $userName, $password, $dbName);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}else{
	$mysqli->set_charset("utf-8");
}
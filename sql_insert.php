<?php
session_start();
$con = mysql_connect('', '', '');
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db('dev_bbs', $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}
//値の受け取り
$SUBJECT  = $_REQUEST['SUBJECT'];
$NAME = $_REQUEST['NAME'];
$MESSAGE  = $_REQUEST['MESSAGE'];
$DATE = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
$DATETIME = $DATE->format('Y-m-d H:i:s');
$USER_ID = $_SESSION['user'];

//ろぐいんno
if(!isset($_SESSION['user'])){
  $result = mysql_query("INSERT INTO bbs_post_detail(post_id, user_id, title_name, user_name, post_detail, post_date) 
  VALUES('', '', '$SUBJECT', '$NAME', '$MESSAGE', '$DATETIME')", $con);
}
//ろぐいんyes
if(isset($_SESSION['user'])){
  $result = mysql_query("INSERT INTO bbs_post_detail(post_id, user_id, title_name, user_name, post_detail, post_date) 
  VALUES('', '$USER_ID', '$SUBJECT', '$NAME', '$MESSAGE', '$DATETIME')", $con);
}
if (!$result) {
  exit('データを登録できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}
else{
  include('index.php');
}

?>

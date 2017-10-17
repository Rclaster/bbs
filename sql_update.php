<?php

$con = mysql_connect('202.221.137.203', 'hiroki_takeuchi', 'Hiroki19970121');
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
$M_POST_ID  = $_POST['UP_POST_ID'];
$SUBJECT  = $_REQUEST['SUBJECT'];
$NAME = $_REQUEST['NAME'];
$MESSAGE  = $_REQUEST['MESSAGE'];

$sql = "UPDATE bbs_post_detail SET title_name = '$SUBJECT', user_name = '$NAME', post_detail = '$MESSAGE', post_date = cast( now() as datetime ) 
WHERE POST_ID = '$M_POST_ID';";

$result = mysql_query($sql);

if (!$result) {
  exit('データを更新できませんでした。');
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}
else{
  include('index.php');
}

?>
<?php
// DBとの接続
require_once 'dbconnect.php';

//値の受け取り
$POST_ID  = $_POST['button'];//update,posst_idもろもろ
$ARRAY = explode(",", $POST_ID);

//削除ボタンが押下された時の処理
if($ARRAY[0] === "delete"){
    //$ARRAY[1] POST_ID
    $sql = "DELETE FROM bbs_post_detail where post_id = '$ARRAY[1]'";

    $result = $mysqli -> query($sql);
    //クエリー失敗
    if(!$result) {
        echo $mysqli->error;
        exit();
    }
    // データベース切断
    $mysqli->close();
    //遷移
    include('index.php');
    break;
}
//編集ボタンが押下された時の処理
if($ARRAY[0] === "update"){
    $sql = "SELECT * FROM bbs_post_detail where post_id = '$ARRAY[1]'";

    //クエリー実行
    $result = $mysqli -> query($sql);
    //クエリー失敗
    if(!$result) {
        echo $mysqli->error;
        exit();
    }
    if($row = $result->fetch_object()){
        $title = htmlspecialchars($row->title_name);
        $user = htmlspecialchars($row->user_name);
        $detail = htmlspecialchars($row->post_detail);
    }
    //結果セットを解放
    $result->free();
    // データベース切断
    $mysqli->close();
}
?>

<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BBS(電子掲示板)</title>
<link rel="stylesheet" href="style.css">

<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<form method="post" action="sql_update.php">
	<h1>投稿変更だよ</h1>
	<div class="form-group">
		<input type="text" class="form-control" name="SUBJECT" value="<?php print("$title"); ?>" placeholder="タイトル" required />
    </div>
    <div class="form-group">
		<input type="text" class="form-control" name="NAME" value="<?php print("$user"); ?>" placeholder="名前" required disabled="disabled"/>
	</div>
	<div class="form-group">
		<textarea row="5" col="60" wrap="OFF" class="form-control" name="MESSAGE" placeholder="うぃぃぃぃぃぃ" required /><?php print("$detail"); ?></textarea>
	</div>
	<button type="submit" class="btn btn-default" name="UP_POST_ID" value="<?php echo $ARRAY[1]; ?>">変更しまちゅ</button>
</form>
<form method="GET" action="index.php">
	<button type="submit" class="btn btn-default" name="signup">もどる</button>
</form>
</div>
</body>
</html>
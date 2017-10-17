<?php
session_start();
if( isset($_SESSION['user']) != "") {
	// ログイン済みの場合はリダイレクト
	header("Location: index.php");
}
?>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BBS(電子掲示板)</title>

<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<?php
// signupがPOSTされたときに下記を実行
if(isset($_POST['signup'])) {
    // DBとの接続
    require_once 'dbconnect.php';
	$username = $mysqli->real_escape_string($_POST['username']);
	$IMAGEPASS  = $_REQUEST['imagepass'];
    $password = $mysqli->real_escape_string($_POST['password']);
    $DATE = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $DATETIME = $DATE->format('Y-m-d H:i:s');
    
	// POSTされた情報をDBに格納する
    $query = "INSERT INTO post_user(user_id,user_name,user_icon,user_pass,registration_date) VALUES('','$username','$IMAGEPASS','$password','$DATETIME')";
	if($mysqli->query($query)) {  ?>
		<div class="alert alert-success" role="alert">登録しました</div>
		<?php } else { ?>
		<div class="alert alert-danger" role="alert">エラーが発生しました。</div>
		<?php
		}
} ?>
<div class="register">
	<form method="post">
		<h1>新規登録</h1>
		<div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="お名前" required />
		</div>
		<div class="form-group">
			<input type="password"  class="form-control" name="password" placeholder="パスワード" required />
		</div>
		<select name="imagepass" class="form-control">
			<!-- ***部分は上記js内と統一ください -->
			<option value="1">人</option>
			<option value="2">ガイコツ</option>
			<option value="3">熊の手</option>
			<option value="4">おばけ</option>
		</select>
		<br>
		<button type="submit" class="btn btn-default" name="signup">会員登録する</button>
		<a href="login.php">ログイン</a>
	</form>
	<form method="GET" action="index.php">
		<button type="submit" class="btn btn-default" name="signup">もどる</button>
	</form>
</div>
</div>
</body>
</html>
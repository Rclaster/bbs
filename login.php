<?php
ob_start();
//register.phpと同様
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: index.php");
}
include_once 'dbconnect.php';
?>

<?php
if(isset($_POST['login'])) {
	$user_name = $mysqli->real_escape_string($_POST['user_name']);
	$password = $mysqli->real_escape_string($_POST['password']);
	// クエリの実行
	$query = "SELECT * FROM post_user WHERE user_name='$user_name'";
	$result = $mysqli->query($query);
	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}
	// パスワード(暗号化済み）とユーザーIDの取り出し
	while ($row = $result->fetch_assoc()) {
		$db_hashed_pwd = $row['user_pass'];
		$user_id = $row['user_id'];
	}
	// データベースの切断
	$result->close();
	// ハッシュ化されたパスワードがマッチするかどうかを確認
	if ($password === $db_hashed_pwd) {
		$_SESSION['user'] = $user_id;
		header("Location: index.php");
		exit;
	} else { ?>
		<div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
	<?php }
} ?>

<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BBS(電子掲示板)</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<form method="post">
	<h1>ログインフォーム</h1>
	<div class="form-group">
		<input type="user_name"  class="form-control" name="user_name" placeholder="ユーザー名" required />
	</div>
	<div class="form-group">
		<input type="password" class="form-control" name="password" placeholder="パスワード" required />
	</div>
	<button type="submit" class="btn btn-default" name="login">ログインする</button>
	<a href="register.php">会員登録</a>
</form>
<form method="GET" action="index.php">
	<button type="submit" class="btn btn-default" name="signup">もどる</button>
</form>
</div>
</body>
</html>
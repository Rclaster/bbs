<?php
//データベース接続
$server = "";  
$userName = ""; 
$password = ""; 
$dbName = "";
 
$mysqli = new mysqli($server, $userName, $password,$dbName);
 
if ($mysqli->connect_error){
	echo $mysqli->connect_error;
	exit();
}else{
	$mysqli->set_charset("utf-8");
}
 
$sql = "SELECT * FROM bbs_post_detail";
 
$result = $mysqli -> query($sql);
//クエリー失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}
//レコード件数
$row_count = $result->num_rows;
//連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$rows[] = $row;
}
//結果セットを解放
$result->free();
// データベース切断
$mysqli->close();
?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../jb/style.css">
    <title>BBSサイト</title>
</head>
<body>
    <header id="global-header">
            <div class="inner">
                <div class="logo">BBSサイト</div>
                
                <!-- <ul>
                    <li><a href="####">新規登録</a></li>
                    <li><a href="####">ログイン</a></li>
                </ul> -->
            </div>
    </header>

    <!-- <form action="" method="GET">
        <select name="category" class="form-control input-sm" style="width: 240px;">
            {foreach from=$category key=key item=item}
            <option>{$item}</option>
            {/foreach}
        </select>
    </form>
    <div class="input-group">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-primary btn-sm">掲示板を探す</button>
            </div>
    </div> -->
    
    <b>投稿口：</b>
    <form method="POST" action="regist.php" name="fcs">
        <table border="0" width="100%">
          <tr>
            <td nowrap align="right">タイトル：</td>
            <td>
              <input type="text" name="SUBJECT" size="40">
              <input type="submit" value="書き込み">
            </td>
          </tr>
          <tr>
            <td nowrap align="right">名前：</td>
            <td><input type="text" name="NAME"></td>
          </tr>
          <tr>
            <td nowrap align="right" valign="top">内容：</td>
            <td>
              <textarea rows="5" cols="60" wrap="OFF" name="MESSAGE"></textarea>
              <input type="hidden" name="DIR" value="internet">
              <input type="hidden" name="BBS" value="20196">
              <input type="hidden" name="TIME" value="1507603683">
            </td>
          </tr>
        </table>
    </form>

    <div class="post_area">
        <b>投稿一覧：<?php echo $row_count; ?>件</b>
    </div>
    <table border='0' width="100%">
        <?php 
        foreach($rows as $row){
        ?> 
        <tr>
            <td nowrap align="right">タイトル：</td>
            <td><?php echo htmlspecialchars($row['title_name'],ENT_QUOTES,'UTF-8'); ?></td>
        </tr>
        <tr>
            <td nowrap align="right">名前：</td>
            <td><?php echo htmlspecialchars($row['post_detail'],ENT_QUOTES,'UTF-8'); ?></td>
        <tr>
        <tr>
            <td nowrap align="right" valign="top">内容：</td>
            <td><?php echo htmlspecialchars($row['post_date'],ENT_QUOTES,'UTF-8'); ?></td>
        </tr> 
        <?php 
        } 
        ?>
    </table>
</body>
</html>

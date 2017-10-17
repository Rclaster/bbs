<?php
/* Smarty version 3.1.30, created on 2017-10-10 13:07:21
  from "/var/www/bbs/dev/docs/template/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59dc47797af698_68453931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52c88c4b15a7bdc952174d0e1e8860d8b17286c6' => 
    array (
      0 => '/var/www/bbs/dev/docs/template/index.tpl',
      1 => 1507608433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59dc47797af698_68453931 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
';?>//データベース接続
$server = "127.0.0.1";  
$userName = "hiroki_takeuchi"; 
$password = "Hiroki19970121"; 
$dbName = "dev_bbs";
 
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
<?php echo '?>';?>

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
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
?>
            <option><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
        <b>投稿一覧：<?php echo '<?php ';?>echo $row_count; <?php echo '?>';?>件</b>
    </div>
    <table border='0' width="100%">
        <?php echo '<?php 
        ';?>foreach($rows as $row){
        <?php echo '?>';?> 
        <tr>
            <td nowrap align="right">タイトル：</td>
            <td><?php echo '<?php ';?>echo htmlspecialchars($row['title_name'],ENT_QUOTES,'UTF-8'); <?php echo '?>';?></td>
        </tr>
        <tr>
            <td nowrap align="right">名前：</td>
            <td><?php echo '<?php ';?>echo htmlspecialchars($row['post_detail'],ENT_QUOTES,'UTF-8'); <?php echo '?>';?></td>
        <tr>
        <tr>
            <td nowrap align="right" valign="top">内容：</td>
            <td><?php echo '<?php ';?>echo htmlspecialchars($row['post_date'],ENT_QUOTES,'UTF-8'); <?php echo '?>';?></td>
        </tr> 
        <?php echo '<?php 
        ';?>} 
        <?php echo '?>';?>
    </table>
</body>
</html><?php }
}

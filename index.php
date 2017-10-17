<?php
session_start();
// DBとの接続
require_once 'dbconnect.php';

if(isset($_SESSION['user'])){
    //ユーザーIDからユーザー名を取得
    $query = "SELECT * FROM post_user WHERE user_id=".$_SESSION['user']."";
    $result = $mysqli->query($query);
    if (!$result) {
        print('クエリーが失敗しました。' . $mysqli->error);
        $mysqli->close();
        exit();
    }
    // ユーザー情報の取り出し
    if ($row = $result->fetch_assoc()) {
        $username = $row['user_name'];
        $usericon = $row['user_icon'];
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../jb/reset.css">
    <link rel="stylesheet" type="text/css" href="../jb/style.css">
    <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>

    <title>BBS(電子掲示板)</title>
</head>
<body>
    <nav>
        <header class="global-header">
            <p>BBS(電子掲示板)</p>
            <!-- ろぐいんno -->
            <?php
            if(!isset($_SESSION['user'])){
            ?>
                <button><a href="register.php">新規登録 又は ログイン</a></button>
            <?php 
            }
            ?>
            <!-- ろぐいんyes -->
            <?php
            if(isset($_SESSION['user'])){
            ?>
            <div class="user">
                <table class="table">
                <tr>
                    <th class="img">
                        <!-- 選択なし 選択1 -->
                        <?php
                        if($usericon == 1 || !isset($usericon)){
                        ?>
                        <img src="../img/1.png" width="50px" height="100px">
                        <?php
                        }
                        ?>
                        <!-- 選択2 -->
                        <?php
                        if($usericon == 2){
                        ?>
                        <img src="../img/2.png" width="50px" height="100px">
                        <?php
                        }
                        ?>
                        <!-- 選択3 -->
                        <?php
                        if($usericon == 3){
                        ?>
                        <img src="../img/3.png" width="50px" height="100px">
                        <?php
                        }
                        ?>
                        <!-- 選択4 -->
                        <?php
                        if($usericon == 4){
                        ?>
                        <img src="../img/4.png" width="50px" height="100px">
                        <?php
                        }
                        ?>
                    </th>
                    <td>
                        <div class="box">
                        <p><?php echo $username; ?>さん</p>
                            <button><a href="logout.php?logout">ログアウト</a></button>
                        </div>
                    </td>
                </tr>
                </table>
            </div>
            <?php
            }
            ?>
        </header>
        <div class="post_place">
            <form method="POST" action="sql_insert.php" autocomplete="off">
                
                <table border="0">
                <tr>
                    <td nowrap align="right">タイトル：</td>
                    <td>
                    <input type="text" name="SUBJECT" size="40">
                    </td>
                </tr>
                <tr>
                    <td nowrap align="right">名前：</td>
                    <!-- ろぐいんno -->
                    <?php
                    if(!isset($_SESSION['user'])){
                    ?>
                    <td><input type="text" name="NAME" value="匿名ちゃん" required></td>
                    <?php 
                    }
                    ?>
                    <!-- ろぐいんyes -->
                    <?php
                    if(isset($_SESSION['user'])){
                    ?>
                    <td><input type="text" name="NAME" value="<?php echo $username; ?>"></td>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td nowrap align="right" valign="top">内容：</td>
                    <td>
                    <textarea rows="5" cols="60" wrap="OFF" name="MESSAGE"></textarea>
                    </td>
                </tr>
                <tr>
                    <td nowrap align="right">
                    </td>
                    <td>
                        <input type="submit"  name="insert" value="書き込み">
                    </td>
                </tr>
                </table>
            </form>
        </div>
        <?php
            $sql = "SELECT * FROM bbs_post_detail order by post_id DESC";
            
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
        <div class="post_list">
                <p>投稿数：<?php echo $row_count; ?>件</p>
        </div>
    </nav>
    <div class="main" style="overflow:auto;">
        <?php 
            foreach($rows as $row){
        ?> 
        <div class="col-md-3">
            <table class="type04">
                <tr>
                    <th class="row">
                        <img src="../img/1.png" width="50px" height="100px">
                    </th>
                    <td>
                        <div class="box2">
                            <?php echo htmlspecialchars($row['post_detail'],ENT_QUOTES,'UTF-8'); ?><br>
                            <div class="r_contnent">
                                <p><?php echo htmlspecialchars($row['title_name'],ENT_QUOTES,'UTF-8'); ?>:
                                <?php echo htmlspecialchars($row['user_name'],ENT_QUOTES,'UTF-8'); ?>さん:
                                <?php echo htmlspecialchars($row['post_date'],ENT_QUOTES,'UTF-8'); ?></p>
                                <!-- ログインしているidと同じuser_IDのみ編集、削除可 -->
                                <?php
                                if($row['user_id'] == $_SESSION['user']){
                                ?>
                                <form method="POST" action="sql_change.php">
                                    <button type="submit" name="button" value="update,<?php echo $row['post_id']; ?>">編集</button>
                                    <button type="submit" name="button" value="delete,<?php echo $row['post_id']; ?>">削除</button>
                                </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php 
        } 
        ?>
    </div>
</body>
</html>
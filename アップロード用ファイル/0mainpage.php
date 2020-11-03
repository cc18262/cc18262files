<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: 0logoutpage.php");
    exit;
}
?>
<?php

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
    </head>
    <body>
        <h1></h1>
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
        <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->
        <h2>俳句たち</h2>
            <a href="0imageshyouzi.php">みんなの俳句を見てみましょう　ここをクリック</a>
            <!--いらないかも<a href="upload.php">画像アップロード</a>-->
        <h2>投稿フォーム</h2>            
            <a href="0protehtmlcopy.php">あなたも俳句を書いてみましょう　ここをクリック</a>
           
        <h2>みんなの声掲示板</h2>
        <?php include('keizibann.php');?>
        <ul>
            <li><a href="0logoutpage.php">ログアウト</a></li>
        </ul>
    </body>
</html>
<a href="0mainpage.php">メインメニュー画面へ</a>

<?php

define( "FILE_DIR", "images");

$dsn = 'mysql:dbname=*******;host=******';
$user = '******';
$password = '*******';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	
	$sql = 'SELECT * FROM images5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//foreachを使うことで各テーブルのidの分htmlを表示するようにしている
		include('./0protehtmlimages.php');
   		echo "<hr>";
	}
?>



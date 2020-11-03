<?php
	
	//5perfe.phpで使用しているテーブルの作成コード
	// DB接続設定
	$dsn = 'mysql:dbname=********;host=*********';
	$user = '********';
	$password = '********';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $sql = "CREATE TABLE IF NOT EXISTS mission5"
	." ("
	. "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
	. "name VARCHAR(100) NOT NULL,"
	. "comment VARCHAR (100) NOT NULL,"
	. "date DATETIME NOT NULL,"
	. "password VARCHAR(100) NOT NULL"
	.")ENGINE=InnoDB DEFAULT CHARACTER SET=utf8";
	$stmt = $pdo->query($sql);
	//最後のカラムに，を打たないよう注意
	

	
?>
	
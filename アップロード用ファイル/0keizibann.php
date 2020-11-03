<?php
//メインページでの掲示板のためのコード
//データベースの情報を入力	
$dsn = 'mysql:dbname=*******;host=********';
$user = '*******';
$password = '********';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	//入力したとき
	 if(!empty($_POST['comment'])&&!empty($_POST['name'])&&!empty($_POST['pas'])&&
        empty($_POST['delete_num'])&&empty($_POST['delete_pas'])&&empty($_POST['direct_num'])
        &&empty($_POST['direct_name'])&&empty($_POST['direct_comment'])
        &&empty($_POST['direct_pas'])){
	$sql = $pdo -> prepare("INSERT INTO tbtest2 (name, comment, password) VALUES (:name, :comment, :password)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':password', $password, PDO::PARAM_STR);
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$password = $_POST['pas'];
	$sql -> execute();
}
		
	//削除したとき
	
	if(empty($_POST['comment'])&&empty($_POST['name'])&&empty($_POST['pas'])&&
        !empty($_POST['delete_num'])&&!empty($_POST['delete_pas'])&&empty($_POST['direct_num'])
        &&empty($_POST['direct_name'])&&empty($_POST['direct_comment'])
        &&empty($_POST['direct_pas'])){
	$id = $_POST['delete_num'];
	$sql = 'delete from tbtest2 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	
        }
    if(empty($_POST['comment'])&&empty($_POST['name'])&&empty($_POST['pas'])&&
        empty($_POST['delete_num'])&&empty($_POST['delete_pas'])&&!empty($_POST['direct_num'])
        &&!empty($_POST['direct_name'])&&!empty($_POST['direct_comment'])
        &&!empty($_POST['direct_pas'])){    
    $id = $_POST['direct_num']; 
	$name = $_POST['direct_name'];
	$comment = $_POST['direct_comment']; 
	$sql = 'UPDATE tbtest2 SET name=:name,comment=:comment WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();  
	
    }
?>

<?php
$dsn = 'mysql:dbname=*******;host=*******';
$user = '*******';
$password = '*******';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$sql = 'SELECT * FROM tbtest2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		echo $row['id'].' ';
		echo $row['name'].' ';
	    echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>
<?php include('./5-01html.php')
?>
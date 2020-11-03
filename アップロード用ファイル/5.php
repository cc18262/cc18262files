<?php
	
include('./5-01データベース情報.php');	

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
	//好きな名前、好きな言葉は自分で決めること
	$sql -> execute();
}
	//bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
	
	//削除したとき
	
	if(empty($_POST['comment'])&&empty($_POST['name'])&&empty($_POST['pas'])&&
        !empty($_POST['delete_num'])&&!empty($_POST['delete_pas'])&&empty($_POST['direct_num'])
        &&empty($_POST['direct_name'])&&empty($_POST['direct_comment'])
        &&empty($_POST['direct_pas'])){
	
	$sql = 'SELECT * FROM tbtest2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	    if($row['id']==$_POST['delete_num']&&$row['password']==$_POST['delete_pas']){
	echo "test";
	$id = $_POST['delete_num'];
	$sql = 'delete from tbtest2 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	    }
	}
	}
            
            
        
    if(empty($_POST['comment'])&&empty($_POST['name'])&&empty($_POST['pas'])&&
        empty($_POST['delete_num'])&&empty($_POST['delete_pas'])&&!empty($_POST['direct_num'])
        &&!empty($_POST['direct_name'])&&!empty($_POST['direct_comment'])
        &&!empty($_POST['direct_pas'])){    
    $sql = 'SELECT * FROM tbtest2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	    if($row['id']==$_POST['direct_num']&&$row['password']==$_POST['direct_pas']){
    $id = $_POST['direct_num']; //変更する投稿番号
	$name = $_POST['direct_name'];
	$comment = $_POST['direct_comment']; //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'UPDATE tbtest2 SET name=:name,comment=:comment WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();  
	    }
	}
}
?>

<?php
include('./5-01データベース情報.php');
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	//$rowの添字（[ ]内）は、4-2で作成したカラムの名称に併せる必要があります。
	$sql = 'SELECT * FROM tbtest2';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].' ';
		echo $row['name'].' ';
	    echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>
<?php include('./5-01html.php')
?>
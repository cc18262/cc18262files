<?php 

    $page_flag=0;//$page_flagの初期化
    if(!empty($_POST['comment'])||!empty($_POST['delete_num'])||!empty($_POST['direct_num'])){
       
       //編集番号とパスワードが入力されていたら$page_flag=2,そうでない場合は$page_flag=1となる
    if(empty($_POST['comment'])&&empty($_POST['name'])&&empty($_POST['delete_num'])
    &&!empty($_POST['direct_num'])&&!empty($_POST['password'])){
        $page_flag=2;
        $dirnum=$_POST['direct_num'];
        $hide_pas=$_POST['password'];
        }else{
            $page_flag=1;
        }
        
    //投稿機能    
    $dsn = 'mysql:dbname=**********;host=*******';
    $user = '**********';
    $password = '*******';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //名前、コメント、パスワード、page_flagが１の時insertする   
    if(!empty($_POST['comment'])&&!empty($_POST['name'])&&empty($_POST['delete_num'])&&
        empty($_POST['direct_num'])&&empty($_POST['hide_num'])&&!empty($_POST['password'])){
            $sql = $pdo -> prepare("INSERT INTO mission5 (name, comment, date, password) VALUES (:name, :comment, :date, :password)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam('date', $date, PDO::PARAM_STR);
            $sql -> bindParam(':password', $password, PDO::PARAM_STR);
            $name = $_POST['name'];
            $comment = $_POST['comment'];
            $date = date('y-m-d h:i:s');
            $password = $_POST['password'];
            $sql -> execute();
        }
    //編集機能    
    //名前、コメント、パスワード、page_flagが２の時 update 
    if(!empty($_POST['comment'])&&!empty($_POST['name'])&&
        empty($_POST['delete_num'])&&empty($_POST['direct_num'])&&
        !empty($_POST['hide_num'])&&!empty($_POST['hide_pas'])){        
            $sql = 'SELECT * FROM mission5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            
            foreach ($results as $row){
                //削除番号が投稿番号と、入力したパスワードと投稿時のパスワードと一致した時編集する
                if($row['id']==$_POST['hide_num']&&$row['password']==$_POST['hide_pas']){               
                    $sql = 'UPDATE mission5 SET name=:name, comment=:comment, date=:date WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam('date', $date, PDO::PARAM_STR);
                        $id = $row['id']; 
                        $name = $_POST['name'];
                        $comment = $_POST['comment']; 
                        $date = date('y-m-d h:i:s');
                        $password = $_POST['hide_pas'];   
                    $stmt->execute();  
                }
            }
        }
    
    //削除機能
    //削除番号とパスワードが入力されたとき起動    
        if(!empty($_POST['delete_num'])&&!empty($_POST['password'])){
            $sql = 'SELECT * FROM mission5';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                //削除番号が投稿番号と、入力したパスワードが投稿したときのパスワードと同じなら
                    if($row['id']==$_POST['delete_num']&&$row['password']==$_POST['password']){
                        $sql = 'delete from mission5 where id=:id';
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $id = $row['id'];
                        $stmt->execute();
                }
            } 
        }
    }
        
    ?>
    
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-5</title>
</head>
<body>
    <?php if ($page_flag===2):?>
    <form action="" method="post" >
        投稿フォーム<br>
        <input type="hidden" name="hide_num" value="<?php echo $dirnum　//編集番号を保存するためのもの?>" >
        <input type="hidden" name="hide_pas" value="<?php echo $hide_pas　//入力したパスワードを保存するためのもの?>">
        名前<input type="text" name="name" value="<?php
        //編集番号が入力されてボタンを入力した場合、その編集番号の投稿の名前とコメントが表示されるようにした           
            $dsn = 'mysql:dbname=*******;host=*****';
            $user = '*******';
            $password = '********';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            $sql = 'SELECT * FROM mission5';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                if($row['id']==$_POST['direct_num']){
                    echo $row['name'];
                }else{continue;}}
         ?>"><br>
        コメント<input type="text" name="comment" value="<?php
        $dsn = 'mysql:dbname=*******;host=*******';
        $user = '*******';
        $password = '*******';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            	$sql = 'SELECT * FROM mission5';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                foreach ($results as $row){
                    if($row['id']==$_POST['direct_num']){
                        echo $row['comment'];
                    }else{continue;}}
         ?>" >
        <input type="submit" name="submit" ><br>
        削除フォーム<br>
        削除番号<input type="text" name="delete_num"  >
        <input type="submit" value ="削除"><br>
        編集番号指定用フォーム<br>
        編集投稿番号<input type="text" name="direct_num" value="" ><br>
        パスワード<input type="text" name="password" value="">
        <input type="submit" value ="編集"><br>
        
       </form>
                <?php else://編集番号が入力されなかった場合はここのHTMLが表示される?> 
        <form action="" method="post" >
        投稿フォーム<br>
        名前<input type="text" name="name" value=""><br>
        コメント<input type="text" name="comment" value="" >
        <input type="submit" name="submit" ><br>
        削除フォーム<br>
        削除番号<input type="text" name="delete_num"  >
        <input type="submit" value ="削除"><br>
        編集番号指定用フォーム<br>
        編集投稿番号<input type="text" name="direct_num" value= ""><br>
        パスワード<input type="text" name="password" value="">
        <input type="submit" value ="編集"><br>
       </form> 
    
    
    <?php endif?>
</body>
</html>
<?php
$dsn = 'mysql:dbname=********;host=*******';
$user = '*******';
$password = '*******';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//テーブル名は作成者で自由
	$sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        //パスワードが画面に表示されないように注意
		echo $row['id'].' ';
		echo $row['name'].' ';
        echo $row['comment'].' ';
        echo $row['date'].'<br>';
	echo "<hr>";
	}
?>
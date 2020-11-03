<style rel="stylesheet"type= "text/css">

.image img{
	float: left;
	height: 150px;
	width: 150px;
}
.haiku{
	padding: 50px 300px;
}
.id{
	padding: 0px 0px;
}
.head{
	padding: 0px 50px;
}
.middle{
	padding: 0px 100px;
}
.bottom{
	padding: 0px 200px;
}
</style>

<html>
	<header></header>
	<body>
		
		
		<div class="image"><img src="./images/<?php echo FILE_DIR.$row['imagename'];  ?>" ></div>
		<div class="haiku">
			<div class="id"><?php echo $row['id']; ?> </div>
			<div class="head"><?php echo $row['head']; ?> </div>
			<div class="middle"><?php echo $row['middle']; ?></div>
			<div class="bottom"><?php echo $row['bottom']; ?></div>
		</div>
		
	</body>
	<footer>

	</footer>

</html>
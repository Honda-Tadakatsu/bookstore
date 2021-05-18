<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php require 'menu.php'; ?>
	<?php
	require 'db_connect.php';
	if(isset($_SESSION['book']['user'])){
		foreach($_SESSION['book'] as $book_num => $book){
			$sql = "insert into purchase values(:user_num,:book_num,:date)";
			$stm = $pdo->prepare($sql);
			$stm->bindValue(':user_num', $_SESSION['user']['num'], PDO::PARAM_INT);
			$stm->bindValue(':book_num', $_SESSION['book']['num'], PDO::PARAM_INT);
			$stm->bindValue(':date', "1211", PDO::PARAM_STR);
			$stm->execute();
		}
		unset($_SESSION['book']);
		print'購入が完了しました。';
	}else{
		print'購入ができませんでした。';
	}
	?>
</body>

</html>
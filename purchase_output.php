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
	if (isset($_SESSION['user'])) {
		//MySQLデータベースに接続する
		require 'db_connect.php';
		//SQL文を作る（プレースホルダを使った式）
		$sql = "insert into purchase values(null,:user_num,:book_num,:date)";
		//プリペアードステートメントを作る
		$stm = $pdo->prepare($sql);
		//プリペアードステートメントに値をバインドする
		$stm->bindValue(':user_num', $_SESSION['user']['num'], PDO::PARAM_STR);
		$stm->bindValue(':book_num', $_REQUEST['num'], PDO::PARAM_STR);
		$stm->bindValue(':date', "123", PDO::PARAM_STR);
		//SQL文を実行する
		$stm->execute();
	?>
		商品を購入しました。
		<hr>
	<?php 
	} else {
	?>
		商品が購入できませんでした。
	<?php
	}
	?>
</body>

</html>
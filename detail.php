<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>商品詳細画面</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
    
<?php require 'menu.php'; ?>
	<?php
	//MySQLデータベースに接続する
	require 'db_connect.php';
	//SQL文を作る（プレースホルダを使った式）
	$sql = "select * from book";
	//プリペアードステートメントを作る
	$stm = $pdo->prepare($sql);
	//プリペアードステートメントに値をバインドする
	$stm->bindValue(':num',$_REQUEST['num'],PDO::PARAM_STR);
	//SQL文を実行する
	$stm->execute();
	//結果の取得（連想配列で受け取る）
	$result = $stm->fetchAll(PDO::FETCH_ASSOC);

	foreach ($result as $row) {
	?>
		<p><img src="<?= $row['num'] ?>.png" style="width: 140px; height:140px"></p>
		<form action="cart_insert.php" method="post">
			<p>商品番号：<?= $row['num'] ?></p>
			<p>商品名：<?= $row['name'] ?></p>
			<p>価格：<?= $row['price'] ?></p>
            
			<input type="hidden" name="num" value="<?= $row['num'] ?>">
			<input type="hidden" name="name" value="<?= $row['name'] ?>">
			<input type="hidden" name="price" value="<?= $row['price'] ?>">
			<p><input type="submit" value="カートに追加"></p>
		</form>
        <p><input type="submit" onclick="location.href='favorite_insert.php?num=<?= $row['num'] ?>'" value="お気に入りに追加"></p>
	<?php
	}
	?>
</body>

</html>
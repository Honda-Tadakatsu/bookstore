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
	//purchaseテーブル最終行 id+1を取得
	$purchase_id = 1;
	foreach($pdo -> query('select max(num) from purchase') as $row){
		$num = $row['max(num)'] + 1;
	}
	//SQL文を作る
	$sql = "insert into purchase values(null,:user_num,:book_num,:date)";
	//プリペアードステートメントを作る
	$stm = $pdo->prepare($sql);
	//プリペアードステートメントに値をバインドする
	$stm -> bindValue(':user_num', $_SESSION['user']['num'],PDO::PARAM_INT);
	if($stm -> execute()){	
		//SQL成功zzz
		//セッションに入っている商品の数だけpurchase_detailに保存
		foreach($_SESSION['book'] as $num => $book){
			//SQL文
			$sql = "insert into purchase values(:purchase_id,:book_num,:date)";
			//プリペアードステートメントを作る
			$stm = $pdo -> prepare($sql);
			//プリペアードステートメントに値をバインドする
			$stm->bindValue(':purchase_id',$purchase_id, PDO::PARAM_INT);
			$stm->bindValue(':book_num',$book_num, PDO::PARAM_INT);
			$stm->bindValue(':date',1, PDO::PARAM_INT);
			//SQL文を実行
			$stm -> execute();
		}
		unset($_SESSION['book']);
		print '購入手続きが完了しました。ありがとうございます。';
	}else{
		//SQL失敗
		print "購入手続き中にエラーが発生しました。申し訳ございません。";
	}
	?>
</body>

</html>
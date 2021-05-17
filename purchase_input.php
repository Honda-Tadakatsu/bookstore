<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>購入画面</title>
	<link rel="stylesheet" href="style/style.css">
</head>

<body>
	<header>
		ヘッダー
	</header>

	<?php require 'menu.php'; ?>

	<div class="purchase_main">

		<?php
		// ログインの確認
		if (!isset($_SESSION['user'])) {
			print "購入手続きを行うにはログインをしてください。";
		} else if (empty($_SESSION['book'])) { //買い物かごが空
			print "カートに商品がありません。";
		} else { //正常処理
		?>
			<p style="font-weight: 700;">お届け先住所</p>
			<p>名前:<?= $_SESSION['user']['name'] ?></p>
			<p>住所:<?= $_SESSION['user']['address'] ?></p>
			<hr>

			<?php require 'cart_.php'; ?>

		<?php
		}
		?>
	</div>

</body>

</html>
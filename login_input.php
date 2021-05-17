<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>ログインしてください</h2>
    <?php require 'menu.php'; ?>
    <form action="login_output.php" method="post">
        メールアドレス<input type="text" name="mail" placeholder="email address"><br>
        パスワード<input type="password" name="password" placeholder="password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
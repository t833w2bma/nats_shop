<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

$sql=$pdo->prepare('SELECT * FROM customer WHERE login = ?');
// このアカウント名が使われてるかの判定
$sql->execute([$_REQUEST['login']]);

// fetch はDBの戻り値を配列に変える関数
// 上のSQL文でカラならばtrue 
if (empty($sql->fetchAll())) {
	// login名は使われてない
	$sql=$pdo->prepare('INSERT INTO customer VALUES(null, ?, ?, ?, ?, ?)');

	$sql->execute([
		$_REQUEST['name'], 
		$_REQUEST['address'], 
		$_REQUEST['email'], 
		$_REQUEST['login'], 
		$_REQUEST['password']
	]);

		echo 'お客様情報を登録しました。';
} else {
	echo 'このログイン名はすでに使用されていますので、変更してください。';
}
?>
<?php require '../footer.php'; ?>

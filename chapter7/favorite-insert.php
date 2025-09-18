<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
/* 主キーの重複エラーが出ないように直してください
 1.お客さんが気がつく方法
 2.確実なロジック (確実に判定できる)
 3.コードが簡単  
*/
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$query = 'insert into favorite values(?,?)';

	$sql=$pdo->prepare($query);

	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);

	echo 'お気に入りに商品を追加しました。';
	echo '<hr>';
	require 'favorite.php';
} else {
	echo 'お気に入りに商品を追加するには、ログインしてください。';
}
?>
<?php require '../footer.php'; ?>

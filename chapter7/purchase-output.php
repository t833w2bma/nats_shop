<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 'staff', 'password');

$purchase_id=1;  
//  id 列から最大値を取得してる
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1; //インクリメントしてる
}

$sql=$pdo->prepare('insert into purchase values(?,?)');
$res = $sql->execute([$purchase_id, $_SESSION['customer']['id']]);
if ($res) {
	// カートをループ
	foreach ($_SESSION['cart'] as $product_id=>$product) {
		$sql=$pdo->prepare('insert into purchase_detail values(?,?,?)');
		$sql->execute([$purchase_id, $product_id, $product['count']]);
	}
	unset($_SESSION['cart']);
	echo '購入手続きが完了しました。ありがとうございます。';
} else {
	echo '購入手続き中にエラーが発生しました。申し訳ございません。';
}
?>
<?php require '../footer.php'; ?>
